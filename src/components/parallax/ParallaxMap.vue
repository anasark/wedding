<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbRef"
        class="p-layer absolute top-10 left-[-4rem] h-48 w-48 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(143,166,143,0.08), transparent 70%)' }"
      ></div>
      <!-- Floral corners -->
      <svg class="absolute top-0 right-0 w-24 h-24 text-gold/[0.06]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleX(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
    </div>

    <div class="relative max-w-4xl mx-auto">
      <div class="text-center mb-12 reveal">
        <p class="text-gold/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Find Us</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Lokasi</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-gold/60 to-transparent"></div>
      </div>

      <div class="reveal glass-card ornament-corners rounded-2xl overflow-hidden">
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
