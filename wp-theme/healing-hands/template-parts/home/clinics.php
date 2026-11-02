<?php $branches = hh_branches(); $first = array_key_first( $branches ); ?>
<section id="clinics" class="scroll-mt-24 relative py-20 lg:py-28 overflow-hidden">
	<?php echo hh_leaf( 'monstera', 'hidden md:block -right-28 top-10 w-[420px] opacity-[.06]', -35, 'hh-drift' ); ?>
	<?php echo hh_leaf( 'line', 'hidden lg:block left-10 bottom-16 w-[110px] opacity-40', 15 ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 relative z-10" data-tabs>
		<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink text-center mb-10">Physiotherapy in Bangalore</h2>

		<div class="flex justify-start sm:justify-center gap-3 mb-10 overflow-x-auto pb-2" role="tablist" aria-label="Clinic locations">
			<?php foreach ( $branches as $key => $b ) : $on = $key === $first; ?>
				<button type="button" role="tab" id="tab-clinic-<?php echo $key; ?>" aria-controls="panel-clinic-<?php echo $key; ?>" aria-selected="<?php echo $on ? 'true' : 'false'; ?>" tabindex="<?php echo $on ? '0' : '-1'; ?>"
					class="shrink-0 px-6 py-3 rounded-full font-label-md text-label-md transition-all flex items-center gap-2 bg-surface-container-lowest text-text-muted border border-border-subtle hover:text-forest-rich aria-selected:bg-forest-rich aria-selected:text-canvas-ivory aria-selected:border-forest-rich">
					<?php echo hh_icon( $b['icon'], 'text-[18px]' ); ?> <?php echo esc_html( $b['name'] ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<?php foreach ( $branches as $key => $b ) : $maps = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( 'Healing Hands Advanced Physiotherapy Clinic ' . implode( ' ', $b['address'] ) ); ?>
			<div role="tabpanel" id="panel-clinic-<?php echo $key; ?>" aria-labelledby="tab-clinic-<?php echo $key; ?>" <?php echo $key === $first ? '' : 'hidden'; ?>
				class="bg-surface-container-lowest rounded-3xl border border-border-subtle p-6 sm:p-10 shadow-md">
				<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
					<div class="lg:col-span-6 space-y-5">
						<h3 class="text-headline-md font-headline-md text-forest-rich"><a class="hover:underline" href="<?php echo hh_url( $b['page'] ); ?>"><?php echo esc_html( $b['name'] ); ?></a></h3>
						<ul class="space-y-3 text-body-md font-body-md text-text-ink">
							<li class="flex items-start gap-3"><?php echo hh_icon( 'pin_drop', 'text-secondary mt-0.5' ); ?> <address class="not-italic"><?php echo implode( '<br>', array_map( 'esc_html', $b['address'] ) ); ?></address></li>
							<li class="flex items-center gap-3"><?php echo hh_icon( 'call', 'text-secondary' ); ?> <a class="hover:text-forest-rich" href="tel:<?php echo esc_attr( HH_PHONE ); ?>"><?php echo esc_html( HH_PHONE_FOOTER ); ?></a></li>
							<li class="flex items-center gap-3"><?php echo hh_icon( 'mail', 'text-secondary' ); ?> <a class="hover:text-forest-rich break-all" href="mailto:<?php echo esc_attr( HH_EMAIL ); ?>"><?php echo esc_html( HH_EMAIL ); ?></a></li>
						</ul>
						<div class="pt-4 flex flex-wrap items-center gap-4">
							<a class="bg-forest-rich hover:bg-primary-container text-canvas-ivory px-6 py-3 rounded-full text-label-md font-label-md flex items-center gap-2 transition-all" <?php echo hh_booking_attrs(); ?>>Book Now <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
							<a class="border border-secondary text-forest-rich hover:bg-sage-tint px-5 py-3 rounded-full text-label-md font-label-md flex items-center gap-2 transition-all" href="<?php echo esc_url( $maps ); ?>" target="_blank" rel="noopener"><?php echo hh_icon( 'directions', 'text-[18px]' ); ?> Map</a>
						</div>
					</div>
					<a class="lg:col-span-6 block relative rounded-2xl overflow-hidden bg-surface-cream aspect-[4/3]" href="<?php echo hh_url( $b['page'] ); ?>" tabindex="-1">
						<?php echo hh_img( $b['img'], $b['alt'], 'large', 'w-full h-full object-cover', [ 'sizes' => '(min-width: 1024px) 560px, 100vw' ] ); ?>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
