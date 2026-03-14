<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full watercolor-wash paper-texture">
    <!-- Background with parallax gradient -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep via-forest/20 to-deep"></div>
      <div
        ref="bgOrbRef"
        class="p-layer absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-3xl"
        :style="{ ...bgOrbStyle, background: 'radial-gradient(circle, rgba(122,158,122,0.06), transparent 70%)' }"
      ></div>
      <!-- Leaf watercolor accents -->
      <svg class="leaf-accent top-0 left-0 w-28 h-28 md:w-40 md:h-40 gentle-float" style="animation-duration: 10s" viewBox="0 0 200 200" fill="none">
        <path d="M25 170 Q50 110, 90 75 Q70 110, 55 140 Q40 158, 25 170Z" fill="var(--color-sage)" opacity="0.1"/>
        <circle cx="95" cy="70" r="4" fill="var(--color-rose)" opacity="0.12"/>
      </svg>
      <svg class="leaf-accent bottom-0 right-0 w-28 h-28 md:w-40 md:h-40 gentle-float" style="animation-duration: 8s; animation-delay: -3s; transform: scale(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 160 Q45 100, 80 70 Q60 100, 45 135 Q32 150, 20 160Z" fill="var(--color-sage-light)" opacity="0.08"/>
      </svg>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="55" y="500" width="28" height="400" rx="5" opacity="0.9"/>
        <ellipse cx="69" cy="400" rx="90" ry="150" opacity="0.65"/>
        <ellipse cx="50" cy="330" rx="65" ry="110" opacity="0.55"/>
        <circle cx="130" cy="300" r="25" opacity="0.45"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="65" y="530" width="24" height="370" rx="5" opacity="0.8"/>
        <ellipse cx="77" cy="430" rx="80" ry="130" opacity="0.6"/>
        <ellipse cx="60" cy="370" rx="55" ry="90" opacity="0.5"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[6%] w-8 h-28 md:w-10 md:h-44" viewBox="0 0 40 180" fill="none" style="animation-duration: 10s">
        <path d="M20 0 Q15 30, 22 60 Q28 90, 18 120 Q14 150, 20 180" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M22 45 Q12 40, 10 50 Q16 48, 22 45Z" fill="var(--color-sage)" opacity="0.6"/>
        <path d="M18 105 Q28 100, 30 110 Q25 108, 18 105Z" fill="var(--color-sage-light)" opacity="0.5"/>
        <circle cx="20" cy="65" r="3.5" fill="var(--color-sage-light)" opacity="0.45"/>
      </svg>
      <svg class="vine-hang right-[5%] w-6 h-24 md:w-8 md:h-36" viewBox="0 0 30 150" fill="none" style="animation-duration: 12s; animation-delay: -5s">
        <path d="M15 0 Q18 25, 12 50 Q8 75, 16 100 Q20 125, 15 150" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.6"/>
        <path d="M12 35 Q20 30, 22 40 Q17 38, 12 35Z" fill="var(--color-sage)" opacity="0.5"/>
      </svg>

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

      <!-- Sparkles -->
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
        <svg class="w-full h-full text-sage" viewBox="0 0 24 24" fill="currentColor">
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
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Countdown</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Menuju Hari Bahagia</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>
        <!-- Floral ornament under heading -->
        <div class="mt-5 flex items-center justify-center">
          <svg class="w-24 h-6 text-sage/25" viewBox="0 0 200 40" fill="currentColor">
            <path d="M100 5 C90 15, 75 20, 60 18 C70 22, 80 25, 85 35 C90 25, 95 22, 100 18 C105 22, 110 25, 115 35 C120 25, 130 22, 140 18 C125 20, 110 15, 100 5Z"/>
            <circle cx="100" cy="18" r="3"/>
            <path d="M40 20 Q70 20, 85 32" fill="none" stroke="currentColor" stroke-width="1" opacity="0.5"/>
            <path d="M160 20 Q130 20, 115 32" fill="none" stroke="currentColor" stroke-width="1" opacity="0.5"/>
          </svg>
        </div>
      </div>

      <div class="reveal grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8 max-w-2xl mx-auto stagger">
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-sage font-bold tracking-tight">
            {{ timeLeft.days }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Hari</span>
        </div>
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-sage font-bold tracking-tight">
            {{ timeLeft.hours }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Jam</span>
        </div>
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-sage font-bold tracking-tight">
            {{ timeLeft.minutes }}
          </span>
          <span class="text-cream/40 text-xs tracking-[0.2em] uppercase mt-2 block">Menit</span>
        </div>
        <div class="countdown-block rounded-2xl p-6 md:p-8 text-center reveal">
          <span class="block font-heading text-5xl md:text-6xl lg:text-7xl text-sage font-bold tracking-tight">
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

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)', 'var(--color-rose-dark)']
const hearts = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 20 + Math.random() * 22,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 4],
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
