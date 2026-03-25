<template>
  <section class="py-20 md:py-28 px-6 bg-ivory-dark/50">
    <div class="max-w-xl mx-auto">
      <div class="text-center mb-12 zoom-in-3d">
        <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Hadiah Pernikahan</p>
        <h2 class="font-heading text-4xl md:text-5xl text-charcoal">Kirim Hadiah</h2>
        <p class="text-charcoal-light text-sm mt-4 max-w-md mx-auto">
          Kehadiran Anda adalah hadiah terindah bagi kami. Namun jika Anda ingin memberikan tanda kasih, kami dengan senang hati menerimanya.
        </p>
      </div>

      <div class="space-y-6 stagger-children">
        <!-- Bank Transfer -->
        <div class="flip-in bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gold/10">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-full bg-pink-light/60 flex items-center justify-center">
              <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
              </svg>
            </div>
            <div>
              <h3 class="font-heading text-xl text-charcoal">Bank Transfer</h3>
              <p class="text-charcoal-light text-sm">{{ config.gift.bankName }}</p>
            </div>
          </div>
          <div class="bg-ivory rounded-xl p-4 flex items-center justify-between">
            <div>
              <p class="text-charcoal-light text-xs mb-1">Nomor Rekening</p>
              <p class="text-charcoal font-medium tracking-wider">{{ config.gift.accountNumber }}</p>
              <p class="text-charcoal-light text-xs mt-1">a.n. {{ config.gift.accountHolder }}</p>
            </div>
            <button
              @click="copyToClipboard(config.gift.accountNumberRaw)"
              class="px-4 py-2 text-xs tracking-wider uppercase border border-gold/30 text-gold rounded-lg hover:bg-gold hover:text-white transition-all duration-300"
            >
              {{ copied ? 'Tersalin!' : 'Salin' }}
            </button>
          </div>
        </div>

        <!-- QR Code -->
        <div class="fade-in bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gold/10 text-center">
          <h3 class="font-heading text-xl text-charcoal mb-4">Scan untuk Bayar</h3>
          <div class="w-48 h-48 mx-auto bg-ivory rounded-xl flex items-center justify-center border border-gold/10">
            <div class="text-center">
              <svg class="w-12 h-12 text-gold/40 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
              </svg>
              <span class="text-charcoal-light/50 text-xs">QR Code</span>
            </div>
          </div>
          <p class="text-charcoal-light text-xs mt-4">Scan dengan aplikasi perbankan Anda</p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import config from '../config.json'
import { hasWeddingApi, requestWeddingApi } from '../composables/useWeddingApi'

const copied = ref(false)

async function copyToClipboard(text) {
  try {
    await navigator.clipboard.writeText(text)
    copied.value = true
    setTimeout(() => { copied.value = false }, 2000)
  } catch {
    copied.value = false
  }
  // Tracking: send to backend (silent fail, only once per click)
  try {
    if (hasWeddingApi()) {
      await requestWeddingApi('/track-copy-bank.php', {
        method: 'POST',
        body: JSON.stringify({
          bank_name: config.gift.bankName,
          account_number: config.gift.accountNumberRaw
        })
      })
    }
  } catch {}
}
</script>
