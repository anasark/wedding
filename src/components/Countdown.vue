<template>
  <section class="py-20 md:py-28 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <div class="fade-in mb-12">
        <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Hitung Mundur</p>
        <h2 class="font-heading text-4xl md:text-5xl text-charcoal">Menuju Hari Bahagia</h2>
      </div>

      <div class="fade-in grid grid-cols-4 gap-3 md:gap-6 max-w-lg mx-auto">
        <div class="bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gold/10 countdown-cell">
          <span class="block font-heading text-4xl md:text-5xl lg:text-6xl text-gold font-semibold">{{ timeLeft.days }}</span>
          <span class="text-charcoal-light text-xs md:text-sm tracking-[0.15em] uppercase mt-1 block">Hari</span>
        </div>
        <div class="bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gold/10 countdown-cell">
          <span class="block font-heading text-4xl md:text-5xl lg:text-6xl text-gold font-semibold">{{ timeLeft.hours }}</span>
          <span class="text-charcoal-light text-xs md:text-sm tracking-[0.15em] uppercase mt-1 block">Jam</span>
        </div>
        <div class="bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gold/10 countdown-cell">
          <span class="block font-heading text-4xl md:text-5xl lg:text-6xl text-gold font-semibold">{{ timeLeft.minutes }}</span>
          <span class="text-charcoal-light text-xs md:text-sm tracking-[0.15em] uppercase mt-1 block">Menit</span>
        </div>
        <div class="bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gold/10 countdown-cell">
          <span class="block font-heading text-4xl md:text-5xl lg:text-6xl text-gold font-semibold">{{ timeLeft.seconds }}</span>
          <span class="text-charcoal-light text-xs md:text-sm tracking-[0.15em] uppercase mt-1 block">Detik</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

import config from '../config.json'

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
    seconds: Math.floor((diff / 1000) % 60)
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
