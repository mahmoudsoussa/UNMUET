/* ==========================================================================
   UNMUTE — front-end behaviour (vanilla, no dependencies)
   v2.0 "Aurora": header, drawer (with focus trap), search, newsletter,
   reveal-on-scroll, subtle aurora parallax, Customizer live preview.
   ========================================================================== */
(function () {
	'use strict';

	var doc = document;
	var root = doc.documentElement;
	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var i18n = (window.unmuteData && window.unmuteData.i18n) || {};
	var rtl = (window.unmuteData && window.unmuteData.isRtl === '1') || root.getAttribute('dir') === 'rtl';

	function each(list, fn) {
		Array.prototype.forEach.call(list, fn);
	}

	/* ---------------------------------------------------------------------
	 * Header scroll state
	 * ------------------------------------------------------------------- */
	var header = doc.querySelector('.unmute-header');
	if (header) {
		var lastState = null;
		var onScroll = function () {
			var scrolled = window.scrollY > 8;
			if (scrolled !== lastState) {
				header.classList.toggle('is-scrolled', scrolled);
				lastState = scrolled;
			}
		};
		window.addEventListener('scroll', onScroll, { passive: true });
		onScroll();
	}

	/* ---------------------------------------------------------------------
	 * Search panel
	 * ------------------------------------------------------------------- */
	var searchToggles = doc.querySelectorAll('[data-unmute-search-toggle]');
	var searchPanel = doc.getElementById('unmute-search-panel');

	function setSearch(open, toggle) {
		if (!searchPanel) return;
		if (open) {
			searchPanel.removeAttribute('hidden');
			var input = searchPanel.querySelector('input[type="search"]');
			if (input) input.focus();
		} else {
			searchPanel.setAttribute('hidden', '');
		}
		each(searchToggles, function (btn) {
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		if (!open && toggle) toggle.focus();
	}

	if (searchPanel) {
		each(searchToggles, function (btn) {
			btn.addEventListener('click', function () {
				setSearch(searchPanel.hasAttribute('hidden'), btn);
			});
		});
	}

	/* ---------------------------------------------------------------------
	 * Mobile drawer — with focus trap & focus restore
	 * ------------------------------------------------------------------- */
	var drawer = doc.getElementById('unmute-drawer');
	var scrim = doc.querySelector('.unmute-scrim');
	var menuToggles = doc.querySelectorAll('[data-unmute-menu-toggle]');
	var lastFocused = null;

	function focusables(container) {
		return container.querySelectorAll(
			'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
		);
	}

	function setDrawer(open) {
		if (!drawer) return;

		if (open) {
			lastFocused = doc.activeElement;
			drawer.removeAttribute('hidden');
			if (scrim) scrim.removeAttribute('hidden');
			doc.body.style.overflow = 'hidden';
			var first = focusables(drawer)[0];
			if (first) first.focus();
		} else {
			drawer.setAttribute('hidden', '');
			if (scrim) scrim.setAttribute('hidden', '');
			doc.body.style.overflow = '';
			if (lastFocused && lastFocused.focus) lastFocused.focus();
		}

		each(menuToggles, function (btn) {
			if (btn.tagName === 'BUTTON') {
				btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			}
		});
	}

	if (drawer) {
		each(menuToggles, function (btn) {
			btn.addEventListener('click', function () {
				setDrawer(drawer.hasAttribute('hidden'));
			});
		});
	}

	doc.addEventListener('keydown', function (e) {
		var drawerOpen = drawer && !drawer.hasAttribute('hidden');

		if (e.key === 'Escape' || e.key === 'Esc') {
			if (drawerOpen) {
				e.preventDefault();
				setDrawer(false);
				return;
			}
			if (searchPanel && !searchPanel.hasAttribute('hidden')) {
				e.preventDefault();
				setSearch(false, searchToggles[0]);
			}
		}

		if (e.key === 'Tab' && drawerOpen) {
			var items = focusables(drawer);
			if (!items.length) return;
			var first = items[0];
			var last = items[items.length - 1];
			if (e.shiftKey && doc.activeElement === first) {
				e.preventDefault();
				last.focus();
			} else if (!e.shiftKey && doc.activeElement === last) {
				e.preventDefault();
				first.focus();
			}
		}
	});

	/* ---------------------------------------------------------------------
	 * Newsletter (local AJAX mode) — handles band + footer forms
	 * ------------------------------------------------------------------- */
	each(doc.querySelectorAll('[data-unmute-newsform="local"]'), function (newsForm) {
		newsForm.addEventListener('submit', function (e) {
			e.preventDefault();

			var wrapper = newsForm.parentNode;
			var note = wrapper.querySelector('.newsletter__note, .unmute-footer__note');
			var email = newsForm.querySelector('input[type="email"]');
			var nonce = newsForm.querySelector('input[name="unmute_nonce"]');
			var hp = newsForm.querySelector('input[name="unmute_hp"]');
			var button = newsForm.querySelector('button[type="submit"]');

			var body = new URLSearchParams();
			body.append('action', 'unmute_subscribe');
			body.append('email', email ? email.value : '');
			body.append('nonce', nonce ? nonce.value : '');
			body.append('unmute_hp', hp ? hp.value : '');

			if (button) button.disabled = true;
			if (note) {
				note.removeAttribute('data-state');
				note.textContent = i18n.sending || 'Sending…';
			}

			fetch((window.unmuteData && window.unmuteData.ajaxUrl) || '/wp-admin/admin-ajax.php', {
				method: 'POST',
				credentials: 'same-origin',
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
				body: body.toString()
			})
				.then(function (r) { return r.json(); })
				.then(function (res) {
					var ok = res && res.success;
					if (note && res && res.data && res.data.message) {
						note.textContent = res.data.message;
					}
					if (note) note.setAttribute('data-state', ok ? 'success' : 'error');
					if (ok && email) email.value = '';
				})
				.catch(function () {
					if (note) {
						note.textContent = i18n.error || 'Something went wrong. Please try again.';
						note.setAttribute('data-state', 'error');
					}
				})
				.finally(function () {
					if (button) button.disabled = false;
				});
		});
	});

	/* ---------------------------------------------------------------------
	 * Reveal on scroll
	 * ------------------------------------------------------------------- */
	if (!reduceMotion && 'IntersectionObserver' in window) {
		var targets = doc.querySelectorAll('.section, .features, .hero__inner, .post-card, .unmute-card, .newsletter__band');
		each(targets, function (el) { el.classList.add('unmute-reveal'); });

		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.08, rootMargin: '0px 0px -4% 0px' });

		each(targets, function (el) { io.observe(el); });
	}

	/* ---------------------------------------------------------------------
	 * Aurora parallax — very subtle, opt-out for reduced motion
	 * ------------------------------------------------------------------- */
	if (!reduceMotion) {
		var blobs = doc.querySelectorAll('.hero__inner, .hero__spark--1');
		var heroEl = doc.querySelector('.hero');
		if (heroEl && blobs.length) {
			var ticking = false;
			window.addEventListener('scroll', function () {
				if (ticking) return;
				ticking = true;
				window.requestAnimationFrame(function () {
					var y = window.scrollY;
					if (y < 900) {
						each(blobs, function (el) {
							el.style.transform = 'translate3d(0,' + (y * 0.045) + 'px,0)';
						});
					}
					ticking = false;
				});
			}, { passive: true });
		}
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
			if (val) root.style.setProperty(name, val);
		};

		bind('unmute_color_bg', function (v) { setVar('--unmute-bg', v); });
		bind('unmute_color_bg2', function (v) { setVar('--unmute-bg-2', v); });
		bind('unmute_color_surface', function (v) { setVar('--unmute-surface', v); });
		bind('unmute_color_surface2', function (v) { setVar('--unmute-surface-2', v); });
		bind('unmute_color_accent', function (v) { setVar('--unmute-accent', v); });
		bind('unmute_color_accent2', function (v) { setVar('--unmute-accent-2', v); });
		bind('unmute_color_accent3', function (v) { setVar('--unmute-accent-3', v); });
		bind('unmute_color_text', function (v) { setVar('--unmute-text', v); });
		bind('unmute_color_muted', function (v) { setVar('--unmute-muted', v); });

		bind('unmute_hero_title', function (v) {
			var el = doc.querySelector('[data-unmute-hero-title]');
			var accent = window.wp.customize('unmute_hero_accent').get();
			if (el && v) {
				if (accent && v.toLowerCase().indexOf(accent.toLowerCase()) !== -1) {
					el.innerHTML = v.replace(
						new RegExp('(' + accent.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'i'),
						'<span class="hero__accent">$1</span>'
					);
				} else {
					el.textContent = v;
				}
			}
		});
		bind('unmute_hero_accent', function () {
			var el = doc.querySelector('[data-unmute-hero-title]');
			var title = window.wp.customize('unmute_hero_title').get();
			var accent = window.wp.customize('unmute_hero_accent').get();
			if (el && title) {
				if (accent && title.toLowerCase().indexOf(accent.toLowerCase()) !== -1) {
					el.innerHTML = title.replace(
						new RegExp('(' + accent.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'i'),
						'<span class="hero__accent">$1</span>'
					);
				} else {
					el.textContent = title;
				}
			}
		});
		bind('unmute_hero_sub', function (v) {
			var el = doc.querySelector('[data-unmute-hero-sub]');
			if (el) el.textContent = v;
		});
		bind('unmute_hero_text', function (v) {
			var el = doc.querySelector('[data-unmute-hero-text]');
			if (el) el.textContent = v;
		});
		bind('unmute_hero_cta', function (v) {
			var el = doc.querySelector('[data-unmute-hero-cta]');
			if (el) {
				var icon = el.querySelector('svg');
				el.textContent = v;
				if (icon) el.appendChild(icon);
			}
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
