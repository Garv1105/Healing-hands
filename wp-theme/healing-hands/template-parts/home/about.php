<?php
// "We Provide Top Quality Physiotherapy Treatment": the 3 original paragraphs as a scroll story
// (sticky crossfading photo + progress ring, vertical line that fills as you scroll). Idea from the AI Studio draft.
$steps = hh_about();
?>
<section id="about" class="relative py-20 lg:py-28 overflow-clip" data-story>
	<?php echo hh_leaf( 'eucalyptus', 'hidden md:block -right-16 top-6 w-[260px] opacity-[.09]', -20 ); ?>
	<?php echo hh_leaf( 'monstera', 'hidden lg:block -left-32 top-1/3 w-[380px] opacity-[.05]', 20, 'hh-drift' ); ?>
	<div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<h2 class="hh-reveal max-w-3xl mb-14 text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink">We Provide Top Quality <span class="italic text-forest-rich">Physiotherapy</span> Treatment</h2>

		<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
			<div class="hidden lg:block lg:col-span-6 sticky top-28" aria-hidden="true">
				<div class="rounded-[2.25rem] bg-canvas-ivory/90 border border-border-subtle p-6 shadow-[0_18px_44px_-16px_rgba(27,59,43,0.12)] space-y-5">
					<div class="grid grid-cols-3 gap-2 p-1.5 rounded-full bg-surface-cream border border-border-subtle">
						<?php foreach ( $steps as $i => $s ) : ?>
							<button type="button" tabindex="-1" data-story-go="<?php echo $i; ?>" class="py-2 rounded-full text-label-md font-label-md transition-all <?php echo $i ? 'text-text-muted hover:text-text-ink' : 'bg-forest-rich text-canvas-ivory shadow-sm'; ?>">0<?php echo $i + 1; ?></button>
						<?php endforeach; ?>
					</div>
					<div class="relative rounded-[2rem_0.9rem_2rem_0.9rem] overflow-hidden aspect-[4/3] border border-border-subtle bg-surface-cream">
						<?php foreach ( $steps as $i => $s ) : ?>
							<?php echo hh_img( $s['img'], $s['alt'], 'large', 'absolute inset-0 w-full h-full object-cover transition-all duration-700 ' . ( $i ? 'opacity-0 scale-[1.04]' : 'opacity-100 scale-100' ), [ 'data-story-img' => $i, 'sizes' => '600px' ] ); ?>
						<?php endforeach; ?>
						<div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-text-ink/45 via-transparent to-transparent"></div>
						<svg viewBox="0 0 120 120" class="absolute top-4 right-4 w-16 h-16 text-canvas-ivory">
							<circle cx="60" cy="60" r="46" fill="#1C2520" fill-opacity=".35" stroke="currentColor" stroke-opacity=".3" stroke-width="2"/>
							<circle data-story-ring cx="60" cy="60" r="46" fill="none" stroke="#E2ECE5" stroke-width="2.5" stroke-linecap="round" transform="rotate(-90 60 60)" stroke-dasharray="289" stroke-dashoffset="<?php echo round( 289 * ( 1 - 1 / count( $steps ) ) ); ?>" class="transition-[stroke-dashoffset] duration-500"/>
							<text data-story-num x="60" y="67" text-anchor="middle" fill="#FBF9F5" font-family="Playfair Display, serif" font-size="20">01</text>
						</svg>
						<p data-story-caption class="absolute bottom-4 left-4 right-4 rounded-2xl px-4 py-3 bg-canvas-ivory/85 backdrop-blur-md border border-white/70 font-serif text-title-md text-forest-rich"><?php echo esc_html( $steps[0]['title'] ); ?></p>
					</div>
				</div>
			</div>

			<div class="lg:col-span-6 relative pl-7 sm:pl-10">
				<div class="absolute left-1.5 sm:left-2.5 top-3 bottom-6 w-[2px] bg-border-subtle rounded-full overflow-hidden" aria-hidden="true">
					<div data-story-line class="w-full h-full bg-gradient-to-b from-forest-rich via-secondary to-healing-blue origin-top scale-y-0"></div>
				</div>
				<ol class="space-y-10 lg:space-y-28">
					<?php foreach ( $steps as $i => $s ) : ?>
						<li data-story-step="<?php echo $i; ?>" data-title="<?php echo esc_attr( $s['title'] ); ?>" class="group/step relative<?php echo $i ? '' : ' is-active'; ?>">
							<span class="absolute -left-[27px] sm:-left-[35px] top-8 w-4 h-4 rounded-full border-2 bg-canvas-ivory border-secondary transition-all duration-300 group-[.is-active]/step:bg-forest-rich group-[.is-active]/step:border-healing-blue group-[.is-active]/step:ring-4 group-[.is-active]/step:ring-sage-tint" aria-hidden="true"></span>
							<div class="rounded-[1.75rem] p-6 sm:p-8 border transition-all duration-500 bg-canvas-ivory/80 border-border-subtle group-[.is-active]/step:bg-white group-[.is-active]/step:border-secondary/40 group-[.is-active]/step:shadow-[0_14px_38px_-14px_rgba(27,59,43,0.12)]">
								<span class="font-serif text-[40px] leading-none text-secondary/40 group-[.is-active]/step:text-gold transition-colors" aria-hidden="true">0<?php echo $i + 1; ?></span>
								<h3 class="font-serif italic text-headline-sm text-forest-rich mt-2"><?php echo esc_html( $s['title'] ); ?></h3>
								<div class="lg:hidden relative mt-5 rounded-2xl overflow-hidden aspect-[4/3] border border-border-subtle">
									<?php echo hh_img( $s['img'], $s['alt'], 'medium_large', 'w-full h-full object-cover', [ 'sizes' => '100vw' ] ); ?>
								</div>
								<p class="mt-4 text-body-md text-text-muted"><?php echo esc_html( $s['text'] ); ?></p>
							</div>
						</li>
					<?php endforeach; ?>
				</ol>
			</div>
		</div>

		<div class="hh-reveal mt-20 bg-forest-rich text-canvas-ivory rounded-[2.5rem_1.25rem_2.5rem_1.25rem] p-8 sm:p-12 relative overflow-hidden shadow-xl">
			<div class="absolute top-0 right-0 w-96 h-96 bg-secondary/30 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
			<div class="hh-topo absolute inset-0 opacity-40 [filter:brightness(3.2)] pointer-events-none" aria-hidden="true"></div>
			<div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
				<h3 class="lg:col-span-4 text-headline-lg-mobile md:text-headline-lg font-headline-lg text-surface-container-lowest">Expert <span class="italic">Physiotherapists</span></h3>
				<div class="lg:col-span-8">
					<?php // Video loads only when clicked (the original autoplayed it, adding ~1 MB to every visit). ?>
					<button type="button" data-youtube="<?php echo esc_attr( HH_YOUTUBE_ID ); ?>" class="group relative block w-full aspect-video rounded-2xl overflow-hidden border border-white/15 bg-black" aria-label="Play video: Expert Physiotherapists">
						<img class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity" src="https://i.ytimg.com/vi/<?php echo esc_attr( HH_YOUTUBE_ID ); ?>/hqdefault.jpg" alt="" loading="lazy" width="480" height="360">
						<span class="absolute inset-0 flex items-center justify-center">
							<span class="w-16 h-16 rounded-full bg-canvas-ivory text-forest-rich flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform"><?php echo hh_icon( 'play_arrow', 'text-[36px]' ); ?></span>
						</span>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
