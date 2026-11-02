<?php // Same columns and wording as the original footer (original-site/site-wide.md). ?>
<footer class="hh-topo relative overflow-hidden bg-surface-cream border-t border-border-subtle">
	<?php echo hh_leaf( 'monstera', 'hidden md:block -right-24 -bottom-24 w-[380px] opacity-[.06]', -20 ); ?>
	<?php echo hh_leaf( 'palm', 'hidden lg:block -left-48 -top-20 w-[520px] opacity-[.045]', 10, 'hh-drift' ); ?>
	<div class="relative z-10 w-full px-6 lg:px-12 py-16 max-w-7xl mx-auto">
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-14">
			<div class="space-y-4">
				<h2 class="text-title-md font-title-md text-forest-rich">About Us</h2>
				<p class="text-body-sm font-body-sm text-text-muted"><?php echo esc_html( HH_ABOUT_SHORT ); ?></p>
				<a class="inline-flex items-center gap-2 bg-forest-rich text-canvas-ivory hover:bg-primary-container px-5 py-2.5 rounded-full text-label-md font-label-md" <?php echo hh_booking_attrs(); ?>>Book Now</a>
			</div>
			<?php foreach ( hh_footer_links() as $heading => $links ) : ?>
				<nav aria-label="<?php echo esc_attr( $heading ); ?>">
					<h2 class="text-title-md font-title-md text-forest-rich mb-4"><?php echo esc_html( $heading ); ?></h2>
					<ul class="space-y-2 text-body-sm font-body-sm">
						<?php foreach ( $links as $label => $url ) : ?>
							<li><a class="text-text-muted hover:text-forest-rich transition-colors" href="<?php echo esc_url( str_starts_with( $url, 'http' ) ? $url : home_url( $url ) ); ?>"><?php echo esc_html( $label ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</nav>
			<?php endforeach; ?>
			<div class="space-y-5">
				<a class="flex items-start gap-3 group" href="tel:<?php echo esc_attr( HH_PHONE ); ?>">
					<span class="w-10 h-10 shrink-0 rounded-full bg-forest-rich text-primary-fixed flex items-center justify-center"><?php echo hh_icon( 'call', 'text-[20px]' ); ?></span>
					<span><span class="block text-title-md font-title-md text-forest-rich">Give us a Call</span><span class="block text-body-sm text-text-muted group-hover:text-forest-rich"><?php echo esc_html( HH_PHONE_FOOTER ); ?></span></span>
				</a>
				<a class="flex items-start gap-3 group" href="mailto:<?php echo esc_attr( HH_EMAIL ); ?>">
					<span class="w-10 h-10 shrink-0 rounded-full bg-forest-rich text-primary-fixed flex items-center justify-center"><?php echo hh_icon( 'mail', 'text-[20px]' ); ?></span>
					<span><span class="block text-title-md font-title-md text-forest-rich">Send us a Message</span><span class="block text-body-sm text-text-muted group-hover:text-forest-rich break-all"><?php echo esc_html( HH_EMAIL ); ?></span></span>
				</a>
				<div>
					<h2 class="text-title-md font-title-md text-forest-rich mb-3">Follow Us</h2>
					<ul class="flex flex-wrap items-center gap-2">
						<?php foreach ( hh_social() as $name => $url ) : ?>
							<li><a class="w-9 h-9 rounded-full bg-sage-tint text-forest-rich hover:bg-forest-rich hover:text-canvas-ivory flex items-center justify-center text-[11px] font-bold transition-colors" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><span aria-hidden="true" class="flex"><?php echo hh_social_icon( $name ); ?></span><span class="sr-only"><?php echo esc_html( $name ); ?></span></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="pt-8 border-t border-border-subtle/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-body-sm font-body-sm text-text-muted">
			<p>Copyright © 2023. All rights reserved to Healing Hands Advanced Physiotherapy Clinic</p>
			<a class="text-forest-rich font-semibold" href="tel:<?php echo esc_attr( HH_PHONE ); ?>"><?php echo esc_html( HH_PHONE_DISPLAY ); ?></a>
		</div>
	</div>
</footer>

<aside id="floating-cta" aria-label="Quick contact" class="fixed bottom-5 right-5 z-40 transition-all duration-500 [&.is-hidden]:opacity-0 [&.is-hidden]:translate-y-6 [&.is-hidden]:pointer-events-none">
	<div class="backdrop-blur-md bg-white/90 border border-emerald-900/15 shadow-2xl rounded-full p-2 flex items-center gap-2">
		<a class="flex items-center gap-2 pl-1 pr-3 text-forest-rich text-label-md font-label-md" <?php echo hh_booking_attrs(); ?>>
			<span class="w-10 h-10 rounded-full bg-forest-rich text-primary-fixed flex items-center justify-center"><?php echo hh_icon( 'calendar_today', 'text-[20px]' ); ?></span> Book Now
		</a>
		<a class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center" href="https://wa.me/<?php echo esc_attr( HH_WHATSAPP ); ?>" target="_blank" rel="noopener"><?php echo hh_icon( 'chat', 'text-[20px]' ); ?><span class="sr-only">WhatsApp Us</span></a>
	</div>
</aside>
<?php wp_footer(); ?>
</body>
</html>
