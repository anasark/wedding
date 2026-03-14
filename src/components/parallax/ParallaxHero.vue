<template>
  <section ref="sectionRef" class="parallax-section paper-texture" style="perspective: 1200px">
    <!-- Layered parallax backgrounds -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Base gradient — warm cream/sage -->
      <div
        class="parallax-bg p-layer"
        :style="{ transform: `translate3d(0, ${scrollY * 0.1}px, 0)` }"
      >
        <div class="absolute inset-0 bg-gradient-to-b from-deep via-deep-light to-forest"></div>
      </div>

      <!-- Watercolor washes -->
      <div
        class="p-layer absolute -top-32 -right-32 w-[500px] h-[500px] rounded-full breathe"
        :style="{ transform: `translate3d(${mouseX * -20}px, ${scrollY * 0.1 + mouseY * -20}px, 0)`, background: 'radial-gradient(circle, rgba(196,145,138,0.12), transparent 70%)' }"
      ></div>
      <div
        class="p-layer absolute -bottom-48 -left-48 w-[600px] h-[600px] rounded-full breathe"
        :style="{ transform: `translate3d(${mouseX * 15}px, ${scrollY * 0.15 + mouseY * 15}px, 0)`, animationDelay: '-2s', background: 'radial-gradient(circle, rgba(122,158,122,0.1), transparent 70%)' }"
      ></div>
      <div
        class="p-layer absolute top-1/3 left-1/4 w-[400px] h-[400px] rounded-full breathe"
        :style="{ transform: `translate3d(${mouseX * 10}px, ${mouseY * 10}px, 0)`, animationDelay: '-4s', background: 'radial-gradient(circle, rgba(240,217,213,0.12), transparent 70%)' }"
      ></div>

      <!-- Leaf watercolor illustrations — top-left cluster -->
      <svg class="leaf-accent top-0 left-0 w-44 h-44 md:w-64 md:h-64 gentle-float" style="animation-duration: 8s" viewBox="0 0 200 200" fill="none">
        <!-- Main leaf -->
        <path d="M20 180 Q40 120, 80 80 Q100 60, 120 50 Q100 70, 90 100 Q80 130, 70 160 Q50 170, 20 180Z" fill="var(--color-sage)" opacity="0.15"/>
        <path d="M25 175 Q45 120, 85 82" stroke="var(--color-sage)" stroke-width="0.8" fill="none" opacity="0.2"/>
        <!-- Small leaf -->
        <path d="M60 140 Q80 110, 110 95 Q90 115, 75 135 Q68 138, 60 140Z" fill="var(--color-sage-light)" opacity="0.12"/>
        <!-- Tiny buds -->
        <circle cx="115" cy="48" r="4" fill="var(--color-rose)" opacity="0.15"/>
        <circle cx="125" cy="55" r="3" fill="var(--color-rose-light)" opacity="0.12"/>
        <circle cx="108" cy="58" r="2.5" fill="var(--color-blush)" opacity="0.15"/>
      </svg>

      <!-- Leaf watercolor — top-right -->
      <svg class="leaf-accent top-0 right-0 w-40 h-40 md:w-56 md:h-56 gentle-float" style="animation-duration: 9s; animation-delay: -3s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 180 Q40 120, 80 80 Q100 60, 120 50 Q100 70, 90 100 Q80 130, 70 160 Q50 170, 20 180Z" fill="var(--color-sage)" opacity="0.12"/>
        <path d="M25 175 Q45 120, 85 82" stroke="var(--color-sage-dark)" stroke-width="0.7" fill="none" opacity="0.15"/>
        <circle cx="115" cy="48" r="5" fill="var(--color-rose)" opacity="0.12"/>
        <circle cx="105" cy="60" r="3" fill="var(--color-rose-light)" opacity="0.1"/>
      </svg>

      <!-- Rose watercolor — bottom-left -->
      <svg class="rose-accent bottom-0 left-0 w-36 h-36 md:w-52 md:h-52 gentle-float" style="animation-duration: 10s; animation-delay: -5s; transform: scaleY(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M30 170 Q50 130, 80 100 Q60 120, 50 145 Q40 160, 30 170Z" fill="var(--color-sage)" opacity="0.1"/>
        <circle cx="90" cy="90" r="12" fill="var(--color-rose)" opacity="0.08"/>
        <circle cx="85" cy="85" r="6" fill="var(--color-rose-light)" opacity="0.1"/>
      </svg>

      <!-- Rose watercolor — bottom-right -->
      <svg class="rose-accent bottom-0 right-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 7s; animation-delay: -2s; transform: scale(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 180 Q50 130, 90 90 Q70 120, 55 150 Q40 165, 20 180Z" fill="var(--color-sage-light)" opacity="0.1"/>
        <circle cx="95" cy="85" r="8" fill="var(--color-blush)" opacity="0.1"/>
      </svg>

      <!-- Tree silhouette — left side (parallax layer) -->
      <div
        class="tree-bg-left"
        :style="{ transform: `translate3d(${mouseX * -8}px, ${scrollY * 0.15}px, 0)` }"
      >
        <svg viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet" class="w-full h-full">
          <!-- Trunk -->
          <rect x="60" y="450" width="35" height="450" rx="5" opacity="0.9"/>
          <!-- Main canopy -->
          <ellipse cx="78" cy="350" rx="120" ry="180" opacity="0.7"/>
          <ellipse cx="60" cy="300" rx="90" ry="140" opacity="0.6"/>
          <ellipse cx="100" cy="280" rx="80" ry="120" opacity="0.55"/>
          <!-- Branch clusters -->
          <ellipse cx="30" cy="200" rx="55" ry="80" opacity="0.5"/>
          <ellipse cx="130" cy="230" rx="60" ry="70" opacity="0.45"/>
          <ellipse cx="50" cy="420" rx="70" ry="50" opacity="0.55"/>
          <!-- Small leaves -->
          <circle cx="20" cy="150" r="25" opacity="0.4"/>
          <circle cx="160" cy="270" r="20" opacity="0.4"/>
          <circle cx="10" cy="320" r="18" opacity="0.35"/>
        </svg>
      </div>

      <!-- Tree silhouette — right side (parallax layer) -->
      <div
        class="tree-bg-right"
        :style="{ transform: `scaleX(-1) translate3d(${mouseX * 8}px, ${scrollY * 0.12}px, 0)` }"
      >
        <svg viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet" class="w-full h-full">
          <rect x="70" y="500" width="30" height="400" rx="5" opacity="0.8"/>
          <ellipse cx="85" cy="400" rx="100" ry="160" opacity="0.65"/>
          <ellipse cx="70" cy="350" rx="75" ry="120" opacity="0.55"/>
          <ellipse cx="110" cy="320" rx="70" ry="100" opacity="0.5"/>
          <ellipse cx="40" cy="250" rx="50" ry="70" opacity="0.45"/>
          <ellipse cx="140" cy="280" rx="55" ry="65" opacity="0.4"/>
          <circle cx="25" cy="200" r="22" opacity="0.35"/>
          <circle cx="150" cy="230" r="18" opacity="0.3"/>
        </svg>
      </div>

      <!-- Hanging vine — left -->
      <svg class="vine-hang left-[8%] md:left-[12%] w-12 h-48 md:w-16 md:h-64" viewBox="0 0 60 250" fill="none" style="animation-duration: 10s">
        <path d="M30 0 Q25 40, 30 80 Q35 120, 28 160 Q22 200, 30 240" stroke="var(--color-sage)" stroke-width="2.5" fill="none" opacity="0.8"/>
        <circle cx="28" cy="80" r="6" fill="var(--color-sage-light)" opacity="0.6"/>
        <circle cx="32" cy="160" r="5" fill="var(--color-sage-light)" opacity="0.5"/>
        <circle cx="27" cy="120" r="4" fill="var(--color-sage)" opacity="0.45"/>
        <!-- Leaf shapes on vine -->
        <path d="M30 60 Q15 50, 12 68 Q22 62, 30 60Z" fill="var(--color-sage)" opacity="0.6"/>
        <path d="M28 130 Q43 120, 46 140 Q36 135, 28 130Z" fill="var(--color-sage)" opacity="0.55"/>
        <path d="M30 200 Q13 190, 10 210 Q20 205, 30 200Z" fill="var(--color-sage-light)" opacity="0.5"/>
      </svg>

      <!-- Hanging vine — right -->
      <svg class="vine-hang right-[10%] md:right-[15%] w-10 h-40 md:w-14 md:h-56" viewBox="0 0 60 220" fill="none" style="animation-duration: 12s; animation-delay: -4s">
        <path d="M30 0 Q35 35, 28 70 Q22 110, 32 150 Q38 190, 30 220" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <circle cx="30" cy="70" r="5" fill="var(--color-sage-light)" opacity="0.5"/>
        <circle cx="28" cy="150" r="4" fill="var(--color-sage)" opacity="0.45"/>
        <path d="M28 50 Q42 42, 46 58 Q36 54, 28 50Z" fill="var(--color-sage)" opacity="0.5"/>
        <path d="M32 110 Q18 102, 14 118 Q23 114, 32 110Z" fill="var(--color-sage)" opacity="0.45"/>
      </svg>

      <!-- Floating hearts -->
      <div
        v-for="h in hearts"
        :key="'heart-'+h.id"
        class="floating-heart"
        :style="{
          left: h.x + '%',
          width: h.size + 'px',
          height: h.size + 'px',
          animationDuration: h.duration + 's',
          animationDelay: h.delay + 's',
        }"
      >
        <svg :style="{ opacity: h.opacity, animationDelay: h.delay + 's' }" viewBox="0 0 24 24" :fill="h.color" class="w-full h-full">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
      </div>

      <!-- Falling rose petals -->
      <div
        v-for="p in petals"
        :key="'petal-'+p.id"
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

      <!-- Floating particles -->
      <div
        v-for="p in particles"
        :key="p.id"
        class="absolute"
        :class="p.cssClass"
        :style="{
          width: p.size + 'px',
          height: p.size + 'px',
          left: p.x + '%',
          top: p.y + '%',
          animationName: 'float-drift',
          animationDuration: p.duration + 's',
          animationDelay: p.delay + 's',
          animationIterationCount: 'infinite',
          animationTimingFunction: 'ease-in-out',
          opacity: p.opacity,
        }"
      >
        <svg v-if="p.isPetal" class="w-full h-full" :style="{ color: 'inherit', opacity: 0.5 }" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 2C6.5 2 2 6.5 2 12c5 0 10-4 10-10zm0 20c5.5 0 10-4.5 10-10-5 0-10 4-10 10z"/>
        </svg>
        <span v-else class="block w-full h-full rounded-full bg-current"></span>
      </div>

      <!-- Golden sparkles -->
      <div
        v-for="s in sparkles"
        :key="'sparkle-'+s.id"
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
    </div>

    <!-- Content -->
    <div
      class="relative z-10 text-center px-6 max-w-3xl"
      :style="{ transform: `perspective(1200px) rotateX(${mouseY * -1}deg) rotateY(${mouseX * 1}deg) translateZ(20px)` }"
    >
      <!-- Ornamental floral frame top -->
      <div class="hero-fade-up hero-d1 flex items-center justify-center gap-3 mb-6">
        <svg class="w-20 h-5 text-sage/50" viewBox="0 0 160 30" fill="none">
          <path d="M80 15 Q60 8, 30 12 Q15 14, 0 15" stroke="currentColor" stroke-width="0.8" fill="none"/>
          <path d="M45 11 Q42 6, 36 8 Q40 10, 42 15" fill="currentColor" opacity="0.3"/>
          <path d="M25 13 Q22 9, 18 11 Q21 13, 22 16" fill="currentColor" opacity="0.25"/>
          <circle cx="50" cy="10" r="2.5" fill="var(--color-rose)" opacity="0.3"/>
          <circle cx="35" cy="13" r="1.5" fill="var(--color-blush)" opacity="0.3"/>
        </svg>
        <svg class="w-10 h-10 text-sage/40" viewBox="0 0 80 80" fill="none">
          <!-- Central rosebud -->
          <circle cx="40" cy="40" r="8" fill="var(--color-rose)" opacity="0.2"/>
          <circle cx="40" cy="40" r="4" fill="var(--color-rose-light)" opacity="0.3"/>
          <path d="M40 20 Q35 30, 32 40 Q35 35, 40 32 Q45 35, 48 40 Q45 30, 40 20Z" fill="currentColor" opacity="0.25"/>
          <path d="M25 45 Q32 42, 40 48 Q32 50, 25 45Z" fill="currentColor" opacity="0.2"/>
          <path d="M55 45 Q48 42, 40 48 Q48 50, 55 45Z" fill="currentColor" opacity="0.2"/>
        </svg>
        <svg class="w-20 h-5 text-sage/50" viewBox="0 0 160 30" fill="none" style="transform: scaleX(-1)">
          <path d="M80 15 Q60 8, 30 12 Q15 14, 0 15" stroke="currentColor" stroke-width="0.8" fill="none"/>
          <path d="M45 11 Q42 6, 36 8 Q40 10, 42 15" fill="currentColor" opacity="0.3"/>
          <path d="M25 13 Q22 9, 18 11 Q21 13, 22 16" fill="currentColor" opacity="0.25"/>
          <circle cx="50" cy="10" r="2.5" fill="var(--color-rose)" opacity="0.3"/>
          <circle cx="35" cy="13" r="1.5" fill="var(--color-blush)" opacity="0.3"/>
        </svg>
      </div>

      <p class="hero-fade-up hero-d2 text-sage/70 text-xs tracking-[0.4em] uppercase mb-6 font-light">
        The Wedding of
      </p>

      <h1 class="hero-fade-up hero-d3 font-heading text-6xl md:text-8xl lg:text-9xl font-bold mb-2 leading-none">
        <span class="shimmer-text">{{ config.groom.nickname }}</span>
      </h1>

      <div class="hero-fade-up hero-d4 flex items-center justify-center gap-6 my-6">
        <span class="h-px w-16 bg-gradient-to-r from-transparent to-sage/40"></span>
        <span class="font-heading text-3xl text-sage italic">&</span>
        <span class="h-px w-16 bg-gradient-to-l from-transparent to-sage/40"></span>
      </div>

      <h1 class="hero-fade-up hero-d4 font-heading text-6xl md:text-8xl lg:text-9xl font-bold mb-8 leading-none">
        <span class="shimmer-text">{{ config.bride.nickname }}</span>
      </h1>

      <p class="hero-fade-up hero-d5 text-cream/50 tracking-[0.25em] text-sm font-light" :class="guestName ? 'mb-8' : 'mb-12'">
        {{ config.dateShort }}
      </p>

      <!-- Guest name from URL -->
      <div v-if="guestName && !opened" class="hero-fade-up hero-d6 mb-8">
        <p class="text-cream/40 text-xs tracking-[0.3em] uppercase mb-2">Kepada</p>
        <p class="font-heading text-2xl md:text-3xl text-cream">{{ guestName }}</p>
      </div>

      <button
        v-if="!opened"
        @click="$emit('open')"
        class="hero-fade-up hero-d6 group relative inline-flex items-center gap-3 px-10 py-4 text-sm tracking-[0.2em] uppercase rounded-full transition-all duration-500 overflow-hidden shadow-lg"
        style="background: linear-gradient(135deg, var(--color-sage-dark), var(--color-sage), var(--color-sage-dark)); color: #fdfcfa;"
      >
        <span class="relative z-10 font-medium">Buka Undangan</span>
        <svg class="relative z-10 w-4 h-4 transition-transform group-hover:translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
        <div class="absolute inset-0 bg-gradient-to-r from-sage-light via-sage to-sage-light opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      </button>
    </div>

    <!-- Scroll indicator -->
    <div v-if="opened" class="absolute bottom-8 left-1/2 -translate-x-1/2 hero-fade-up hero-d6">
      <div class="w-6 h-10 border-2 border-sage/40 rounded-full flex justify-center pt-2">
        <div class="w-1 h-2 bg-sage/60 rounded-full animate-bounce"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import config from '../../config.json'

