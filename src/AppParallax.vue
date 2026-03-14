<script setup>
import { ref, nextTick } from 'vue'
import config from './config.json'
import ParallaxHero from './components/parallax/ParallaxHero.vue'
import ParallaxQuote from './components/parallax/ParallaxQuote.vue'
import ParallaxCouple from './components/parallax/ParallaxCouple.vue'
import ParallaxTimeline from './components/parallax/ParallaxTimeline.vue'
import ParallaxCountdown from './components/parallax/ParallaxCountdown.vue'
import ParallaxRSVP from './components/parallax/ParallaxRSVP.vue'
import ParallaxGuestbook from './components/parallax/ParallaxGuestbook.vue'
import ParallaxGift from './components/parallax/ParallaxGift.vue'
import ParallaxMap from './components/parallax/ParallaxMap.vue'
import ParallaxFooter from './components/parallax/ParallaxFooter.vue'

const opened = ref(false)
const containerRef = ref(null)
const audioRef = ref(null)
const isMuted = ref(false)
let observer = null

function toggleMusic() {
  const audio = audioRef.value
  if (!audio) return
  if (audio.paused) {
    audio.play().catch(() => {})
    isMuted.value = false
  } else {
    isMuted.value = !isMuted.value
    audio.muted = isMuted.value
  }
}

const ANIMATED_SELECTORS = '.reveal, .reveal-left, .reveal-right, .reveal-scale, .reveal-rotate, .clip-reveal'

function observeElements() {
  observer?.disconnect()
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) entry.target.classList.add('visible')
      })
    },
    { threshold: 0.1 }
  )
  document.querySelectorAll(ANIMATED_SELECTORS).forEach((el) => observer.observe(el))
}

function openInvitation() {
  opened.value = true
  nextTick(() => {
    const container = containerRef.value
    const quote = document.getElementById('quote')
    if (container && quote) {
      container.scrollTo({ top: quote.offsetTop, behavior: 'smooth' })
    }
    observeElements()
    // Start music on user interaction
    const audio = audioRef.value
    if (audio) {
      audio.volume = 0.4
      audio.play().catch(() => {})
    }
  })
}
</script>

<template>
  <div ref="containerRef" class="snap-container bg-deep">
    <!-- Background Music -->
    <audio ref="audioRef" loop preload="auto" :src="config.song"></audio>

    <!-- Music Toggle -->
    <button
      v-if="opened"
      @click="toggleMusic"
      class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full flex items-center justify-center shadow-lg transition-all duration-300 hover:scale-110"
      style="background: rgba(255,255,255,0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(122,158,122,0.3);"
      :title="isMuted ? 'Unmute' : 'Mute'"
    >
      <!-- Music playing icon -->
      <svg v-if="!isMuted" class="w-5 h-5 text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
      </svg>
      <!-- Muted icon -->
      <svg v-else class="w-5 h-5 text-cream/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75L19.5 12m0 0l2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6l4.72-3.535a.75.75 0 011.28.53v14.51a.75.75 0 01-1.28.53L6.75 14.25H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" />
      </svg>
    </button>

    <ParallaxHero :opened="opened" @open="openInvitation" />

    <template v-if="opened">
      <div id="quote" class="snap-page">
        <ParallaxQuote />
      </div>
      <div class="snap-page-auto">
        <ParallaxCouple />
      </div>
      <div class="snap-end"></div>
      <div class="snap-page-auto">
        <ParallaxTimeline />
      </div>
      <div class="snap-end"></div>
      <div class="snap-page">
        <ParallaxCountdown />
      </div>
      <div class="snap-page-auto">
        <ParallaxRSVP />
      </div>
      <div class="snap-end"></div>
      <div class="snap-page-auto">
        <ParallaxGuestbook />
      </div>
      <div class="snap-end"></div>
      <div class="snap-page-auto">
        <ParallaxGift />
      </div>
      <div class="snap-end"></div>
      <div class="snap-page">
        <ParallaxMap />
      </div>
      <div class="snap-page">
        <ParallaxFooter />
      </div>
    </template>
  </div>
</template>



