<template>
  <footer class="relative overflow-hidden py-20 px-6 w-full watercolor-wash paper-texture">
    <!-- Background -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep to-forest/30"></div>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="58" y="500" width="26" height="400" rx="5" opacity="0.85"/>
        <ellipse cx="71" cy="400" rx="85" ry="138" opacity="0.6"/>
        <ellipse cx="52" cy="340" rx="62" ry="100" opacity="0.5"/>
        <circle cx="125" cy="305" r="22" opacity="0.4"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="66" y="530" width="22" height="370" rx="5" opacity="0.75"/>
        <ellipse cx="77" cy="430" rx="76" ry="120" opacity="0.55"/>
        <ellipse cx="60" cy="370" rx="52" ry="85" opacity="0.45"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[6%] w-8 h-28 md:w-10 md:h-40" viewBox="0 0 40 160" fill="none" style="animation-duration: 11s">
        <path d="M20 0 Q15 28, 23 55 Q29 82, 17 110 Q13 138, 20 160" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M23 42 Q13 37, 11 47 Q17 45, 23 42Z" fill="var(--color-sage)" opacity="0.55"/>
        <circle cx="20" cy="58" r="3" fill="var(--color-sage-light)" opacity="0.45"/>
      </svg>
      <svg class="vine-hang right-[5%] w-6 h-22 md:w-8 md:h-32" viewBox="0 0 30 130" fill="none" style="animation-duration: 9s; animation-delay: -4s">
        <path d="M15 0 Q18 22, 11 44 Q7 66, 16 88 Q20 110, 15 130" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.6"/>
        <path d="M11 32 Q20 28, 22 36 Q17 34, 11 32Z" fill="var(--color-sage)" opacity="0.5"/>
      </svg>

      <!-- Floral corner — top left -->
      <svg class="absolute top-0 left-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 11s" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.2"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.15"/>
        <circle cx="42" cy="32" r="7" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="28" cy="52" r="4.5" fill="var(--color-blush)" opacity="0.15"/>
      </svg>

      <!-- Floral corner — top right -->
      <svg class="absolute top-0 right-0 w-28 h-28 md:w-44 md:h-44 gentle-float" style="animation-duration: 10s; animation-delay: -3s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <circle cx="35" cy="28" r="6" fill="var(--color-rose)" opacity="0.16"/>
      </svg>

      <!-- Leaf watercolor corner decorations -->
      <svg class="leaf-accent top-0 left-0 w-32 h-32 md:w-44 md:h-44 gentle-float" style="animation-duration: 12s" viewBox="0 0 200 200" fill="none">
        <path d="M25 170 Q50 110, 90 75 Q70 110, 55 140 Q40 158, 25 170Z" fill="var(--color-sage)" opacity="0.08"/>
        <circle cx="95" cy="70" r="4" fill="var(--color-rose)" opacity="0.08"/>
      </svg>
      <svg class="leaf-accent top-0 right-0 w-32 h-32 md:w-44 md:h-44 gentle-float" style="animation-duration: 10s; animation-delay: -5s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 160 Q45 100, 80 70 Q60 100, 45 135 Q32 150, 20 160Z" fill="var(--color-sage-light)" opacity="0.06"/>
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
        <svg class="w-32 h-12 text-sage/30" viewBox="0 0 200 60" fill="currentColor">
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
        <svg class="w-8 h-8 text-sage/50 mx-auto" fill="currentColor" viewBox="0 0 24 24">
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
        <span class="h-px w-10 bg-sage/40"></span>
        <span class="text-sage/60 text-xs tracking-[0.3em] uppercase">{{ config.dateShort }}</span>
        <span class="h-px w-10 bg-sage/40"></span>
      </div>

      <p class="text-cream/30 text-xs mt-10">Dibuat dengan cinta</p>
      <p class="text-cream/20 text-[10px] mt-2">
        Powered by <a href="https://anasabdur.com" target="_blank" rel="noopener noreferrer" class="text-cream/30 hover:text-sage/60 transition-colors duration-300">anasabdur.com</a>
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

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)']
const hearts = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 20 + Math.random() * 22,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 3],
}))
</script>
