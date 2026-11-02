<section id="stories" class="scroll-mt-24 relative py-20 lg:py-28 border-t border-border-subtle overflow-hidden">
	<?php echo hh_leaf( 'eucalyptus', 'hidden md:block -right-12 -bottom-20 w-[260px] opacity-[.08]', 10 ); ?>
	<?php echo hh_leaf( 'monstera', 'hidden lg:block -left-28 -top-16 w-[360px] opacity-[.05]', 150, 'hh-drift' ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink text-center mb-14">Client Testimonials</h2>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
			<?php foreach ( hh_testimonials() as $i => $t ) : ?>
				<figure class="relative overflow-hidden bg-white/85 p-7 rounded-[2rem_0.75rem_2rem_0.75rem] border border-white/80 ring-1 ring-border-subtle/60 flex flex-col justify-between shadow-[0_8px_32px_-8px_rgba(27,59,43,0.08)]">
					<?php echo hh_leaf( 'line', '-right-6 -bottom-10 w-[90px] opacity-30', -25, 'hh-drift' ); ?>
					<blockquote class="text-body-md text-text-ink italic mb-6"><?php echo hh_icon( 'format_quote', 'text-[32px] text-secondary/60 block mb-2' ); ?><?php echo esc_html( $t['quote'] ); ?></blockquote>
					<figcaption class="pt-4 border-t border-border-subtle flex items-center gap-3">
						<span class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm <?php echo [ 'bg-sage-tint text-forest-rich', 'bg-mist-blue text-on-tertiary-fixed-variant', 'bg-secondary-fixed text-forest-rich' ][ $i % 3 ]; ?>" aria-hidden="true"><?php echo esc_html( $t['name'][0] ); ?></span>
						<strong class="text-body-sm font-semibold text-text-ink"><?php echo esc_html( $t['name'] ); ?></strong>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
