<template>
  <section
    ref="heroRef"
    class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-cover bg-center"
    style="perspective: 1000px"
  >
    <!-- Background overlay -->
    <div class="absolute inset-0 bg-ivory/80 backdrop-blur-sm"></div>

    <!-- Floating particles -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        v-for="n in 12"
        :key="n"
        class="absolute w-2 h-2 rounded-full"
        :class="n % 3 === 0 ? 'bg-gold/20' : n % 3 === 1 ? 'bg-pink/30' : 'bg-gold-light/15'"
        :style="{
          left: (n * 8.3) + '%',
          animationName: 'float-up',
          animationDuration: (8 + n * 1.5) + 's',
          animationDelay: (n * 0.7) + 's',
          animationIterationCount: 'infinite',
          animationTimingFunction: 'linear',
          width: (4 + (n % 4) * 3) + 'px',
          height: (4 + (n % 4) * 3) + 'px',
        }"
      ></div>
    </div>

    <!-- 3D Decorative elements that respond to mouse -->
    <div
      class="absolute top-0 left-0 w-48 h-48 md:w-72 md:h-72 opacity-20 float-gentle"
      :style="{ transform: `translate3d(${mouseX * 20}px, ${mouseY * 20}px, 0)` }"
    >
      <svg viewBox="0 0 200 200" class="w-full h-full text-gold spin-slow">
        <path
          fill="currentColor"
          d="M0,0 Q100,50 200,0 Q150,100 200,200 Q100,150 0,200 Q50,100 0,0Z"
          opacity="0.3"
        />
      </svg>
    </div>
    <div
      class="absolute bottom-0 right-0 w-48 h-48 md:w-72 md:h-72 opacity-20 float-gentle"
      :style="{ transform: `translate3d(${mouseX * -15}px, ${mouseY * -15}px, 0) rotate(180deg)`, animationDelay: '-3s' }"
    >
      <svg viewBox="0 0 200 200" class="w-full h-full text-gold spin-slow" style="animation-direction: reverse">
        <path
          fill="currentColor"
          d="M0,0 Q100,50 200,0 Q150,100 200,200 Q100,150 0,200 Q50,100 0,0Z"
          opacity="0.3"
        />
      </svg>
    </div>

    <!-- Extra decorative ring -->
    <div
      class="absolute top-1/4 right-8 md:right-16 w-24 h-24 md:w-36 md:h-36 rounded-full border border-gold/10 float-gentle opacity-30"
      :style="{ transform: `translate3d(${mouseX * -25}px, ${mouseY * 10}px, 0)`, animationDelay: '-2s' }"
    ></div>
    <div
      class="absolute bottom-1/4 left-8 md:left-16 w-16 h-16 md:w-24 md:h-24 rounded-full border border-pink/15 float-gentle opacity-25"
      :style="{ transform: `translate3d(${mouseX * 30}px, ${mouseY * -20}px, 0)`, animationDelay: '-4s' }"
    ></div>

    <!-- Content with 3D parallax -->
    <div
      class="relative z-10 text-center px-6 max-w-2xl"
      :style="{ transform: `perspective(1000px) rotateX(${mouseY * -2}deg) rotateY(${mouseX * 2}deg) translateZ(20px)` }"
    >
      <!-- Couple photo with 3D glow -->
      <div class="hero-reveal hero-reveal-d1 mb-8 mx-auto w-40 h-40 md:w-52 md:h-52 rounded-full overflow-hidden border-4 border-gold/30 shadow-xl pulse-glow">
        <div class="w-full h-full bg-pink-light flex items-center justify-center">
          <svg class="w-16 h-16 text-gold/50" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
          </svg>
        </div>
      </div>

      <p class="hero-reveal hero-reveal-d2 text-charcoal-light text-sm tracking-[0.3em] uppercase mb-4 font-light">Undangan Pernikahan</p>

      <h1 class="hero-reveal hero-reveal-d3 font-heading text-5xl md:text-7xl lg:text-8xl font-semibold text-charcoal mb-2 leading-tight">
        {{ config.groom.name }}
      </h1>
      <div class="flex items-center justify-center gap-4 my-3">
        <span class="hero-line-anim h-px bg-gold/50"></span>
        <span class="hero-reveal hero-reveal-d4 text-gold text-2xl font-heading italic">&</span>
        <span class="hero-line-anim h-px bg-gold/50"></span>
      </div>
      <h1 class="hero-reveal hero-reveal-d4 font-heading text-5xl md:text-7xl lg:text-8xl font-semibold text-charcoal mb-6 leading-tight">
        {{ config.bride.name }}
      </h1>

      <p class="hero-reveal hero-reveal-d5 text-charcoal-light tracking-[0.2em] text-sm md:text-base mb-10 font-light">
        {{ config.date }}
      </p>

      <button
        v-if="!opened"
        @click="$emit('open')"
        class="hero-btn-anim group relative inline-flex items-center gap-2 px-8 py-3.5 bg-gold text-white text-sm tracking-[0.15em] uppercase rounded-full shadow-lg hover:bg-gold-dark transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5"
      >
        <span>Buka Undangan</span>
        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import config from '../config.json'

defineProps({
  opened: Boolean
})
defineEmits(['open'])

const heroRef = ref(null)
const mouseX = ref(0)
const mouseY = ref(0)

function onMouseMove(e) {
  if (!heroRef.value) return
  const rect = heroRef.value.getBoundingClientRect()
  mouseX.value = ((e.clientX - rect.left) / rect.width - 0.5) * 2
  mouseY.value = ((e.clientY - rect.top) / rect.height - 0.5) * 2
}

onMounted(() => {
  window.addEventListener('mousemove', onMouseMove)
})
onUnmounted(() => {
  window.removeEventListener('mousemove', onMouseMove)
})
</script>
