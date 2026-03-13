<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbRef"
        class="p-layer absolute bottom-0 right-[-3rem] h-64 w-64 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(176,141,87,0.08), transparent 70%)' }"
      ></div>
      <!-- Floral corners -->
      <svg class="absolute top-4 left-4 w-24 h-24 text-gold/[0.06]" viewBox="0 0 200 200" fill="currentColor">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <svg class="absolute bottom-4 right-4 w-24 h-24 text-rose/[0.06]" viewBox="0 0 200 200" fill="currentColor" style="transform: scale(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <!-- Falling petals -->
      <div
        v-for="p in petals"
        :key="p.id"
        class="petal"
        :style="{ left: p.x + '%', width: p.size + 'px', height: p.size + 'px', animationDuration: p.duration + 's', animationDelay: p.delay + 's' }"
      >
        <div class="petal-inner" :style="{ animationDuration: (2 + Math.random() * 2) + 's' }">
          <svg :class="p.colorClass" :style="{ opacity: p.opacity }" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C6.5 2 2 6.5 2 12c5 0 10-4 10-10zm0 20c5.5 0 10-4.5 10-10-5 0-10 4-10 10z"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="relative max-w-xl mx-auto">
      <div class="text-center mb-16 reveal">
        <p class="text-gold/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Wedding Gift</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Kirim Hadiah</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-gold/60 to-transparent"></div>
        <p class="text-cream/40 text-sm mt-6 max-w-md mx-auto leading-relaxed">
          Kehadiran Anda adalah hadiah terindah bagi kami. Namun jika Anda ingin memberikan tanda kasih, kami dengan senang hati menerimanya.
        </p>
      </div>

      <div class="space-y-6">
        <!-- Bank Transfer Cards -->
        <div
          v-for="(account, index) in config.gift.accounts"
          :key="index"
          class="reveal glass-card ornament-corners rounded-2xl p-6 md:p-8"
        >
          <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 rounded-full bg-gold/10 flex items-center justify-center">
              <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
              </svg>
            </div>
            <div>
              <h3 class="font-heading text-xl text-cream">Bank Transfer</h3>
              <p class="text-cream/40 text-sm">{{ account.bankName }}</p>
            </div>
          </div>
          <div class="bg-forest/60 rounded-xl p-4 flex items-center justify-between border border-gold/10">
            <div>
              <p class="text-cream/40 text-xs mb-1">Nomor Rekening</p>
              <p class="text-cream font-medium tracking-wider">{{ account.accountNumber }}</p>
              <p class="text-cream/40 text-xs mt-1">a.n. {{ account.accountHolder }}</p>
            </div>
            <button
              @click="copyToClipboard(account.accountNumberRaw, index)"
              class="px-4 py-2 text-xs tracking-wider uppercase border border-gold/30 text-gold rounded-lg hover:bg-gold hover:text-deep transition-all duration-300"
            >
              {{ copiedIndex === index ? 'Tersalin!' : 'Salin' }}
            </button>
          </div>
        </div>

        <!-- Gift Address -->
        <div class="reveal glass-card ornament-corners rounded-2xl p-6 md:p-8">
          <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 rounded-full bg-gold/10 flex items-center justify-center">
              <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
              </svg>
            </div>
            <div>
              <h3 class="font-heading text-xl text-cream">Kirim Kado</h3>
              <p class="text-cream/40 text-sm">Alamat pengiriman hadiah</p>
            </div>
          </div>
          <div class="bg-forest/60 rounded-xl p-4 border border-gold/10">
            <p class="text-cream/40 text-xs mb-1">Alamat</p>
            <p class="text-cream text-sm leading-relaxed">{{ config.gift.address }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import config from '../../config.json'
import { useParallax } from '../../composables/useParallax'

const orbRef = ref(null)
const { parallaxStyle: orbStyle } = useParallax(orbRef, { maxOffset: 50 })

const petalColors = ['text-rose', 'text-gold', 'text-sage']
const petals = Array.from({ length: 6 }, (_, i) => ({
  id: i,
  x: 10 + Math.random() * 80,
  size: 10 + Math.random() * 12,
  duration: 14 + Math.random() * 14,
  delay: Math.random() * 12,
  opacity: 0.2 + Math.random() * 0.2,
  colorClass: petalColors[i % 3],
}))

const copiedIndex = ref(null)

async function copyToClipboard(text, index) {
  try {
    await navigator.clipboard.writeText(text)
    copiedIndex.value = index
    setTimeout(() => { copiedIndex.value = null }, 2000)
  } catch {
    copiedIndex.value = null
  }
}
</script>
