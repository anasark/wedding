<template>
  <section class="relative overflow-hidden py-16 md:py-24 px-6 w-full">
    <!-- Background -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep via-forest/20 to-deep"></div>
      <!-- Floral corner decorations -->
      <svg class="absolute top-0 left-0 w-32 h-32 md:w-44 md:h-44 text-rose/[0.08]" viewBox="0 0 200 200" fill="currentColor">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
        <circle cx="30" cy="30" r="4" opacity="0.4"/>
      </svg>
      <svg class="absolute top-0 right-0 w-32 h-32 md:w-44 md:h-44 text-sage/[0.08]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleX(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
        <circle cx="30" cy="30" r="4" opacity="0.4"/>
      </svg>
      <!-- Floating petals background -->
      <div
        v-for="p in petals"
        :key="p.id"
        class="petal"
        :style="{
          left: p.x + '%',
          width: p.size + 'px',
          height: p.size + 'px',
          animationDuration: p.duration + 's',
          animationDelay: p.delay + 's',
        }"
      >
        <div class="petal-inner" :style="{ animationDuration: (2 + Math.random() * 2) + 's' }">
          <svg :class="p.colorClass" :style="{ opacity: p.opacity }" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.5 2 2 6.5 2 12c5 0 10-4 10-10zm0 20c5.5 0 10-4.5 10-10-5 0-10 4-10 10z"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="relative max-w-5xl mx-auto">
      <!-- Section header -->
      <div class="text-center mb-12 md:mb-16 reveal">
        <p class="text-gold/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Happy Couple</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Mempelai</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-gold/60 to-transparent"></div>

        <!-- Wedding rings ornament -->
        <div class="mt-6 flex items-center justify-center">
          <svg class="w-16 h-10 text-gold/30" viewBox="0 0 120 60" fill="none" stroke="currentColor" stroke-width="2">
            <ellipse cx="42" cy="30" rx="22" ry="22"/>
            <ellipse cx="78" cy="30" rx="22" ry="22"/>
            <!-- Diamond on top -->
            <path d="M60 8 L55 16 L60 24 L65 16 Z" fill="currentColor" opacity="0.3"/>
          </svg>
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-10 md:gap-16 items-center">
        <!-- Groom -->
        <div class="reveal-left text-center">
          <div class="relative inline-block mb-6">
            <!-- Decorative ring behind photo -->
            <div class="absolute -inset-3 rounded-full border border-gold/15 breathe"></div>
            <div class="absolute -inset-6 rounded-full border border-sage/10 breathe" style="animation-delay: -2s"></div>
            <!-- Floral frame accent -->
            <svg class="absolute -top-4 -left-4 w-10 h-10 text-gold/20" viewBox="0 0 40 40" fill="currentColor">
              <path d="M20 2 C15 8, 8 15, 2 20 C8 20, 15 18, 20 12 C20 18, 18 20, 12 20 C18 25, 20 32, 20 38 C20 32, 22 25, 28 20 C22 20, 20 18, 20 12 C25 18, 32 20, 38 20 C32 15, 25 8, 20 2Z" opacity="0.5"/>
            </svg>
            <div class="w-40 h-40 md:w-56 md:h-56 rounded-full overflow-hidden border-2 border-gold/40 shadow-xl mx-auto">
              <div class="w-full h-full bg-gradient-to-b from-forest to-forest-light flex items-center justify-center">
                <!-- Animated groom avatar -->
                <svg class="w-32 h-32 md:w-44 md:h-44 gentle-float" style="animation-duration: 4s" viewBox="0 0 200 200" fill="none">
                  <!-- Shadow -->
                  <ellipse cx="100" cy="192" rx="35" ry="5" fill="#3d3a36" opacity="0.15"/>
                  <!-- Body / Suit -->
                  <path d="M62 128 Q62 108, 100 105 Q138 108, 138 128 L144 192 L56 192Z" fill="#3d3a36"/>
                  <!-- Suit lapels -->
                  <path d="M84 108 L95 135 L100 120" fill="#4a4640"/>
                  <path d="M116 108 L105 135 L100 120" fill="#4a4640"/>
                  <!-- Shirt V -->
                  <path d="M92 110 L100 132 L108 110" fill="#faf8f5"/>
                  <!-- Tie -->
                  <path d="M97.5 116 L100 142 L102.5 116 L100 112Z" fill="var(--color-gold)"/>
                  <ellipse cx="100" cy="113" rx="3.5" ry="2" fill="var(--color-gold)"/>
                  <!-- Pocket square -->
                  <path d="M124 124 L127 118 L130 124 L127 122Z" fill="var(--color-gold)" opacity="0.6"/>
                  <!-- Suit buttons -->
                  <circle cx="100" cy="148" r="1.5" fill="#4a4640"/>
                  <circle cx="100" cy="158" r="1.5" fill="#4a4640"/>
                  <!-- Neck -->
                  <rect x="93" y="92" width="14" height="16" rx="7" fill="#deb887"/>
                  <!-- Head -->
                  <ellipse cx="100" cy="66" rx="29" ry="32" fill="#deb887"/>
                  <!-- Ears -->
                  <ellipse cx="71" cy="68" rx="5" ry="7" fill="#d4a76a"/>
                  <ellipse cx="129" cy="68" rx="5" ry="7" fill="#d4a76a"/>
                  <!-- Peci -->
                  <path d="M73 56 Q73 30, 100 27 Q127 30, 127 56" fill="#2a2724"/>
                  <rect x="73" y="50" width="54" height="9" rx="1.5" fill="#2a2724"/>
                  <line x1="86" y1="50" x2="86" y2="59" stroke="#3d3a36" stroke-width="0.5"/>
                  <line x1="100" y1="50" x2="100" y2="59" stroke="#3d3a36" stroke-width="0.5"/>
                  <line x1="114" y1="50" x2="114" y2="59" stroke="#3d3a36" stroke-width="0.5"/>
                  <!-- Eyebrows -->
                  <path d="M83 60 Q88 57, 93 60" stroke="#3d3a36" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                  <path d="M107 60 Q112 57, 117 60" stroke="#3d3a36" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                  <!-- Eyes -->
                  <circle cx="88" cy="68" r="3.5" fill="#3d3a36"/>
                  <circle cx="112" cy="68" r="3.5" fill="#3d3a36"/>
                  <circle cx="89.5" cy="66.5" r="1.2" fill="white"/>
                  <circle cx="113.5" cy="66.5" r="1.2" fill="white"/>
                  <!-- Nose -->
                  <path d="M98 74 Q100 77, 102 74" stroke="#c8a87a" stroke-width="1" fill="none" stroke-linecap="round"/>
                  <!-- Smile -->
                  <path d="M90 81 Q100 89, 110 81" stroke="#3d3a36" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                  <path d="M93 83 Q100 87, 107 83" fill="#c4918a" opacity="0.25"/>
                </svg>
              </div>
            </div>
          </div>
          <h3 class="font-heading text-3xl md:text-4xl text-cream mb-2">{{ config.groom.name }}</h3>
          <p class="text-cream/50 text-sm mb-3">{{ config.groom.parentOf }}</p>
          <p class="font-heading text-lg text-gold/80">{{ config.groom.parents }}</p>
        </div>

        <!-- Bride -->
        <div class="reveal-right text-center">
          <div class="relative inline-block mb-6">
            <div class="absolute -inset-3 rounded-full border border-rose/15 breathe"></div>
            <div class="absolute -inset-6 rounded-full border border-gold/10 breathe" style="animation-delay: -2s"></div>
            <!-- Floral frame accent -->
            <svg class="absolute -top-4 -right-4 w-10 h-10 text-rose/20" viewBox="0 0 40 40" fill="currentColor">
              <path d="M20 2 C15 8, 8 15, 2 20 C8 20, 15 18, 20 12 C20 18, 18 20, 12 20 C18 25, 20 32, 20 38 C20 32, 22 25, 28 20 C22 20, 20 18, 20 12 C25 18, 32 20, 38 20 C32 15, 25 8, 20 2Z" opacity="0.5"/>
            </svg>
            <div class="w-40 h-40 md:w-56 md:h-56 rounded-full overflow-hidden border-2 border-rose/40 shadow-xl mx-auto">
              <div class="w-full h-full bg-gradient-to-b from-forest to-forest-light flex items-center justify-center">
                <!-- Animated bride avatar -->
                <svg class="w-32 h-32 md:w-44 md:h-44 gentle-float" style="animation-duration: 4.5s" viewBox="0 0 200 200" fill="none">
                  <!-- Shadow -->
                  <ellipse cx="100" cy="192" rx="38" ry="5" fill="#3d3a36" opacity="0.12"/>
                  <!-- Dress -->
                  <path d="M68 125 Q68 110, 100 107 Q132 110, 132 125 L148 192 L52 192Z" fill="#faf8f5"/>
                  <!-- Dress lace overlay -->
                  <path d="M75 140 Q100 148, 125 140" fill="none" stroke="var(--color-gold)" stroke-width="0.7" opacity="0.3"/>
                  <path d="M70 155 Q100 163, 130 155" fill="none" stroke="var(--color-gold)" stroke-width="0.7" opacity="0.25"/>
                  <path d="M65 170 Q100 178, 135 170" fill="none" stroke="var(--color-gold)" stroke-width="0.7" opacity="0.2"/>
                  <!-- Dress neckline -->
                  <path d="M80 110 Q100 120, 120 110" fill="none" stroke="var(--color-gold)" stroke-width="1.2" opacity="0.5"/>
                  <!-- Gold belt/sash -->
                  <path d="M72 128 Q100 132, 128 128" stroke="var(--color-gold)" stroke-width="2" fill="none" opacity="0.4"/>
                  <circle cx="100" cy="130" r="3" fill="var(--color-gold)" opacity="0.5"/>
                  <!-- Hijab back drape -->
                  <path d="M55 65 Q52 38, 100 26 Q148 38, 145 65 Q148 105, 138 135 L62 135 Q52 105, 55 65Z" fill="var(--color-sage)" opacity="0.45"/>
                  <!-- Neck -->
                  <rect x="93" y="90" width="14" height="16" rx="7" fill="#f0d0c0"/>
                  <!-- Head -->
                  <ellipse cx="100" cy="66" rx="28" ry="30" fill="#f0d0c0"/>
                  <!-- Hijab front -->
                  <path d="M60 66 Q58 40, 100 30 Q142 40, 140 66 Q140 78, 136 88 Q128 80, 100 78 Q72 80, 64 88 Q60 78, 60 66Z" fill="var(--color-sage)" opacity="0.7"/>
                  <!-- Hijab edge highlight -->
                  <path d="M62 66 Q60 42, 100 32 Q140 42, 138 66" fill="none" stroke="var(--color-gold)" stroke-width="1" opacity="0.4"/>
                  <!-- Hijab inner frame -->
                  <path d="M66 70 Q65 48, 100 38 Q135 48, 134 70 Q132 78, 100 76 Q68 78, 66 70Z" fill="var(--color-sage)" opacity="0.3"/>
                  <!-- Hijab decorations -->
                  <circle cx="100" cy="33" r="2.5" fill="var(--color-gold)" opacity="0.5"/>
                  <circle cx="92" cy="36" r="1.5" fill="var(--color-gold)" opacity="0.35"/>
                  <circle cx="108" cy="36" r="1.5" fill="var(--color-gold)" opacity="0.35"/>
                  <circle cx="86" cy="41" r="1" fill="var(--color-gold)" opacity="0.25"/>
                  <circle cx="114" cy="41" r="1" fill="var(--color-gold)" opacity="0.25"/>
                  <!-- Eyebrows -->
                  <path d="M84 58 Q89 55, 94 58" stroke="#5a4a3a" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                  <path d="M106 58 Q111 55, 116 58" stroke="#5a4a3a" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                  <!-- Eyes -->
                  <ellipse cx="89" cy="66" rx="3" ry="3.5" fill="#3d3a36"/>
                  <ellipse cx="111" cy="66" rx="3" ry="3.5" fill="#3d3a36"/>
                  <circle cx="90.2" cy="64.5" r="1.2" fill="white"/>
                  <circle cx="112.2" cy="64.5" r="1.2" fill="white"/>
                  <!-- Eyelashes -->
                  <path d="M85.5 62 L84 59.5" stroke="#3d3a36" stroke-width="1" stroke-linecap="round"/>
                  <path d="M88 61 L87.5 58.5" stroke="#3d3a36" stroke-width="1" stroke-linecap="round"/>
                  <path d="M91 62 L92 59.5" stroke="#3d3a36" stroke-width="1" stroke-linecap="round"/>
                  <path d="M109 62 L108 59.5" stroke="#3d3a36" stroke-width="1" stroke-linecap="round"/>
                  <path d="M112 61 L112.5 58.5" stroke="#3d3a36" stroke-width="1" stroke-linecap="round"/>
                  <path d="M114.5 62 L116 59.5" stroke="#3d3a36" stroke-width="1" stroke-linecap="round"/>
                  <!-- Blush -->
                  <ellipse cx="82" cy="72" rx="5" ry="3" fill="#c4918a" opacity="0.2"/>
                  <ellipse cx="118" cy="72" rx="5" ry="3" fill="#c4918a" opacity="0.2"/>
                  <!-- Nose -->
                  <path d="M98 72 Q100 75, 102 72" stroke="#d4a890" stroke-width="1" fill="none" stroke-linecap="round"/>
                  <!-- Smile -->
                  <path d="M92 79 Q100 86, 108 79" stroke="#c4918a" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                  <path d="M95 81 Q100 84, 105 81" fill="#c4918a" opacity="0.2"/>
                  <!-- Necklace -->
                  <path d="M85 98 Q100 105, 115 98" stroke="var(--color-gold)" stroke-width="1" fill="none" opacity="0.5"/>
                  <circle cx="100" cy="104" r="2" fill="var(--color-gold)" opacity="0.5"/>
                </svg>
              </div>
            </div>
          </div>
          <h3 class="font-heading text-3xl md:text-4xl text-cream mb-2">{{ config.bride.name }}</h3>
          <p class="text-cream/50 text-sm mb-3">{{ config.bride.parentOf }}</p>
          <p class="font-heading text-lg text-rose/80">{{ config.bride.parents }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import config from '../../config.json'

const colors = ['text-gold', 'text-rose', 'text-sage', 'text-blush']
const petals = Array.from({ length: 12 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 10 + Math.random() * 16,
  duration: 12 + Math.random() * 18,
  delay: Math.random() * 15,
  opacity: 0.2 + Math.random() * 0.3,
  colorClass: colors[i % 4],
}))
</script>
