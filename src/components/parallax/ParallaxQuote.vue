<template>
  <section ref="sectionRef" class="relative overflow-hidden py-28 md:py-40 px-6 w-full">
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
        class="p-layer absolute inset-y-10 left-1/2 hidden w-px -translate-x-1/2 bg-gradient-to-b from-transparent via-gold/20 to-transparent md:block"
        :style="lineStyle"
      ></div>
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
    </div>

    <div ref="contentRef" class="p-layer relative max-w-3xl mx-auto" :style="contentStyle">
      <div class="reveal text-center">
        <!-- Bismillah calligraphy -->
        <div class="mb-6">
          <p class="font-heading text-2xl md:text-3xl text-gold/40 leading-relaxed" style="font-style: italic;">
            ﷽
          </p>
        </div>

        <!-- Floral ornament divider -->
        <div class="floral-divider mb-8">
          <svg class="w-10 h-10 text-gold/40" viewBox="0 0 100 100" fill="currentColor">
            <path d="M50 20 C42 35, 30 40, 20 40 C30 48, 35 55, 35 65 C42 55, 48 50, 50 45 C52 50, 58 55, 65 65 C65 55, 70 48, 80 40 C70 40, 58 35, 50 20Z"/>
            <circle cx="50" cy="42" r="4"/>
            <path d="M35 75 Q50 60, 65 75" fill="none" stroke="currentColor" stroke-width="1.5"/>
          </svg>
        </div>

        <!-- Decorative quote mark -->
        <div class="mb-8">
          <svg class="w-12 h-12 text-gold/30 mx-auto" viewBox="0 0 24 24" fill="currentColor">
            <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.71 11 13.229 11 15.006c0 1.792-1.339 3.315-3.208 3.315-1.066 0-2.149-.472-3.209-1zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.71 21 13.229 21 15.006c0 1.792-1.339 3.315-3.208 3.315-1.066 0-2.149-.472-3.209-1z"/>
          </svg>
        </div>

        <blockquote class="font-heading text-2xl md:text-3xl lg:text-4xl italic text-cream/80 leading-relaxed mb-8">
          "{{ config.quote.text }}"
        </blockquote>

        <div class="flex items-center justify-center gap-4">
          <span class="h-px w-8 bg-gold/40"></span>
          <cite class="text-gold/80 text-xs tracking-[0.3em] uppercase font-light not-italic">
            {{ config.quote.source }}
          </cite>
          <span class="h-px w-8 bg-gold/40"></span>
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
</script>
