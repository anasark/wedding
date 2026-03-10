<template>
  <section class="py-20 md:py-28 px-6">
    <div class="max-w-5xl mx-auto">
      <div class="text-center mb-16 zoom-in-3d">
        <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Pasangan Bahagia</p>
        <h2 class="font-heading text-4xl md:text-5xl text-charcoal">Mempelai</h2>
      </div>

      <div class="grid md:grid-cols-2 gap-12 md:gap-16 stagger-children">
        <!-- Groom -->
        <div class="slide-in-left text-center">
          <div class="w-48 h-48 md:w-56 md:h-56 mx-auto rounded-full overflow-hidden border-4 border-gold/20 shadow-lg mb-6 pulse-glow">
            <div class="w-full h-full bg-pink-light flex items-center justify-center">
              <svg class="w-20 h-20 text-gold/40" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
              </svg>
            </div>
          </div>
          <h3 class="font-heading text-3xl md:text-4xl text-charcoal mb-2">{{ config.groom.name }}</h3>
          <p class="text-charcoal-light text-sm mb-4">{{ config.groom.parentOf }}</p>
          <p class="font-heading text-lg text-charcoal">{{ config.groom.parents }}</p>
        </div>

        <!-- Bride -->
        <div class="slide-in-right text-center">
          <div class="w-48 h-48 md:w-56 md:h-56 mx-auto rounded-full overflow-hidden border-4 border-gold/20 shadow-lg mb-6 pulse-glow">
            <div class="w-full h-full bg-pink-light flex items-center justify-center">
              <svg class="w-20 h-20 text-gold/40" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
              </svg>
            </div>
          </div>
          <h3 class="font-heading text-3xl md:text-4xl text-charcoal mb-2">{{ config.bride.name }}</h3>
          <p class="text-charcoal-light text-sm mb-4">{{ config.bride.parentOf }}</p>
          <p class="font-heading text-lg text-charcoal">{{ config.bride.parents }}</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import config from '../config.json'
</script>
