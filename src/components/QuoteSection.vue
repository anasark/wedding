<template>
  <section class="relative overflow-hidden py-20 md:py-28 px-6 bg-ivory-dark/50">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div
        ref="topOrbRef"
        class="parallax-layer absolute -top-20 right-[-4rem] h-56 w-56 rounded-full bg-gold/14 blur-3xl"
        :style="topOrbStyle"
      ></div>
      <div
        ref="bottomOrbRef"
        class="parallax-layer absolute -bottom-14 left-[-3rem] h-44 w-44 rounded-full bg-pink/35 blur-3xl"
        :style="bottomOrbStyle"
      ></div>
      <div
        ref="lineRef"
        class="parallax-layer absolute inset-y-10 left-1/2 hidden w-px -translate-x-1/2 bg-gradient-to-b from-transparent via-gold/25 to-transparent md:block"
        :style="lineStyle"
      ></div>
    </div>

    <div ref="contentRef" class="parallax-layer relative max-w-3xl mx-auto" :style="contentStyle">
      <div class="zoom-in-3d text-center">
        <svg class="w-8 h-8 text-gold mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
        <blockquote class="font-heading text-2xl md:text-3xl lg:text-4xl italic text-charcoal leading-relaxed mb-6">
          "{{ config.quote.text }}"
        </blockquote>
        <cite class="text-charcoal-light text-sm tracking-[0.2em] uppercase font-light not-italic">
          — {{ config.quote.source }}
        </cite>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import config from '../config.json'
import { useParallax } from '../composables/useParallax'

const topOrbRef = ref(null)
const bottomOrbRef = ref(null)
const lineRef = ref(null)
const contentRef = ref(null)

const { parallaxStyle: topOrbStyle } = useParallax(topOrbRef, { maxOffset: 88, reverse: true })
const { parallaxStyle: bottomOrbStyle } = useParallax(bottomOrbRef, { maxOffset: 64 })
const { parallaxStyle: lineStyle } = useParallax(lineRef, { maxOffset: 48, reverse: true })
const { parallaxStyle: contentStyle } = useParallax(contentRef, { maxOffset: 28, reverse: true })
</script>
