<template>
  <section ref="sectionRef" class="relative overflow-hidden py-28 md:py-40 px-6 w-full watercolor-wash paper-texture">
    <!-- Parallax background orbs -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbTopRef"
        class="p-layer absolute -top-20 right-[-6rem] h-72 w-72 rounded-full blur-3xl"
        :style="{ ...orbTopStyle, background: 'radial-gradient(circle, rgba(196,145,138,0.12), transparent 70%)' }"
      ></div>
      <div
        ref="orbBotRef"
        class="p-layer absolute -bottom-16 left-[-4rem] h-56 w-56 rounded-full blur-3xl"
        :style="{ ...orbBotStyle, background: 'radial-gradient(circle, rgba(143,166,143,0.1), transparent 70%)' }"
      ></div>
      <div
        ref="lineRef"
        class="p-layer absolute inset-y-10 left-1/2 hidden w-px -translate-x-1/2 bg-gradient-to-b from-transparent via-sage/20 to-transparent md:block"
        :style="lineStyle"
      ></div>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="58" y="500" width="26" height="400" rx="5" opacity="0.85"/>
        <ellipse cx="71" cy="400" rx="88" ry="145" opacity="0.6"/>
        <ellipse cx="52" cy="340" rx="65" ry="105" opacity="0.5"/>
        <circle cx="130" cy="310" r="25" opacity="0.4"/>
        <circle cx="18" cy="270" r="18" opacity="0.35"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="68" y="530" width="22" height="370" rx="5" opacity="0.75"/>
        <ellipse cx="79" cy="430" rx="78" ry="125" opacity="0.55"/>
        <ellipse cx="62" cy="370" rx="55" ry="90" opacity="0.45"/>
        <circle cx="135" cy="340" r="20" opacity="0.35"/>
      </svg>

      <!-- Floral corner — top left -->
      <svg class="absolute top-0 left-0 w-36 h-36 md:w-52 md:h-52 gentle-float" style="animation-duration: 12s" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.2"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.15"/>
        <path d="M0 15 Q20 50, 15 85 Q10 55, 0 30Z" fill="var(--color-sage-light)" opacity="0.18"/>
        <circle cx="45" cy="35" r="8" fill="var(--color-rose)" opacity="0.2"/>
        <circle cx="30" cy="55" r="5" fill="var(--color-blush)" opacity="0.15"/>
        <circle cx="55" cy="60" r="4" fill="var(--color-rose-light)" opacity="0.18"/>
        <path d="M40 30 Q42 20, 50 18 Q46 25, 40 30Z" fill="var(--color-sage)" opacity="0.22"/>
        <path d="M20 70 Q25 60, 35 58 Q28 65, 20 70Z" fill="var(--color-sage)" opacity="0.18"/>
      </svg>

      <!-- Floral corner — top right -->
      <svg class="absolute top-0 right-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 10s; animation-delay: -3s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <path d="M10 0 Q45 35, 50 70 Q40 40, 25 18Z" fill="var(--color-sage)" opacity="0.15"/>
        <circle cx="40" cy="30" r="7" fill="var(--color-rose)" opacity="0.2"/>
        <circle cx="25" cy="50" r="4" fill="var(--color-blush)" opacity="0.15"/>
        <path d="M35 25 Q38 15, 46 14 Q40 22, 35 25Z" fill="var(--color-sage-light)" opacity="0.2"/>
      </svg>
      <!-- Scattered petals -->
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
        <div class="petal-inner" :style="{ animationDuration: (2.5 + Math.random() * 2) + 's' }">
          <svg :class="p.colorClass" :style="{ opacity: p.opacity }" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.5 2 2 6.5 2 12c5 0 10-4 10-10zm0 20c5.5 0 10-4.5 10-10-5 0-10 4-10 10z"/>
          </svg>
        </div>
      </div>

      <!-- Floating hearts -->
      <div
        v-for="h in hearts"
        :key="'heart-'+h.id"
        class="floating-heart"
        :style="{ left: h.x + '%', width: h.size + 'px', height: h.size + 'px', animationDuration: h.duration + 's', animationDelay: h.delay + 's' }"
      >
        <svg :style="{ opacity: h.opacity }" viewBox="0 0 24 24" :fill="h.color" class="w-full h-full">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
      </div>

      <!-- Hanging vine -->
      <svg class="vine-hang left-[5%] w-8 h-28 md:w-10 md:h-44" viewBox="0 0 40 180" fill="none" style="animation-duration: 10s">
        <path d="M20 0 Q15 30, 22 60 Q28 90, 18 120 Q14 150, 20 180" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M22 45 Q14 40, 12 50 Q17 48, 22 45Z" fill="var(--color-sage)" opacity="0.6"/>
        <path d="M18 100 Q26 95, 28 105 Q23 102, 18 100Z" fill="var(--color-sage-light)" opacity="0.55"/>
      </svg>
      <svg class="vine-hang right-[6%] w-6 h-24 md:w-8 md:h-36" viewBox="0 0 30 150" fill="none" style="animation-duration: 12s; animation-delay: -5s">
        <path d="M15 0 Q18 25, 12 50 Q8 75, 16 100 Q20 125, 15 150" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.65"/>
        <path d="M12 35 Q20 30, 22 40 Q17 38, 12 35Z" fill="var(--color-sage)" opacity="0.55"/>
      </svg>
    </div>

    <div ref="contentRef" class="p-layer relative max-w-3xl mx-auto" :style="contentStyle">
      <div class="reveal text-center">
        <!-- Bismillah calligraphy -->
        <div class="mb-6">
          <p class="font-heading text-2xl md:text-3xl text-sage/50 leading-relaxed" style="font-style: italic;">
            ﷽
          </p>
        </div>

        <!-- Floral ornament divider -->
        <div class="floral-divider mb-8">
          <svg class="w-10 h-10 text-sage/40" viewBox="0 0 100 100" fill="currentColor">
            <path d="M50 20 C42 35, 30 40, 20 40 C30 48, 35 55, 35 65 C42 55, 48 50, 50 45 C52 50, 58 55, 65 65 C65 55, 70 48, 80 40 C70 40, 58 35, 50 20Z"/>
            <circle cx="50" cy="42" r="4"/>
            <path d="M35 75 Q50 60, 65 75" fill="none" stroke="currentColor" stroke-width="1.5"/>
          </svg>
        </div>

        <!-- Decorative quote mark -->
        <div class="mb-8">
          <svg class="w-12 h-12 text-sage/30 mx-auto" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.71 11 13.229 11 15.006c0 1.792-1.339 3.315-3.208 3.315-1.066 0-2.149-.472-3.209-1zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.71 21 13.229 21 15.006c0 1.792-1.339 3.315-3.208 3.315-1.066 0-2.149-.472-3.209-1z"/>
          </svg>
        </div>

        <blockquote class="font-heading text-2xl md:text-3xl lg:text-4xl italic text-cream/80 leading-relaxed mb-8">
          "{{ config.quote.text }}"
        </blockquote>

        <div class="flex items-center justify-center gap-4">
          <span class="h-px w-8 bg-sage/40"></span>
          <cite class="text-sage/80 text-xs tracking-[0.3em] uppercase font-light not-italic">
            {{ config.quote.source }}
          </cite>
          <span class="h-px w-8 bg-sage/40"></span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import config from '../../config.json'
import { useParallax } from '../../composables/useParallax'

const orbTopRef = ref(null)
const orbBotRef = ref(null)
const lineRef = ref(null)
const contentRef = ref(null)

const { parallaxStyle: orbTopStyle } = useParallax(orbTopRef, { maxOffset: 80, reverse: true })
const { parallaxStyle: orbBotStyle } = useParallax(orbBotRef, { maxOffset: 60 })
const { parallaxStyle: lineStyle } = useParallax(lineRef, { maxOffset: 40, reverse: true })
const { parallaxStyle: contentStyle } = useParallax(contentRef, { maxOffset: 30, reverse: true })

const petalColors = ['text-rose', 'text-gold', 'text-sage']
const petals = Array.from({ length: 6 }, (_, i) => ({
  id: i,
  x: 10 + Math.random() * 80,
  size: 10 + Math.random() * 14,
  duration: 14 + Math.random() * 16,
  delay: Math.random() * 12,
  opacity: 0.2 + Math.random() * 0.25,
  colorClass: petalColors[i % 3],
}))

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)']
const hearts = Array.from({ length: 6 }, (_, i) => ({
  id: i,
  x: 8 + Math.random() * 84,
  size: 20 + Math.random() * 22,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 3],
}))
</script>
