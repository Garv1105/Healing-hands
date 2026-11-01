<?php
/**
 * Fallback template. Specific templates (front-page.php, single.php, ...) take over as they are built.
 */
get_header(); ?>
<main id="main" class="container">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile; ?>
</main>
<?php get_footer();
