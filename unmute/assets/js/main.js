/* ==========================================================================
   UNMUTE — front-end behaviour (vanilla, no dependencies)
   ========================================================================== */
(function () {
	'use strict';

	var doc = document;
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	/* ---------------------------------------------------------------------
	 * Header scroll state
	 * ------------------------------------------------------------------- */
	var header = doc.querySelector('.unmute-header');
	if (header) {
		var onScroll = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 8);
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ---------------------------------------------------------------------
	 * Search panel
	 * ------------------------------------------------------------------- */
	var searchToggles = doc.querySelectorAll('[data-unmute-search-toggle]');
	var searchPanel = doc.getElementById('unmute-search-panel');
	if (searchPanel && searchToggles.length) {
		searchToggles.forEach(function (btn) {
			btn.addEventListener('click', function () {
				var open = searchPanel.hasAttribute('hidden');
				if (open) {
					searchPanel.removeAttribute('hidden');
				} else {
					searchPanel.setAttribute('hidden', '');
				}
				btn.setAttribute('aria-expanded', open ? 'true' : 'false');
				if (open) {
					var input = searchPanel.querySelector('input[type="search"]');
					if (input) input.focus();
				}
			});
		});
	}

	/* ---------------------------------------------------------------------
	 * Mobile drawer
	 * ------------------------------------------------------------------- */
	var drawer = doc.getElementById('unmute-drawer');
	var scrim = doc.querySelector('.unmute-scrim');
	var menuToggles = doc.querySelectorAll('[data-unmute-menu-toggle]');

	function setDrawer(open) {
		if (!drawer) return;
		if (open) {
			drawer.removeAttribute('hidden');
			if (scrim) scrim.removeAttribute('hidden');
			doc.body.style.overflow = 'hidden';
		} else {
			drawer.setAttribute('hidden', '');
			if (scrim) scrim.setAttribute('hidden', '');
			doc.body.style.overflow = '';
		}
		menuToggles.forEach(function (btn) {
			if (btn.tagName === 'BUTTON') {
				btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			}
		});
	}

	menuToggles.forEach(function (btn) {
		btn.addEventListener('click', function () {
			setDrawer(drawer.hasAttribute('hidden'));
		});
	});

	doc.addEventListener('keydown', function (e) {
		if (e.key === 'Escape' && drawer && !drawer.hasAttribute('hidden')) {
			setDrawer(false);
		}
	});

	/* ---------------------------------------------------------------------
	 * Newsletter (local AJAX mode)
	 * ------------------------------------------------------------------- */
	var newsForm = doc.querySelector('[data-unmute-newsform="local"]');
	if (newsForm) {
		newsForm.addEventListener('submit', function (e) {
			e.preventDefault();
			var note = doc.querySelector('.newsletter__note');
			var email = newsForm.querySelector('input[type="email"]');
			var nonce = newsForm.querySelector('input[name="unmute_nonce"]');
			var hp = newsForm.querySelector('input[name="unmute_hp"]');

			var body = new URLSearchParams();
			body.append('action', 'unmute_subscribe');
			body.append('email', email ? email.value : '');
			body.append('nonce', nonce ? nonce.value : '');
			body.append('unmute_hp', hp ? hp.value : '');

			var button = newsForm.querySelector('button[type="submit"]');
			if (button) button.disabled = true;

			fetch((window.unmuteData && window.unmuteData.ajaxUrl) || '/wp-admin/admin-ajax.php', {
				method: 'POST',
				credentials: 'same-origin',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: body.toString()
			})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					if (note && res && res.data && res.data.message) {
						note.textContent = res.data.message;
					}
					if (res && res.success && email) {
						email.value = '';
					}
				})
				.catch(function () {
					if (note) {
						note.textContent = 'Something went wrong. Please try again.';
					}
				})
				.finally(function () {
					if (button) button.disabled = false;
				});
		});
	}

	/* ---------------------------------------------------------------------
	 * Reveal on scroll
	 * ------------------------------------------------------------------- */
	if (!reduceMotion && 'IntersectionObserver' in window) {
		var targets = doc.querySelectorAll('.section, .features, .hero__inner, .post-card, .unmute-card');
		targets.forEach(function (el) { el.classList.add('unmute-reveal'); });
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
		targets.forEach(function (el) { io.observe(el); });
	}

	/* ---------------------------------------------------------------------
	 * Customizer live preview (postMessage)
	 * ------------------------------------------------------------------- */
	if (window.wp && window.wp.customize) {
		var bind = function (id, fn) {
			window.wp.customize(id, function (value) {
				value.bind(fn);
			});
		};
		var setVar = function (name, val) {
			doc.documentElement.style.setProperty(name, val);
		};

		bind('unmute_color_bg', function (v) { if (v) setVar('--unmute-bg', v); });
		bind('unmute_color_surface', function (v) { if (v) setVar('--unmute-surface', v); });
		bind('unmute_color_surface2', function (v) { if (v) setVar('--unmute-surface-2', v); });
		bind('unmute_color_accent', function (v) { if (v) setVar('--unmute-accent', v); });
		bind('unmute_color_accent2', function (v) { if (v) setVar('--unmute-accent-2', v); });
		bind('unmute_color_text', function (v) { if (v) setVar('--unmute-text', v); });
		bind('unmute_color_muted', function (v) { if (v) setVar('--unmute-muted', v); });

		bind('unmute_hero_title', function (v) {
			var el = doc.querySelector('[data-unmute-hero-title]');
			var accent = window.wp.customize('unmute_hero_accent').get();
			if (el && v) {
				if (accent && v.toLowerCase().indexOf(accent.toLowerCase()) !== -1) {
					el.innerHTML = v.replace(new RegExp('(' + accent.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'i'), '<span class="hero__accent">$1</span>');
				} else {
					el.textContent = v;
				}
			}
		});
		bind('unmute_hero_text', function (v) {
			var el = doc.querySelector('[data-unmute-hero-text]');
			if (el) el.textContent = v;
		});
		bind('unmute_hero_cta', function (v) {
			var el = doc.querySelector('[data-unmute-hero-cta]');
			if (el) el.textContent = v;
		});
		bind('unmute_story_quote', function (v) {
			var el = doc.querySelector('[data-unmute-story-quote]');
			if (el) el.textContent = v;
		});
		bind('unmute_news_title', function (v) {
			var el = doc.querySelector('[data-unmute-news-title]');
			if (el) el.textContent = v;
		});
	}
})();
