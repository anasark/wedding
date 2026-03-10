<template>
  <footer class="py-16 px-6 bg-charcoal text-center">
    <div class="max-w-lg mx-auto">
      <svg class="w-8 h-8 text-gold mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
      </svg>
      <p class="text-ivory/70 text-sm leading-relaxed mb-6">
        Terima kasih telah menjadi bagian dari hari istimewa kami. Cinta dan dukungan Anda sangat berarti bagi kami.
      </p>
      <h3 class="font-heading text-3xl md:text-4xl text-ivory mb-2">{{ config.groom.name }} & {{ config.bride.name }}</h3>
      <div class="flex items-center justify-center gap-3 mt-4">
        <span class="h-px w-8 bg-gold/40"></span>
        <span class="text-gold/60 text-xs tracking-[0.3em] uppercase">{{ config.dateShort }}</span>
        <span class="h-px w-8 bg-gold/40"></span>
      </div>
      <p class="text-ivory/30 text-xs mt-8">Dibuat dengan cinta</p>
    </div>
  </footer>
</template>

<script setup>
import config from '../config.json'
</script>
