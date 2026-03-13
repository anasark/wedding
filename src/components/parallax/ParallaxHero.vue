<template>
  <section ref="sectionRef" class="parallax-section" style="perspective: 1200px">
    <!-- Layered parallax backgrounds -->
    <div class="absolute inset-0 overflow-hidden">
      <!-- Light elegant background gradient -->
      <div
        class="parallax-bg p-layer"
        :style="{ transform: `translate3d(0, ${scrollY * 0.1}px, 0)` }"
      >
        <div class="absolute inset-0 bg-gradient-to-b from-deep via-forest to-deep"></div>
      </div>

      <!-- Soft blush circles -->
      <div
        class="p-layer absolute -top-32 -right-32 w-[500px] h-[500px] rounded-full breathe"
        :style="{ transform: `translate3d(${mouseX * -20}px, ${scrollY * 0.1 + mouseY * -20}px, 0)`, background: 'radial-gradient(circle, rgba(196,145,138,0.15), transparent 70%)' }"
      ></div>
      <div
        class="p-layer absolute -bottom-48 -left-48 w-[600px] h-[600px] rounded-full breathe"
        :style="{ transform: `translate3d(${mouseX * 15}px, ${scrollY * 0.15 + mouseY * 15}px, 0)`, animationDelay: '-2s', background: 'radial-gradient(circle, rgba(143,166,143,0.12), transparent 70%)' }"
      ></div>
      <div
        class="p-layer absolute top-1/3 left-1/4 w-[400px] h-[400px] rounded-full breathe"
        :style="{ transform: `translate3d(${mouseX * 10}px, ${mouseY * 10}px, 0)`, animationDelay: '-4s', background: 'radial-gradient(circle, rgba(176,141,87,0.08), transparent 70%)' }"
      ></div>

      <!-- Floral corner decorations -->
      <svg class="absolute top-0 left-0 w-40 h-40 md:w-56 md:h-56 text-gold/[0.12]" viewBox="0 0 200 200" fill="currentColor">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
        <circle cx="35" cy="35" r="5" opacity="0.4"/>
        <path d="M10 70 C20 55, 35 50, 50 55 C35 60, 25 65, 10 70Z" opacity="0.3"/>
        <path d="M70 10 C55 20, 50 35, 55 50 C60 35, 65 25, 70 10Z" opacity="0.3"/>
      </svg>
      <svg class="absolute top-0 right-0 w-40 h-40 md:w-56 md:h-56 text-rose/[0.12]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleX(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
        <circle cx="35" cy="35" r="5" opacity="0.4"/>
        <path d="M10 70 C20 55, 35 50, 50 55 C35 60, 25 65, 10 70Z" opacity="0.3"/>
        <path d="M70 10 C55 20, 50 35, 55 50 C60 35, 65 25, 70 10Z" opacity="0.3"/>
      </svg>
      <svg class="absolute bottom-0 left-0 w-36 h-36 md:w-48 md:h-48 text-sage/[0.1]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleY(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <svg class="absolute bottom-0 right-0 w-36 h-36 md:w-48 md:h-48 text-gold/[0.08]" viewBox="0 0 200 200" fill="currentColor" style="transform: scale(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>

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
      <!-- Ornamental top with floral frame -->
      <div class="hero-fade-up hero-d1 flex items-center justify-center gap-3 mb-8">
        <svg class="w-16 h-3 text-gold/40" viewBox="0 0 120 20" fill="currentColor">
          <path d="M60 10 C50 5, 35 3, 15 8 Q5 10, 0 10" fill="none" stroke="currentColor" stroke-width="1"/>
          <path d="M30 8 C28 4, 24 3, 20 5 C24 6, 27 8, 27 12 C29 9, 30 8, 30 8Z" opacity="0.5"/>
          <circle cx="15" cy="9" r="2" opacity="0.4"/>
        </svg>
        <svg class="w-8 h-8 text-gold/50" viewBox="0 0 100 100" fill="currentColor">
          <path d="M50 15 C40 28, 28 35, 18 40 C28 50, 35 60, 38 75 C44 60, 48 50, 50 40 C52 50, 56 60, 62 75 C65 60, 72 50, 82 40 C72 35, 60 28, 50 15Z" opacity="0.35"/>
          <circle cx="50" cy="40" r="5" opacity="0.5"/>
          <path d="M50 25 Q53 35, 50 40 Q47 35, 50 25Z" opacity="0.4"/>
          <path d="M50 55 Q47 45, 50 40 Q53 45, 50 55Z" opacity="0.4"/>
        </svg>
        <svg class="w-16 h-3 text-gold/40" viewBox="0 0 120 20" fill="currentColor" style="transform: scaleX(-1)">
          <path d="M60 10 C50 5, 35 3, 15 8 Q5 10, 0 10" fill="none" stroke="currentColor" stroke-width="1"/>
          <path d="M30 8 C28 4, 24 3, 20 5 C24 6, 27 8, 27 12 C29 9, 30 8, 30 8Z" opacity="0.5"/>
          <circle cx="15" cy="9" r="2" opacity="0.4"/>
        </svg>
      </div>

      <p class="hero-fade-up hero-d2 text-gold/80 text-xs tracking-[0.4em] uppercase mb-6 font-light">
        The Wedding of
      </p>

      <h1 class="hero-fade-up hero-d3 font-heading text-6xl md:text-8xl lg:text-9xl font-bold mb-2 leading-none">
        <span class="shimmer-text">{{ config.groom.nickname }}</span>
      </h1>

      <div class="hero-fade-up hero-d4 flex items-center justify-center gap-6 my-6">
        <span class="h-px w-16 bg-gradient-to-r from-transparent to-gold/50"></span>
        <span class="font-heading text-3xl text-gold italic">&</span>
        <span class="h-px w-16 bg-gradient-to-l from-transparent to-gold/50"></span>
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
        style="background: linear-gradient(135deg, var(--color-gold-dark), var(--color-gold), var(--color-gold-dark)); color: #faf8f5;"
      >
        <span class="relative z-10 font-medium">Buka Undangan</span>
        <svg class="relative z-10 w-4 h-4 transition-transform group-hover:translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
        <div class="absolute inset-0 bg-gradient-to-r from-gold-light via-gold to-gold-light opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      </button>
    </div>

    <!-- Scroll indicator -->
    <div v-if="opened" class="absolute bottom-8 left-1/2 -translate-x-1/2 hero-fade-up hero-d6">
      <div class="w-6 h-10 border-2 border-gold/40 rounded-full flex justify-center pt-2">
        <div class="w-1 h-2 bg-gold/60 rounded-full animate-bounce"></div>
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
