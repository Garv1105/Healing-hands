<?php $symptoms = hh_symptoms(); $first = array_key_first( $symptoms ); ?>
<section id="symptom-explorer" class="hh-topo scroll-mt-24 relative py-20 lg:py-28 bg-surface-container-low/70 border-y border-border-subtle overflow-hidden">
	<?php echo hh_leaf( 'monstera', 'hidden md:block -left-32 bottom-0 w-[400px] opacity-[.06]', 30 ); ?>
	<div class="hh-reveal max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
		<div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
			<h2 class="text-headline-lg-mobile md:text-headline-lg font-headline-lg text-text-ink">Treatment by Symptoms</h2>
			<a class="inline-flex items-center gap-2 border border-secondary text-forest-rich hover:bg-sage-tint px-6 py-3 rounded-full text-label-md font-label-md transition-all w-fit bg-canvas-ivory/70" href="<?php echo hh_url( '/symptoms/' ); ?>">Explore all <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch" data-tabs>
			<?php // Anatomical region selector (idea from the AI Studio draft). Hotspots mirror the pill tabs below them. ?>
			<div class="lg:col-span-5 flex flex-col rounded-[2rem_0.75rem_2rem_0.75rem] bg-canvas-ivory/90 border border-border-subtle p-6 sm:p-8 shadow-[0_8px_32px_-8px_rgba(27,59,43,0.06)]">
				<div class="flex items-center justify-between gap-4 pb-4 border-b border-border-subtle">
					<span class="text-label-md font-label-md text-text-ink">Anatomical Region Selector</span>
					<span class="text-xs text-text-muted"><?php echo count( $symptoms ); ?> Clinical Zones</span>
				</div>
				<div class="relative my-4 flex items-center justify-center">
					<svg viewBox="0 0 320 460" class="w-full max-w-[260px] h-auto select-none" aria-hidden="true">
						<defs>
							<radialGradient id="hh-glow" cx="50%" cy="50%" r="50%">
								<stop offset="0%" stop-color="#3B7A8C" stop-opacity=".45"/><stop offset="55%" stop-color="#3B7A8C" stop-opacity=".14"/><stop offset="100%" stop-color="#3B7A8C" stop-opacity="0"/>
							</radialGradient>
						</defs>
						<line x1="160" y1="20" x2="160" y2="440" stroke="#E5E1D8" stroke-dasharray="3 5"/>
						<circle cx="160" cy="230" r="138" fill="none" stroke="#E2ECE5"/>
						<g fill="#F5F1E9" stroke="#55635B" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
							<ellipse cx="160" cy="44" rx="22" ry="27"/>
							<path d="M150 69 L150 86 M170 69 L170 86"/>
							<path d="M150 86 C128 89, 102 96, 94 116 C86 136, 80 182, 74 228 C72 240, 82 244, 88 234 C96 196, 103 156, 114 132 L120 202 C121 224, 118 242, 121 264 L126 346 L130 422 C131 432, 145 432, 147 422 L152 344 L156 268 L164 268 L168 344 L173 422 C175 432, 189 432, 190 422 L194 346 L199 264 C202 242, 199 224, 200 202 L206 132 C217 156, 224 196, 232 234 C238 244, 248 240, 246 228 C240 182, 234 136, 226 116 C218 96, 192 89, 170 86 Z"/>
							<path d="M160 76 L160 222" stroke="#5E8B71" stroke-width="1.4" stroke-dasharray="2 4" fill="none"/>
							<path d="M126 226 Q160 244 194 226" stroke="#5E8B71" stroke-width="1.2" fill="none"/>
						</g>
						<?php foreach ( $symptoms as $key => $s ) : ?>
							<g class="hh-spot cursor-pointer<?php echo $key === $first ? ' is-active' : ''; ?>" data-tab="tab-sym-<?php echo $key; ?>">
								<circle class="hh-spot-glow" cx="<?php echo $s['x']; ?>" cy="<?php echo $s['y']; ?>" r="30" fill="url(#hh-glow)"/>
								<circle cx="<?php echo $s['x']; ?>" cy="<?php echo $s['y']; ?>" r="20" fill="transparent"/>
								<circle class="hh-spot-ring" cx="<?php echo $s['x']; ?>" cy="<?php echo $s['y']; ?>" r="9"/>
								<circle class="hh-spot-core" cx="<?php echo $s['x']; ?>" cy="<?php echo $s['y']; ?>" r="3.6"/>
							</g>
						<?php endforeach; ?>
					</svg>
				</div>
				<div class="mt-auto grid grid-cols-2 gap-2 pt-4 border-t border-border-subtle" role="tablist" aria-label="Symptoms">
					<?php foreach ( $symptoms as $key => $s ) : $on = $key === $first; ?>
						<button type="button" role="tab" id="tab-sym-<?php echo $key; ?>" aria-controls="panel-sym-<?php echo $key; ?>" aria-selected="<?php echo $on ? 'true' : 'false'; ?>" tabindex="<?php echo $on ? '0' : '-1'; ?>"
							class="flex items-center justify-center gap-1.5 px-3 py-2.5 rounded-full text-label-md font-label-md transition-all bg-surface-cream text-text-ink hover:bg-sage-tint aria-selected:bg-forest-rich aria-selected:text-canvas-ivory aria-selected:shadow-sm">
							<?php echo hh_icon( $s['icon'], 'text-[18px]' ); ?> <?php echo esc_html( $s['label'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="lg:col-span-7 bg-surface-container-lowest rounded-[2rem_0.75rem_2rem_0.75rem] border border-border-subtle shadow-md overflow-hidden flex flex-col">
				<?php echo hh_img( '/wp-content/uploads/2022/10/Conditions-Treated.webp', 'Conditions Treated - Healing Hands Advanced Physiotherapy Clinic', 'large', 'w-full aspect-[16/7] object-cover', [ 'sizes' => '(min-width: 1024px) 680px, 100vw' ] ); ?>
				<?php foreach ( $symptoms as $key => $s ) : ?>
					<div role="tabpanel" id="panel-sym-<?php echo $key; ?>" aria-labelledby="tab-sym-<?php echo $key; ?>" <?php echo $key === $first ? '' : 'hidden'; ?> class="hh-panel p-6 sm:p-9">
						<h3 class="text-headline-md font-headline-md text-forest-rich mb-4"><?php echo esc_html( $s['label'] ); ?></h3>
						<p class="text-body-md font-body-md text-text-muted mb-6"><?php echo esc_html( $s['text'] ); ?></p>
						<a class="inline-flex items-center gap-2 px-5 py-2.5 bg-forest-rich text-canvas-ivory text-label-md font-label-md rounded-full hover:bg-primary-container transition-all" href="<?php echo hh_url( $s['url'] ); ?>">Know More<span class="sr-only"> about <?php echo esc_html( $s['label'] ); ?></span> <?php echo hh_icon( 'arrow_forward', 'text-[16px]' ); ?></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
