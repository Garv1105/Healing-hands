<section id="specialists" class="hh-topo scroll-mt-24 relative py-20 lg:py-28 bg-surface-container-low/70 border-y border-border-subtle overflow-hidden">
	<?php echo hh_leaf( 'eucalyptus', 'hidden md:block -left-16 -top-10 w-[240px] opacity-[.08]', 160 ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<div class="flex items-end justify-between mb-10 gap-6">
			<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink">Our Team</h2>
			<div class="hidden sm:flex gap-2" aria-hidden="true">
				<button type="button" tabindex="-1" data-scroll="#team-list" data-dir="-1" class="w-11 h-11 rounded-full border border-border-subtle bg-surface-container-lowest text-forest-rich hover:bg-sage-tint flex items-center justify-center"><?php echo hh_icon( 'arrow_back' ); ?></button>
				<button type="button" tabindex="-1" data-scroll="#team-list" data-dir="1" class="w-11 h-11 rounded-full border border-border-subtle bg-surface-container-lowest text-forest-rich hover:bg-sage-tint flex items-center justify-center"><?php echo hh_icon( 'arrow_forward' ); ?></button>
			</div>
		</div>
		<ul id="team-list" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 -mx-6 px-6 lg:mx-0 lg:px-0 [scrollbar-width:thin]">
			<?php foreach ( hh_doctors() as [ $name, $role, $img, $alt ] ) : ?>
				<li class="snap-start shrink-0 w-60 bg-surface-container-lowest rounded-3xl p-4 border border-border-subtle shadow-sm">
					<div class="aspect-[4/5] rounded-2xl bg-surface-cream overflow-hidden mb-4">
						<?php echo hh_img( $img, $alt, 'medium_large', 'w-full h-full object-cover object-top', [ 'sizes' => '240px' ] ); ?>
					</div>
					<h3 class="font-headline-sm text-[19px] leading-7 font-semibold text-forest-rich"><?php echo esc_html( $name ); ?></h3>
					<?php if ( $role ) : ?><p class="text-xs font-semibold text-on-tertiary-fixed-variant mt-1"><?php echo esc_html( $role ); ?></p><?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
