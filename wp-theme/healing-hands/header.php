<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>document.documentElement.classList.add('js')</script>
<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-canvas-ivory text-text-ink font-sans antialiased selection:bg-sage-tint selection:text-forest-rich' ); ?>>
<?php wp_body_open(); ?>
<a class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-[60] focus:bg-forest-rich focus:text-canvas-ivory focus:px-4 focus:py-2 focus:rounded-full" href="#main">Skip to content</a>
<div id="scroll-progress-bar" class="fixed top-0 left-0 h-[3px] bg-gradient-to-r from-forest-rich via-secondary to-primary-fixed z-[55] w-0 pointer-events-none" aria-hidden="true"></div>

<div class="bg-forest-rich text-canvas-ivory py-2 px-4">
	<div class="max-w-7xl mx-auto flex items-center justify-center sm:justify-between gap-4 text-xs">
		<span class="hidden sm:flex items-center gap-1.5"><?php echo hh_icon( 'location_on', 'text-[16px] text-primary-fixed' ); ?> JP Nagar · Jayanagar · BTM Layout</span>
		<a class="flex items-center gap-1.5 hover:text-primary-fixed" href="tel:<?php echo esc_attr( HH_PHONE ); ?>"><?php echo hh_icon( 'call', 'text-[16px] text-primary-fixed' ); ?> <?php echo esc_html( HH_PHONE_DISPLAY ); ?></a>
	</div>
</div>

<header class="sticky top-0 z-50 backdrop-blur-xl bg-canvas-ivory/90 border-b border-forest-rich/10 shadow-[0_4px_20px_rgba(27,59,43,0.04)]">
	<div class="flex justify-between items-center gap-3 w-full px-5 sm:px-6 lg:px-12 max-w-7xl mx-auto py-3">
		<a class="shrink min-w-0" href="<?php echo hh_url( '/' ); ?>" rel="home">
			<img class="h-9 sm:h-12 w-auto" src="<?php echo esc_url( home_url( HH_LOGO ) ); ?>" alt="<?php echo esc_attr( HH_LOGO_ALT ); ?>" width="360" height="90" fetchpriority="high">
		</a>

		<nav class="hidden lg:flex items-center gap-7" aria-label="Primary">
			<?php foreach ( hh_nav_items() as $item ) : $cls = 'text-label-md font-label-md transition-colors duration-200 ' . ( $item['current'] ? 'text-forest-rich border-b-2 border-forest-rich pb-1' : 'text-text-muted hover:text-forest-rich' ); ?>
				<?php if ( $item['children'] ) : ?>
					<div class="relative group/dd">
						<a class="<?php echo $cls; ?> inline-flex items-center gap-0.5" href="<?php echo esc_url( $item['url'] ); ?>" aria-haspopup="true"><?php echo esc_html( $item['title'] ); ?><?php echo hh_icon( 'keyboard_arrow_down', 'text-[18px]' ); ?></a>
						<div class="absolute left-1/2 -translate-x-1/2 top-full pt-3 hidden group-hover/dd:block group-focus-within/dd:block">
							<ul class="w-56 bg-surface-container-lowest rounded-2xl border border-border-subtle shadow-xl p-2">
								<?php foreach ( $item['children'] as $c ) : ?>
									<li><a class="block px-3 py-2 rounded-lg text-body-sm hover:bg-sage-tint <?php echo $c['current'] ? 'text-forest-rich font-semibold' : 'text-text-ink'; ?>" href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['title'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?php else : ?>
					<a class="<?php echo $cls; ?>" href="<?php echo esc_url( $item['url'] ); ?>"<?php echo $item['current'] ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $item['title'] ); ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</nav>

		<div class="flex items-center gap-2 sm:gap-4 shrink-0">
			<a class="hidden xl:inline-flex items-center gap-1.5 text-forest-rich hover:text-secondary text-label-md font-label-md" href="tel:<?php echo esc_attr( HH_PHONE ); ?>">
				<?php echo hh_icon( 'phone_in_talk', 'text-[18px] text-healing-blue' ); ?> <?php echo esc_html( HH_PHONE_DISPLAY ); ?>
			</a>
			<a class="bg-forest-rich text-canvas-ivory hover:bg-primary-container px-4 sm:px-5 py-2.5 rounded-full text-label-md font-label-md transition-all duration-300 shadow-sm flex items-center gap-2" <?php echo hh_booking_attrs(); ?>>
				Book Now <?php echo hh_icon( 'calendar_today', 'text-[16px]' ); ?>
			</a>
			<details class="lg:hidden relative group/menu">
				<summary class="list-none cursor-pointer w-10 h-10 rounded-full border border-border-subtle flex items-center justify-center text-forest-rich" aria-label="Menu">
					<?php echo hh_icon( 'menu', 'group-open/menu:hidden' ); ?><?php echo hh_icon( 'close', 'hidden group-open/menu:inline-block' ); ?>
				</summary>
				<nav class="absolute right-0 mt-3 w-72 max-h-[75vh] overflow-y-auto bg-surface-container-lowest rounded-2xl border border-border-subtle shadow-xl p-3 flex flex-col" aria-label="Mobile">
					<?php foreach ( hh_nav_items() as $item ) : ?>
						<?php if ( '#' !== $item['url'] ) : ?>
							<a class="px-4 py-3 rounded-xl text-body-md hover:bg-sage-tint <?php echo $item['current'] ? 'text-forest-rich font-semibold' : 'text-text-ink'; ?>" href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
						<?php else : ?>
							<span class="px-4 pt-3 pb-1 text-label-sm font-label-sm uppercase text-text-muted"><?php echo esc_html( $item['title'] ); ?></span>
						<?php endif; ?>
						<?php foreach ( $item['children'] as $c ) : ?>
							<a class="pl-8 pr-4 py-2.5 rounded-xl text-body-sm hover:bg-sage-tint <?php echo $c['current'] ? 'text-forest-rich font-semibold' : 'text-text-ink'; ?>" href="<?php echo esc_url( $c['url'] ); ?>"><?php echo esc_html( $c['title'] ); ?></a>
						<?php endforeach; ?>
					<?php endforeach; ?>
					<a class="mt-2 px-4 py-3 rounded-xl bg-sage-tint text-forest-rich font-semibold flex items-center gap-2" href="tel:<?php echo esc_attr( HH_PHONE ); ?>"><?php echo hh_icon( 'call', 'text-[18px]' ); ?> <?php echo esc_html( HH_PHONE_DISPLAY ); ?></a>
				</nav>
			</details>
		</div>
	</div>
</header>
