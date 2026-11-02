<?php $posts = new WP_Query( [ 'posts_per_page' => 3, 'ignore_sticky_posts' => true, 'no_found_rows' => true ] ); ?>
<section class="hh-topo relative py-20 lg:py-24 bg-surface-cream/50 border-t border-border-subtle overflow-hidden">
	<?php echo hh_leaf( 'palm', 'hidden md:block -left-44 bottom-0 w-[520px] opacity-[.05]', 20 ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
			<div class="max-w-2xl">
				<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink mb-4">Latest News and Blogs</h2>
				<p class="text-body-md text-text-muted">Find out the latest news about our Physiotherapy Clinic in Bangalore and information about all your Physical Therapy and health related needs.</p>
				<p class="text-body-md text-text-muted mt-2">We are always happy to hear your opinion so be sure to leave a comment.</p>
			</div>
			<a class="inline-flex items-center gap-2 border border-secondary text-forest-rich hover:bg-sage-tint px-6 py-3 rounded-full text-label-md font-label-md transition-all w-fit shrink-0" href="<?php echo hh_url( '/blog/' ); ?>">Read all News <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
		</div>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-7">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<article class="relative bg-surface-container-lowest rounded-2xl border border-border-subtle overflow-hidden hover:border-secondary transition-all group flex flex-col">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="aspect-[2/1] overflow-hidden bg-surface-cream"><?php the_post_thumbnail( 'medium_large', [ 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500', 'sizes' => '(min-width: 768px) 380px, 100vw', 'loading' => 'lazy' ] ); ?></div>
					<?php endif; ?>
					<div class="p-5 flex flex-col flex-1">
						<time class="text-xs text-on-tertiary-fixed-variant font-semibold mb-2" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time>
						<h3 class="text-title-lg font-title-lg text-forest-rich mb-2 group-hover:text-secondary transition-colors"><?php the_title(); ?></h3>
						<p class="text-body-sm font-body-sm text-text-muted mb-4"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14, '....' ) ); ?></p>
						<a class="mt-auto text-label-md font-label-md text-forest-rich after:absolute after:inset-0 inline-flex items-center gap-1" href="<?php the_permalink(); ?>">Read Post<span class="sr-only">: <?php the_title(); ?></span> <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
