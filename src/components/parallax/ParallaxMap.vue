<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full watercolor-wash paper-texture">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbRef"
        class="p-layer absolute top-10 left-[-4rem] h-48 w-48 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(122,158,122,0.08), transparent 70%)' }"
      ></div>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="58" y="500" width="26" height="400" rx="5" opacity="0.85"/>
        <ellipse cx="71" cy="400" rx="86" ry="140" opacity="0.6"/>
        <ellipse cx="52" cy="338" rx="62" ry="102" opacity="0.5"/>
        <circle cx="126" cy="302" r="22" opacity="0.4"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="67" y="530" width="22" height="370" rx="5" opacity="0.75"/>
        <ellipse cx="78" cy="428" rx="76" ry="122" opacity="0.55"/>
        <ellipse cx="60" cy="372" rx="54" ry="86" opacity="0.45"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[6%] w-8 h-28 md:w-10 md:h-40" viewBox="0 0 40 160" fill="none" style="animation-duration: 10s">
        <path d="M20 0 Q16 28, 24 55 Q30 82, 17 110 Q13 138, 20 160" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M24 42 Q14 37, 12 47 Q18 45, 24 42Z" fill="var(--color-sage)" opacity="0.55"/>
        <circle cx="20" cy="58" r="3" fill="var(--color-sage-light)" opacity="0.45"/>
      </svg>
      <svg class="vine-hang right-[5%] w-6 h-22 md:w-8 md:h-32" viewBox="0 0 30 130" fill="none" style="animation-duration: 12s; animation-delay: -5s">
        <path d="M15 0 Q18 22, 11 44 Q7 66, 16 88 Q20 110, 15 130" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.6"/>
        <path d="M11 32 Q20 28, 22 36 Q17 34, 11 32Z" fill="var(--color-sage)" opacity="0.5"/>
      </svg>

      <!-- Floral corner — top right -->
      <svg class="absolute top-0 right-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 10s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.2"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.15"/>
        <circle cx="42" cy="32" r="7" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="28" cy="52" r="4.5" fill="var(--color-blush)" opacity="0.15"/>
      </svg>

      <!-- Floral corner — bottom left -->
      <svg class="absolute bottom-0 left-0 w-28 h-28 md:w-44 md:h-44 gentle-float" style="animation-duration: 9s; animation-delay: -3s; transform: scaleY(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <circle cx="35" cy="28" r="6" fill="var(--color-rose)" opacity="0.16"/>
      </svg>

      <!-- Leaf watercolor accent -->
      <svg class="leaf-accent top-0 right-0 w-24 h-24 gentle-float" style="animation-duration: 9s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M25 170 Q50 110, 90 75 Q70 110, 55 140 Q40 158, 25 170Z" fill="var(--color-sage)" opacity="0.1"/>
      </svg>
      <svg class="leaf-accent bottom-0 left-0 w-24 h-24 gentle-float" style="animation-duration: 8s; animation-delay: -4s; transform: scaleY(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 160 Q45 100, 80 70 Q60 100, 45 135 Q32 150, 20 160Z" fill="var(--color-sage-light)" opacity="0.08"/>
      </svg>
    </div>

    <div class="relative max-w-4xl mx-auto">
      <div class="text-center mb-12 reveal">
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Find Us</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Lokasi</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>
      </div>

      <div class="reveal floral-card overflow-hidden">
        <iframe
          :src="config.mapEmbed"
          class="w-full h-[300px] md:h-[400px]"
          style="border: 0; filter: contrast(1.05);"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Wedding venue location"
        ></iframe>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import config from '../../config.json'
import { useParallax } from '../../composables/useParallax'

const orbRef = ref(null)
const { parallaxStyle: orbStyle } = useParallax(orbRef, { maxOffset: 50, reverse: true })
</script>
