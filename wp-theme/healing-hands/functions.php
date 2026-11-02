<?php
/**
 * Healing Hands theme setup.
 */

require __DIR__ . '/inc/data.php';

const HH_VERSION = '0.1.0';

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
	register_nav_menus( [ 'primary' => 'Primary', 'footer' => 'Footer' ] );
} );

add_action( 'wp_enqueue_scripts', function () {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();
	wp_enqueue_style( 'hh-main', "$uri/assets/css/main.css", [], filemtime( "$dir/assets/css/main.css" ) );
	wp_enqueue_script( 'hh-main', "$uri/assets/js/main.js", [], filemtime( "$dir/assets/js/main.js" ), [ 'strategy' => 'defer', 'in_footer' => true ] );

	// Block editor styles aren't used by this theme's templates.
	if ( ! is_singular( 'post' ) ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'classic-theme-styles' );
		remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
		wp_dequeue_style( 'global-styles' );
	}

	// The homepage is fully theme-built: drop page-builder CSS. (The CF7 redirect script stays: the
	// original "Get a Call Back" form redirects to the thank-you page after sending.)
	if ( is_front_page() ) {
		wp_dequeue_style( 'siteorigin-panels-front' );
		wp_dequeue_style( 'contact-form-7' ); // form styled by the theme (.hh-form)
	}
}, 100 );

// SiteOrigin prints layout CSS for the old page-builder homepage content.
add_filter( 'siteorigin_panels_data', fn( $data ) => is_front_page() ? false : $data );

