<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full">
    <!-- Background with parallax gradient -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep via-forest/20 to-deep"></div>
      <div
        ref="bgOrbRef"
        class="p-layer absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-3xl"
        :style="{ ...bgOrbStyle, background: 'radial-gradient(circle, rgba(176,141,87,0.06), transparent 70%)' }"
      ></div>
      <!-- Floral corners -->
      <svg class="absolute top-0 left-0 w-28 h-28 md:w-40 md:h-40 text-rose/[0.08]" viewBox="0 0 200 200" fill="currentColor">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <svg class="absolute bottom-0 right-0 w-28 h-28 md:w-40 md:h-40 text-sage/[0.08]" viewBox="0 0 200 200" fill="currentColor" style="transform: scale(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <!-- Golden sparkles -->
      <div
        v-for="s in sparkles"
        :key="s.id"
        class="sparkle"
        :style="{
          left: s.x + '%',
          top: s.y + '%',
          width: s.size + 'px',
          height: s.size + 'px',
          animationDuration: s.duration + 's',
          animationDelay: s.delay + 's',
        }"
      >
        <svg class="w-full h-full text-gold" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 0L14.59 8.41L23 12L14.59 15.59L12 24L9.41 15.59L1 12L9.41 8.41Z"/>
        </svg>
      </div>
      <!-- Falling petals -->
      <div
        v-for="p in petals"
        :key="'petal-'+p.id"
        class="petal"
        :style="{ left: p.x + '%', width: p.size + 'px', height: p.size + 'px', animationDuration: p.duration + 's', animationDelay: p.delay + 's' }"
      >
        <div class="petal-inner" :style="{ animationDuration: (2 + Math.random() * 2) + 's' }">
          <svg :class="p.colorClass" :style="{ opacity: p.opacity }" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.5 2 2 6.5 2 12c5 0 10-4 10-10zm0 20c5.5 0 10-4.5 10-10-5 0-10 4-10 10z"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="relative max-w-4xl mx-auto text-center">
      <div class="mb-16 reveal">
        <p class="text-gold/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Countdown</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Menuju Hari Bahagia</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-gold/60 to-transparent"></div>
        <!-- Floral ornament under heading -->
        <div class="mt-5 flex items-center justify-center">
          <svg class="w-24 h-6 text-gold/25" viewBox="0 0 200 40" fill="currentColor">
            <path d="M100 5 C90 15, 75 20, 60 18 C70 22, 80 25, 85 35 C90 25, 95 22, 100 18 C105 22, 110 25, 115 35 C120 25, 130 22, 140 18 C125 20, 110 15, 100 5Z"/>
            <circle cx="100" cy="18" r="3"/>
            <path d="M40 20 Q70 20, 85 32" fill="none" stroke="currentColor" stroke-width="1" opacity="0.5"/>
            <path d="M160 20 Q130 20, 115 32" fill="none" stroke="currentColor" stroke-width="1" opacity="0.5"/>
          </svg>
        </div>
      </div>

      <div class="reveal grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 max-w-2xl mx-auto stagger">
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-gold font-bold tracking-tight">
            {{ timeLeft.days }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Hari</span>
        </div>
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-gold font-bold tracking-tight">
            {{ timeLeft.hours }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Jam</span>
        </div>
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-gold font-bold tracking-tight">
            {{ timeLeft.minutes }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Menit</span>
        </div>
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-gold font-bold tracking-tight">
            {{ timeLeft.seconds }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Detik</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import config from '../../config.json'
import { useParallax } from '../../composables/useParallax'

const bgOrbRef = ref(null)
const { parallaxStyle: bgOrbStyle } = useParallax(bgOrbRef, { maxOffset: 40, reverse: true })

const sparkles = Array.from({ length: 16 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  y: 5 + Math.random() * 90,
  size: 4 + Math.random() * 8,
  duration: 2 + Math.random() * 4,
  delay: Math.random() * 6,
}))

const petalColors = ['text-rose', 'text-gold', 'text-sage']
const petals = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 10 + Math.random() * 14,
  duration: 14 + Math.random() * 16,
  delay: Math.random() * 12,
  opacity: 0.2 + Math.random() * 0.25,
  colorClass: petalColors[i % 3],
}))

const weddingDate = new Date(config.countdownTarget)
const timeLeft = ref({ days: 0, hours: 0, minutes: 0, seconds: 0 })
let timer = null

function updateCountdown() {
  const now = new Date()
  const diff = Math.max(0, weddingDate - now)
  timeLeft.value = {
    days: Math.floor(diff / (1000 * 60 * 60 * 24)),
    hours: Math.floor((diff / (1000 * 60 * 60)) % 24),
    minutes: Math.floor((diff / (1000 * 60)) % 60),
    seconds: Math.floor((diff / 1000) % 60),
  }
}

onMounted(() => {
  updateCountdown()
  timer = setInterval(updateCountdown, 1000)
})

onUnmounted(() => {
  clearInterval(timer)
})
</script>
