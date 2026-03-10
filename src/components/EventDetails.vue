<template>
  <section class="relative overflow-hidden py-20 md:py-28 px-6 bg-ivory-dark/50">
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
      <div
        ref="ringRef"
        class="parallax-layer absolute top-6 left-[-5rem] h-56 w-56 rounded-full border border-gold/25"
        :style="ringStyle"
      ></div>
      <div
        ref="glowRef"
        class="parallax-layer absolute bottom-0 right-[-3rem] h-72 w-72 rounded-full bg-pink-light/45 blur-3xl"
        :style="glowStyle"
      ></div>
      <div
        ref="goldGlowRef"
        class="parallax-layer absolute top-1/3 right-1/4 h-32 w-32 rounded-full bg-gold/12 blur-3xl"
        :style="goldGlowStyle"
      ></div>
    </div>

    <div class="relative max-w-5xl mx-auto">
      <div ref="headerRef" class="parallax-layer mb-16" :style="headerStyle">
        <div class="text-center zoom-in-3d">
          <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Catat Tanggalnya</p>
          <h2 class="font-heading text-4xl md:text-5xl text-charcoal">Acara Pernikahan</h2>
        </div>
      </div>

      <div ref="gridRef" class="parallax-layer grid md:grid-cols-2 gap-8 stagger-children" :style="gridStyle">
        <div v-for="(event, index) in config.events" :key="index" class="flip-in bg-white rounded-2xl p-8 md:p-10 shadow-sm border border-gold/10 text-center card-3d relative overflow-hidden">
          <div class="w-16 h-16 mx-auto mb-6 rounded-full bg-pink-light/60 flex items-center justify-center">
            <svg v-if="event.icon === 'heart'" class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
            <svg v-else class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
            </svg>
          </div>
          <h3 class="font-heading text-2xl md:text-3xl text-charcoal mb-4">{{ event.title }}</h3>
          <div class="space-y-3 text-charcoal-light text-sm">
            <div class="flex items-center justify-center gap-2">
              <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
              </svg>
              <span>{{ event.date }}</span>
            </div>
            <div class="flex items-center justify-center gap-2">
              <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>{{ event.time }}</span>
            </div>
            <div class="flex items-center justify-center gap-2">
              <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
              </svg>
              <span>{{ event.location }}</span>
            </div>
          </div>
          <a
            :href="event.mapsUrl"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 mt-6 px-6 py-2.5 border border-gold text-gold text-xs tracking-[0.15em] uppercase rounded-full hover:bg-gold hover:text-white transition-all duration-300"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
            </svg>
            Buka di Google Maps
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import config from '../config.json'
import { useParallax } from '../composables/useParallax'

const ringRef = ref(null)
const glowRef = ref(null)
const goldGlowRef = ref(null)
const headerRef = ref(null)
const gridRef = ref(null)

const { parallaxStyle: ringStyle } = useParallax(ringRef, { maxOffset: 96, reverse: true })
const { parallaxStyle: glowStyle } = useParallax(glowRef, { maxOffset: 72 })
const { parallaxStyle: goldGlowStyle } = useParallax(goldGlowRef, { maxOffset: 52, reverse: true })
const { parallaxStyle: headerStyle } = useParallax(headerRef, { maxOffset: 24, reverse: true })
const { parallaxStyle: gridStyle } = useParallax(gridRef, { maxOffset: 36 })
</script>