// Preload the two fonts used above the fold (tested: removing these made first paint slower).
add_action( 'wp_head', function () {
	$fonts = get_template_directory_uri() . '/assets/fonts';
	foreach ( [ 'playfair-display-latin-400-normal', 'plus-jakarta-sans-latin-400-normal' ] as $f ) {
		printf( '<link rel="preload" href="%s/%s.woff2" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $fonts ), $f );
	}
}, 1 );

// Front-end cleanup: no emoji script, no oEmbed discovery.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/** Site-relative URL helper. */
function hh_url( $path ) {
	return esc_url( home_url( $path ) );
}

/**
 * Navigation from the "Primary" menu (Appearance → Menus), with one level of children
 * (the original menu has About Us → Intro, Our Locations, Our Team, Careers, FAQ Page, Virtual Clinic, Home Physiotherapy).
 */
function hh_nav_items() {
	$locations = get_nav_menu_locations();
	$all       = ! empty( $locations['primary'] ) ? (array) wp_get_nav_menu_items( $locations['primary'] ) : [];
	$here      = trailingslashit( home_url( strtok( $_SERVER['REQUEST_URI'] ?? '/', '?' ) ) );
	$is_here   = fn( $url ) => trailingslashit( $url ) === $here;
	$items     = [];
	foreach ( $all as $i ) {
		if ( ! $i->menu_item_parent ) {
			$items[ $i->ID ] = [ 'title' => $i->title, 'url' => $i->url, 'current' => $is_here( $i->url ), 'children' => [] ];
		}
	}
	foreach ( $all as $i ) {
		if ( $i->menu_item_parent && isset( $items[ $i->menu_item_parent ] ) ) {
			$items[ $i->menu_item_parent ]['children'][] = [ 'title' => $i->title, 'url' => $i->url, 'current' => $is_here( $i->url ) ];
			$items[ $i->menu_item_parent ]['current'] = $items[ $i->menu_item_parent ]['current'] || $is_here( $i->url );
		}
	}
	return array_values( $items );
}

/** Material Symbols icon (decorative). */
function hh_icon( $name, $class = '' ) {
	return sprintf( '<span class="material-symbols-outlined %s" aria-hidden="true">%s</span>', esc_attr( $class ), esc_html( $name ) );
}

/**
 * Responsive <img> for an original upload, looked up by its path (keeps the original alt text).
 * Lazy by default; pass 'loading' => 'eager' for above-the-fold images.
 * ponytail: one DB lookup per image; fine behind LiteSpeed page cache.
 */
function hh_img( $path, $alt, $size = 'large', $class = '', $attrs = [] ) {
	$attrs = array_merge( [ 'class' => $class, 'alt' => $alt, 'loading' => 'lazy', 'decoding' => 'async' ], $attrs );
	$id    = attachment_url_to_postid( home_url( $path ) );
	if ( $id ) {
		return wp_get_attachment_image( $id, $size, false, $attrs );
	}
	$html = '<img src="' . esc_url( home_url( $path ) ) . '"';
	foreach ( $attrs as $k => $v ) {
		$html .= ' ' . $k . '="' . esc_attr( $v ) . '"';
	}
	return $html . '>';
}

/**
 * Decorative botanical silhouette (assets/img/leaf-*.svg): monstera, palm, eucalyptus, line.
 * $class positions/sizes it; $rotate sets the base angle the sway animation starts from.
 */
function hh_leaf( $name, $class, $rotate = 0, $motion = 'hh-sway' ) {
	return sprintf(
		'<img class="hh-decor %s %s" style="--r:%ddeg;transform:rotate(%ddeg)" src="%s" alt="" aria-hidden="true" loading="lazy" decoding="async">',
		esc_attr( $motion ), esc_attr( $class ), (int) $rotate, (int) $rotate,
		esc_url( get_template_directory_uri() . '/assets/img/leaf-' . $name . '.svg' )
	);
}

/** Hand-drawn wavy line with a small leaf; draws itself when scrolled into view (see .hh-draw). */
function hh_divider( $flip = false ) {
	return '<div class="hh-draw max-w-7xl mx-auto px-6 lg:px-12 -my-4 relative z-10 pointer-events-none" aria-hidden="true">'
		. '<svg viewBox="0 0 1200 60" fill="none" preserveAspectRatio="none" class="w-full h-12' . ( $flip ? ' -scale-x-100' : '' ) . '">'
		. '<path class="hh-draw-line" d="M0 34 C 220 8, 410 54, 620 28 C 830 2, 990 48, 1200 22" stroke="#5E8B71" stroke-opacity=".45" stroke-width="1.3" stroke-linecap="round"/>'
		. '<path class="hh-draw-leaf" d="M592 30 C 604 12, 626 9, 640 18 C 626 30, 606 33, 592 30 Z" fill="#E2ECE5" stroke="#1B3B2B" stroke-opacity=".35" stroke-width="1.1"/>'
		. '<path class="hh-draw-leaf" d="M598 29 L634 18" stroke="#1B3B2B" stroke-opacity=".3" stroke-width="1"/>'
		. '</svg></div>';
}

/** Small line-art leaf icon (inherits text colour), used as a card accent. */
function hh_leaf_icon( $class = 'w-6 h-6' ) {
	return '<svg class="' . esc_attr( $class ) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" aria-hidden="true">'
		. '<path d="M5 19C5 10 10 5 19 5c0 9-5 14-14 14Z"/><path d="M5 19 14 10M9 15h4M11 13V9"/></svg>';
}

/** Social icon: simple shapes for Instagram/YouTube, bold letter marks for the rest. */
function hh_social_icon( $name ) {
	$svg = [
		'Instagram' => '<svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>',
		'YouTube'   => '<svg viewBox="0 0 24 24" class="w-[18px] h-[18px]" fill="currentColor"><rect x="2" y="5" width="20" height="14" rx="4"/><path d="M10 9v6l5-3z" fill="#E2ECE5"/></svg>',
	];
	$letters = [ 'Facebook' => 'f', 'X/Twitter' => 'X', 'LinkedIn' => 'in' ];
	return $svg[ $name ] ?? '<span class="font-bold text-[14px] leading-none">' . esc_html( $letters[ $name ] ?? $name[0] ) . '</span>';
}

/** "Book Now" links go to the original Book Appointment page. */
function hh_booking_attrs() {
	return 'href="' . esc_url( home_url( HH_BOOK_URL ) ) . '"';
}
