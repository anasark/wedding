<template>
  <section class="py-20 md:py-28 px-6">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-12 zoom-in-3d">
        <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Temukan Kami</p>
        <h2 class="font-heading text-4xl md:text-5xl text-charcoal">Lokasi</h2>
      </div>

      <div class="fade-in rounded-2xl overflow-hidden shadow-sm border border-gold/10 card-3d relative">
        <iframe
          :src="config.mapEmbed"
          class="w-full h-[300px] md:h-[400px]"
          style="border: 0"
          allowfullscreen
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Wedding venue location"
        ></iframe>
      </div>
    </div>
  </section>
</template>

<script setup>
import config from '../config.json'
</script>
