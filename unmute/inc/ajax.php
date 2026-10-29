<?php
/**
 * UNMUTE — AJAX handlers (newsletter signup stored locally).
 *
 * @package UNMUTE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'unmute_handle_subscribe' ) ) {
	/**
	 * Store a newsletter subscriber locally when no external service is set.
	 */
	function unmute_handle_subscribe() {
		check_ajax_referer( 'unmute_newsletter', 'nonce' );

		// Honeypot: bots fill hidden fields.
		if ( ! empty( $_POST['unmute_hp'] ) ) {
			wp_send_json_success( array( 'message' => __( 'Thanks — you are on the list.', 'unmute' ) ) );
		}

		$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

		if ( ! is_email( $email ) ) {
			wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'unmute' ) ), 400 );
		}

		$list = get_option( 'unmute_subscribers', array() );
		if ( ! is_array( $list ) ) {
			$list = array();
		}

		$exists = false;
		foreach ( $list as $entry ) {
			if ( isset( $entry['email'] ) && strtolower( $entry['email'] ) === strtolower( $email ) ) {
				$exists = true;
				break;
			}
		}

		if ( ! $exists ) {
			$list[] = array(
				'email' => $email,
				'date'  => current_time( 'mysql' ), // phpcs:ignore WordPress.DateTime.CurrentTimeTimestamp.Requested
			);
			// Cap the stored list; export/ migrate to a real ESP when it grows.
			if ( count( $list ) > 2000 ) {
				$list = array_slice( $list, -2000 );
			}
			update_option( 'unmute_subscribers', $list, false );
		}

		/**
		 * Fires after a local newsletter signup (hook your ESP here).
		 *
		 * @param string $email Subscriber email.
		 */
		do_action( 'unmute_newsletter_subscribed', $email );

		wp_send_json_success( array( 'message' => __( 'Welcome to the Signal. Watch your inbox for the next drop.', 'unmute' ) ) );
	}
}
add_action( 'wp_ajax_unmute_subscribe', 'unmute_handle_subscribe' );
add_action( 'wp_ajax_nopriv_unmute_subscribe', 'unmute_handle_subscribe' );
