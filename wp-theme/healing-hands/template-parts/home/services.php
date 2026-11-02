<section id="services" class="hh-topo scroll-mt-24 relative py-20 lg:py-28 bg-surface-container-low/70 border-y border-border-subtle overflow-hidden">
	<?php echo hh_leaf( 'palm', 'hidden md:block -left-40 top-1/3 w-[560px] opacity-[.05]', 40, 'hh-drift' ); ?>
	<?php echo hh_leaf( 'monstera', 'hidden lg:block -right-24 -bottom-20 w-[380px] opacity-[.06]', -30 ); ?>
	<div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<div class="hh-reveal flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
			<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink">Services</h2>
			<a class="inline-flex items-center gap-2 border border-secondary text-forest-rich hover:bg-sage-tint px-6 py-3 rounded-full text-label-md font-label-md transition-all w-fit bg-canvas-ivory/70" href="<?php echo hh_url( '/services/' ); ?>">See all Services <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
		</div>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
			<?php foreach ( hh_services() as $i => $s ) : ?>
				<article class="hh-reveal relative group rounded-[2rem_0.75rem_2rem_0.75rem] overflow-hidden aspect-[4/5] sm:aspect-[5/6] shadow-[0_18px_44px_-18px_rgba(27,59,43,0.35)] ring-1 ring-white/40 bg-forest-rich" style="transition-delay:<?php echo ( $i % 3 ) * 90; ?>ms">
					<?php echo hh_img( $s['img'], $s['alt'], 'medium_large', 'absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700', [ 'sizes' => '(min-width: 1024px) 380px, (min-width: 768px) 50vw, 100vw' ] ); ?>
					<div class="absolute inset-0 bg-gradient-to-t from-forest-rich via-forest-rich/70 to-forest-rich/0" aria-hidden="true"></div>
					<span class="absolute top-4 right-4 w-11 h-11 rounded-full bg-forest-rich/60 ring-1 ring-white/30 text-primary-fixed flex items-center justify-center"><?php echo hh_leaf_icon( 'w-5 h-5' ); ?></span>
					<div class="absolute inset-x-0 bottom-0 p-7">
						<h3 class="text-headline-md font-headline-md text-surface-container-lowest">
							<a class="after:absolute after:inset-0" href="<?php echo hh_url( $s['url'] ); ?>"><?php echo esc_html( $s['title'] ); ?></a>
						</h3>
						<span class="block w-12 h-[3px] rounded-full bg-gold my-3 group-hover:w-20 transition-all duration-500" aria-hidden="true"></span>
						<p class="text-body-sm font-body-sm text-sage-tint/90"><?php echo esc_html( $s['text'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
