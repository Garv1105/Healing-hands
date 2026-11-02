<?php get_header(); ?>
<main id="main">
	<?php
	// Same section order as the original homepage (original-site/pages/home.md).
	// Hand-drawn leaf dividers sit after these sections (true = mirrored).
	$dividers = [ 'hero' => false, 'therapies' => true, 'why' => false, 'clinics' => true ];
	foreach ( [ 'hero', 'about', 'services', 'therapies', 'symptoms', 'why', 'team', 'clinics', 'news', 'testimonials' ] as $part ) {
		get_template_part( 'template-parts/home/' . $part );
		if ( isset( $dividers[ $part ] ) ) {
			echo hh_divider( $dividers[ $part ] );
		}
	}
	?>
</main>
<?php get_footer();
