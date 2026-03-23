<template>
  <section class="relative overflow-hidden py-16 md:py-24 px-6 w-full watercolor-wash paper-texture">
    <!-- Background -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep via-deep-light/50 to-deep"></div>

      <!-- Tree silhouette — left -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="55" y="480" width="30" height="420" rx="5" opacity="0.85"/>
        <ellipse cx="70" cy="380" rx="100" ry="150" opacity="0.65"/>
        <ellipse cx="50" cy="320" rx="75" ry="120" opacity="0.55"/>
        <ellipse cx="90" cy="300" rx="65" ry="100" opacity="0.5"/>
        <circle cx="15" cy="250" r="30" opacity="0.4"/>
        <circle cx="140" cy="280" r="22" opacity="0.35"/>
      </svg>

      <!-- Tree silhouette — right -->
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="65" y="520" width="25" height="380" rx="5" opacity="0.8"/>
        <ellipse cx="78" cy="420" rx="90" ry="140" opacity="0.6"/>
        <ellipse cx="60" cy="370" rx="65" ry="100" opacity="0.5"/>
        <circle cx="130" cy="320" r="25" opacity="0.4"/>
      </svg>

      <!-- Hanging vine -->
      <svg class="vine-hang right-[6%] w-10 h-36 md:w-14 md:h-52" viewBox="0 0 60 220" fill="none" style="animation-duration: 9s">
        <path d="M30 0 Q35 40, 28 80 Q22 120, 32 160 Q38 200, 30 220" stroke="var(--color-sage)" stroke-width="2.5" fill="none" opacity="0.8"/>
        <circle cx="28" cy="80" r="5" fill="var(--color-sage-light)" opacity="0.6"/>
        <circle cx="32" cy="160" r="4" fill="var(--color-sage)" opacity="0.55"/>
        <path d="M28 50 Q38 45, 40 55 Q33 52, 28 50Z" fill="var(--color-sage)" opacity="0.6"/>
        <path d="M32 120 Q22 115, 20 125 Q26 122, 32 120Z" fill="var(--color-sage)" opacity="0.55"/>
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

      <!-- Leaf watercolor accents -->
      <svg class="leaf-accent top-0 left-0 w-36 h-36 md:w-52 md:h-52 gentle-float" style="animation-duration: 9s" viewBox="0 0 200 200" fill="none">
        <path d="M20 170 Q45 110, 85 75 Q65 105, 50 140 Q35 160, 20 170Z" fill="var(--color-sage)" opacity="0.12"/>
        <path d="M25 165 Q48 108, 80 78" stroke="var(--color-sage-dark)" stroke-width="0.7" fill="none" opacity="0.15"/>
        <circle cx="90" cy="70" r="5" fill="var(--color-rose)" opacity="0.1"/>
      </svg>
      <svg class="leaf-accent top-0 right-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 8s; animation-delay: -3s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M15 160 Q40 100, 75 70 Q55 100, 40 130 Q30 150, 15 160Z" fill="var(--color-sage-light)" opacity="0.1"/>
        <circle cx="80" cy="65" r="4" fill="var(--color-blush)" opacity="0.12"/>
      </svg>
      <!-- Floating petals background -->
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

    <div class="relative max-w-5xl mx-auto z-10">
      <!-- Section header -->
      <div class="text-center mb-12 md:mb-16 reveal">
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Happy Couple</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Mempelai</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>

        <!-- Wedding rings ornament -->
        <div class="mt-6 flex items-center justify-center">
          <svg class="w-16 h-10 text-sage/30" viewBox="0 0 120 60" fill="none" stroke="currentColor" stroke-width="2">
            <ellipse cx="42" cy="30" rx="22" ry="22"/>
            <ellipse cx="78" cy="30" rx="22" ry="22"/>
            <path d="M60 8 L55 16 L60 24 L65 16 Z" fill="currentColor" opacity="0.3"/>
          </svg>
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-10 md:gap-16 items-center">
        <!-- Groom -->
        <div class="reveal-left text-center">
          <div class="arch-frame mb-6 mx-auto" style="width: fit-content;">
            <!-- Decorative ring behind photo -->
            <div class="arch-glow"></div>
            <div class="arch-border"></div>
            <!-- Arched photo container -->
            <div class="w-48 h-56 md:w-64 md:h-80 arch-clip overflow-hidden mx-auto relative">
              <img src="/mempelai%20pria.webp" alt="Mempelai Pria" class="absolute inset-0 w-full h-full object-cover" style="transform: scale(1) translateY(2%);object-position:50% 28%;" />
            </div>
          </div>
          <h3 class="font-heading text-3xl md:text-4xl text-cream mb-2">{{ config.groom.name }}</h3>
          <p class="text-cream/50 text-sm mb-3">{{ config.groom.parentOf }}</p>
          <p class="font-heading text-lg text-sage/80">{{ config.groom.parents }}</p>
        </div>

        <!-- Bride -->
        <div class="reveal-right text-center">
          <div class="arch-frame mb-6 mx-auto" style="width: fit-content;">
            <div class="arch-glow"></div>
            <div class="arch-border" style="border-color: rgba(196,145,138,0.3);"></div>
            <!-- Arched photo container -->
            <div class="w-48 h-56 md:w-64 md:h-80 arch-clip overflow-hidden mx-auto relative">
              <img src="/mempelai%20wanita.webp" alt="Mempelai Wanita" class="absolute inset-0 w-full h-full object-cover" style="transform: scale(1) translateY(2%);object-position: 30% 32%;" />
            </div>
          </div>
          <h3 class="font-heading text-3xl md:text-4xl text-cream mb-2">{{ config.bride.name }}</h3>
          <p class="text-cream/50 text-sm mb-3">{{ config.bride.parentOf }}</p>
          <p class="font-heading text-lg text-rose/80">{{ config.bride.parents }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import config from '../../config.json'

const colors = ['text-gold', 'text-rose', 'text-sage', 'text-blush']
const petals = Array.from({ length: 12 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 10 + Math.random() * 16,
  duration: 12 + Math.random() * 18,
  delay: Math.random() * 15,
  opacity: 0.2 + Math.random() * 0.3,
  colorClass: colors[i % 4],
}))

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)', 'var(--color-rose-dark)']
const hearts = Array.from({ length: 8 }, (_, i) => ({
  id: i,
  x: 8 + Math.random() * 84,
  size: 18 + Math.random() * 22,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 4],
}))
</script>
