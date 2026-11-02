<?php $t = hh_therapies(); ?>
<section class="relative py-20 lg:py-28 overflow-clip">
	<?php echo hh_leaf( 'eucalyptus', 'hidden md:block -right-10 -bottom-16 w-[280px] opacity-[.08]', 15 ); ?>
	<?php echo hh_leaf( 'line', 'hidden lg:block left-6 top-10 w-[120px] opacity-40', -20, 'hh-drift' ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-start relative z-10">
		<div class="lg:col-span-5 lg:sticky lg:top-28">
			<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink mb-6">Therapies</h2>
			<div class="space-y-4 text-body-md text-text-muted">
				<?php foreach ( $t['intro'] as $p ) : ?><p><?php echo esc_html( $p ); ?></p><?php endforeach; ?>
			</div>
			<a class="mt-8 inline-flex items-center gap-2 bg-forest-rich text-canvas-ivory hover:bg-primary-container px-6 py-3 rounded-full text-label-md font-label-md transition-all" href="<?php echo hh_url( '/therapies/' ); ?>">See all Therapies <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
		</div>
		<ul class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-4">
			<?php foreach ( $t['items'] as [ $name, $img, $alt ] ) : ?>
				<li class="group relative rounded-[1.5rem_0.5rem_1.5rem_0.5rem] overflow-hidden aspect-square bg-surface-cream border border-border-subtle">
					<?php echo hh_img( $img, $alt, 'medium', 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500', [ 'sizes' => '(min-width: 1024px) 230px, 45vw' ] ); ?>
					<span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-forest-rich/85 to-transparent pt-10 pb-3 px-4 text-canvas-ivory text-title-md font-title-md"><?php echo esc_html( $name ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
