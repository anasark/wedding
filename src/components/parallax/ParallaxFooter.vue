<template>
  <footer class="relative overflow-hidden py-20 px-6 w-full">
    <!-- Background -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep to-forest/30"></div>
      <!-- Floral corner decorations -->
      <svg class="absolute top-0 left-0 w-32 h-32 md:w-44 md:h-44 text-gold/[0.06]" viewBox="0 0 200 200" fill="currentColor">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <svg class="absolute top-0 right-0 w-32 h-32 md:w-44 md:h-44 text-rose/[0.06]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleX(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <!-- Floating petals -->
      <div
        v-for="p in petals"
        :key="p.id"
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
    </div>

    <div class="relative max-w-lg mx-auto text-center">
      <!-- Floral ornament -->
      <div class="mb-6 flex items-center justify-center">
        <svg class="w-32 h-12 text-gold/30" viewBox="0 0 200 60" fill="currentColor">
          <!-- Central flower -->
          <path d="M100 15 C95 22, 88 27, 78 25 C85 30, 90 35, 92 45 C96 35, 98 30, 100 25 C102 30, 104 35, 108 45 C110 35, 115 30, 122 25 C112 27, 105 22, 100 15Z"/>
          <circle cx="100" cy="25" r="3" opacity="0.6"/>
          <!-- Left vine -->
          <path d="M78 25 Q60 22, 40 30 Q55 25, 65 35" fill="none" stroke="currentColor" stroke-width="1" opacity="0.4"/>
          <path d="M50 27 C48 22, 42 20, 38 22 C42 24, 45 28, 44 32 C48 28, 50 26, 50 27Z" opacity="0.3"/>
          <!-- Right vine -->
          <path d="M122 25 Q140 22, 160 30 Q145 25, 135 35" fill="none" stroke="currentColor" stroke-width="1" opacity="0.4"/>
          <path d="M150 27 C152 22, 158 20, 162 22 C158 24, 155 28, 156 32 C152 28, 150 26, 150 27Z" opacity="0.3"/>
        </svg>
      </div>

      <!-- Heart -->
      <div class="mb-6">
        <svg class="w-8 h-8 text-gold/50 mx-auto" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
        </svg>
      </div>

      <p class="text-cream/40 text-sm leading-relaxed mb-8">
        Terima kasih telah menjadi bagian dari hari istimewa kami. Cinta dan dukungan Anda sangat berarti bagi kami.
      </p>

      <h3 class="font-heading text-3xl md:text-5xl mb-3">
        <span class="shimmer-text">{{ config.groom.name }} & {{ config.bride.name }}</span>
      </h3>

      <div class="flex items-center justify-center gap-3 mt-6">
        <span class="h-px w-10 bg-gold/40"></span>
        <span class="text-gold/60 text-xs tracking-[0.3em] uppercase">{{ config.dateShort }}</span>
        <span class="h-px w-10 bg-gold/40"></span>
      </div>

      <p class="text-cream/30 text-xs mt-10">Dibuat dengan cinta</p>
      <p class="text-cream/20 text-[10px] mt-2">
        Powered by <a href="https://anasabdur.com" target="_blank" rel="noopener noreferrer" class="text-cream/30 hover:text-gold/60 transition-colors duration-300">anasabdur.com</a>
      </p>
    </div>
  </footer>
</template>

<script setup>
import config from '../../config.json'

const petalColors = ['text-rose', 'text-gold', 'text-sage']
const petals = Array.from({ length: 10 }, (_, i) => ({
  id: i,
  x: 10 + Math.random() * 80,
  size: 10 + Math.random() * 14,
  duration: 14 + Math.random() * 16,
  delay: Math.random() * 12,
  opacity: 0.18 + Math.random() * 0.2,
  colorClass: petalColors[i % 3],
}))
</script>
