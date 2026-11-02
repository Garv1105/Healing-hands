<section class="relative py-20 lg:py-28 overflow-hidden">
	<?php echo hh_leaf( 'palm', 'hidden md:block -right-48 top-0 w-[560px] opacity-[.05]', -160, 'hh-drift' ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink text-center mb-14">Why Us</h2>
		<ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
			<?php foreach ( hh_why_us() as [ $icon, $title, $text ] ) : ?>
				<li class="bg-white/85 rounded-[1.5rem_0.5rem_1.5rem_0.5rem] border border-white/80 ring-1 ring-border-subtle/60 p-6 flex items-start gap-4 shadow-[0_8px_32px_-8px_rgba(27,59,43,0.08)] hover:-translate-y-0.5 transition-transform">
					<span class="w-11 h-11 shrink-0 rounded-xl bg-sage-tint text-forest-rich flex items-center justify-center"><?php echo hh_icon( $icon ); ?></span>
					<span>
						<span class="block text-title-md font-title-md text-text-ink"><?php echo esc_html( $title ); ?></span>
						<span class="block text-body-sm font-body-sm text-text-muted mt-1"><?php echo esc_html( $text ); ?></span>
					</span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
