<?php
// Reuses the site's existing "Get a Call Back" form (Contact Form 7 "Physiotherapy Near Me": Name, Email, Phone).
$form = function_exists( 'wpcf7_get_contact_form_by_title' ) ? wpcf7_get_contact_form_by_title( 'Physiotherapy Near Me' ) : null;
?>
<section class="hh-topo relative pt-8 pb-24 md:pt-24 md:pb-28 overflow-hidden bg-gradient-to-b from-canvas-ivory/60 via-surface-cream/50 to-canvas-ivory/60">
	<div class="absolute -top-32 -left-20 w-96 h-96 bg-sage-tint/50 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
	<div class="absolute top-1/2 -right-32 w-[30rem] h-[30rem] bg-mist-blue/40 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
	<?php echo hh_leaf( 'monstera', '-left-28 -bottom-24 w-[340px] md:w-[440px] opacity-[.07]', 25 ); ?>
	<?php echo hh_leaf( 'palm', 'hidden md:block -right-20 -top-10 w-[520px] opacity-[.06]', -150, 'hh-drift' ); ?>
	<?php echo hh_leaf( 'line', 'hidden lg:block left-[44%] top-16 w-[90px] opacity-50', 30 ); ?>
	<div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 items-center">
			<div class="lg:col-span-6 flex flex-col space-y-6">
				<p class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sage-tint/80 border border-secondary/20 w-fit text-xs font-label-md font-semibold text-forest-rich tracking-wide uppercase">
					<span class="w-2 h-2 rounded-full bg-forest-rich" aria-hidden="true"></span> Experience World Class Physiotherapy
				</p>
				<h1 class="text-display-hero-mobile md:text-display-hero font-display-hero text-text-ink">
					Best Physiotherapy Clinic in <span class="italic text-forest-rich">Bangalore</span>
				</h1>
				<p class="text-body-lg font-body-lg text-text-muted max-w-xl"><?php echo esc_html( HH_ABOUT_SHORT ); ?></p>

				<div id="appointment-booking" class="scroll-mt-28 bg-surface-container-lowest/90 backdrop-blur-md p-6 sm:p-7 rounded-2xl border border-border-subtle shadow-md mt-2">
					<?php if ( $form ) : ?>
						<h2 class="text-title-md font-title-md text-forest-rich flex items-center gap-2 mb-4 pb-3 border-b border-border-subtle/70"><?php echo hh_icon( 'phone_callback', 'text-healing-blue' ); ?> Get a Call Back</h2>
						<?php echo do_shortcode( '[contact-form-7 id="' . $form->id() . '" html_class="hh-form"]' ); ?>
					<?php endif; ?>
					<div class="<?php echo $form ? 'mt-4 pt-4 border-t border-border-subtle/70' : ''; ?> flex flex-wrap items-center justify-between gap-3 text-xs text-text-muted">
						<a class="flex items-center gap-1.5 font-semibold text-forest-rich hover:text-secondary" <?php echo hh_booking_attrs(); ?>><?php echo hh_icon( 'event_available', 'text-[16px] text-secondary' ); ?> Book Now</a>
						<a class="flex items-center gap-1.5 hover:text-forest-rich" href="tel:<?php echo esc_attr( HH_PHONE ); ?>"><?php echo hh_icon( 'call', 'text-[16px] text-secondary' ); ?> <?php echo esc_html( HH_PHONE_DISPLAY ); ?></a>
						<a class="flex items-center gap-1.5 hover:text-forest-rich" href="https://wa.me/<?php echo esc_attr( HH_WHATSAPP ); ?>" target="_blank" rel="noopener"><?php echo hh_icon( 'chat', 'text-[16px] text-secondary' ); ?> WhatsApp Us</a>
					</div>
				</div>
			</div>

			<div class="lg:col-span-6 relative">
				<div class="relative rounded-[2.5rem_1rem_2.5rem_1rem] overflow-hidden shadow-[0_24px_56px_-18px_rgba(27,59,43,0.28)] border-4 border-surface-container-lowest/80 bg-surface-cream aspect-[4/3] sm:aspect-[16/11] group">
					<?php echo hh_img( '/wp-content/uploads/2021/07/Jayanagar-Branch-Exercise-Area-Healing-Hands-Advanced-Physiotherapy-Clinic.webp', 'Healing Hands Advanced Physiotherapy Clinic - Jayanagar Branch - Exercise Area', 'large', 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out', [ 'fetchpriority' => 'high', 'loading' => 'eager', 'sizes' => '(min-width: 1024px) 600px, 100vw' ] ); ?>
					<div class="absolute inset-0 bg-gradient-to-t from-forest-rich/40 via-transparent to-transparent pointer-events-none"></div>
				</div>
				<a class="absolute -top-4 -right-2 sm:-right-4 backdrop-blur-md bg-white/85 px-4 py-3 rounded-2xl shadow-xl border border-white/80 flex items-center gap-3 hover:scale-105 transition-transform" href="<?php echo hh_url( '/bangalore/' ); ?>">
					<span class="w-10 h-10 rounded-full bg-sage-tint flex items-center justify-center text-forest-rich"><?php echo hh_icon( 'location_on', 'text-[20px]' ); ?></span>
					<span>
						<span class="block text-title-md font-title-md text-forest-rich">Physiotherapy in Bangalore</span>
						<span class="block text-label-sm font-label-sm text-text-muted">JP Nagar · Jayanagar · BTM Layout</span>
					</span>
				</a>
				<a class="absolute -bottom-6 -left-2 sm:-left-6 backdrop-blur-md bg-white/85 p-4 rounded-2xl shadow-xl border border-white/80 flex items-center gap-3 hover:scale-105 transition-transform" href="<?php echo hh_url( '/services/physiotherapy-at-home/' ); ?>">
					<span class="w-9 h-9 rounded-full bg-primary-fixed flex items-center justify-center text-forest-rich"><?php echo hh_icon( 'home_health', 'text-[20px]' ); ?></span>
					<span class="text-title-md font-title-md text-forest-rich">Physiotherapy At Home</span>
				</a>
			</div>
		</div>
	</div>
</section>