defineProps({ opened: Boolean })
defineEmits(['open'])

const guestName = computed(() => {
  const params = new URLSearchParams(window.location.search)
  return params.get('to') || ''
})

const sectionRef = ref(null)
const mouseX = ref(0)
const mouseY = ref(0)
const scrollY = ref(0)

const particles = Array.from({ length: 15 }, (_, i) => ({
  id: i,
  size: i % 3 === 0 ? 8 + Math.random() * 10 : 2 + Math.random() * 4,
  x: Math.random() * 100,
  y: Math.random() * 100,
  cssClass: i % 4 === 0 ? 'text-gold' : i % 4 === 1 ? 'text-sage' : i % 4 === 2 ? 'text-rose' : 'text-blush',
  isPetal: i % 3 === 0,
  duration: 10 + Math.random() * 20,
  delay: Math.random() * 10,
  opacity: 0.2 + Math.random() * 0.35,
}))

const petalColors = ['text-rose', 'text-blush', 'text-gold', 'text-sage']
const petals = Array.from({ length: 12 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 12 + Math.random() * 18,
  duration: 10 + Math.random() * 15,
  delay: Math.random() * 12,
  opacity: 0.25 + Math.random() * 0.3,
  colorClass: petalColors[i % 4],
}))

const sparkles = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  x: 10 + Math.random() * 80,
  y: 10 + Math.random() * 80,
  size: 4 + Math.random() * 6,
  duration: 2 + Math.random() * 3,
  delay: Math.random() * 5,
}))

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)', 'var(--color-rose-dark)']
const hearts = Array.from({ length: 10 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 18 + Math.random() * 24,
  duration: 10 + Math.random() * 14,
  delay: Math.random() * 12,
  opacity: 0.35 + Math.random() * 0.4,
  color: heartColors[i % 4],
}))

function onMouseMove(e) {
  if (!sectionRef.value) return
  const rect = sectionRef.value.getBoundingClientRect()
  mouseX.value = ((e.clientX - rect.left) / rect.width - 0.5) * 2
  mouseY.value = ((e.clientY - rect.top) / rect.height - 0.5) * 2
}

function onScroll() {
  const container = document.querySelector('.snap-container')
  scrollY.value = container ? container.scrollTop : window.scrollY
}

onMounted(() => {
  window.addEventListener('mousemove', onMouseMove)
  const container = document.querySelector('.snap-container')
  if (container) {
    container.addEventListener('scroll', onScroll, { passive: true })
  }
  window.addEventListener('scroll', onScroll, { passive: true })
})

onUnmounted(() => {
  window.removeEventListener('mousemove', onMouseMove)
  const container = document.querySelector('.snap-container')
  if (container) {
    container.removeEventListener('scroll', onScroll)
  }
  window.removeEventListener('scroll', onScroll)
})
</script>
