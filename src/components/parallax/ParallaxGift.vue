<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full watercolor-wash paper-texture">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbRef"
        class="p-layer absolute bottom-0 right-[-3rem] h-64 w-64 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(122,158,122,0.08), transparent 70%)' }"
      ></div>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="56" y="500" width="28" height="400" rx="5" opacity="0.85"/>
        <ellipse cx="70" cy="400" rx="88" ry="142" opacity="0.6"/>
        <ellipse cx="52" cy="338" rx="64" ry="105" opacity="0.5"/>
        <circle cx="128" cy="305" r="24" opacity="0.4"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="66" y="530" width="22" height="370" rx="5" opacity="0.75"/>
        <ellipse cx="78" cy="428" rx="78" ry="125" opacity="0.55"/>
        <ellipse cx="60" cy="370" rx="55" ry="88" opacity="0.45"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[5%] w-8 h-28 md:w-10 md:h-42" viewBox="0 0 40 170" fill="none" style="animation-duration: 10s">
        <path d="M20 0 Q15 30, 23 58 Q29 86, 17 115 Q13 143, 20 170" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M23 44 Q13 39, 11 49 Q17 47, 23 44Z" fill="var(--color-sage)" opacity="0.55"/>
        <circle cx="20" cy="62" r="3" fill="var(--color-sage-light)" opacity="0.45"/>
      </svg>
      <svg class="vine-hang right-[6%] w-6 h-24 md:w-8 md:h-34" viewBox="0 0 30 140" fill="none" style="animation-duration: 12s; animation-delay: -5s">
        <path d="M15 0 Q18 24, 11 48 Q7 72, 16 96 Q20 118, 15 140" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.6"/>
        <path d="M11 34 Q20 30, 22 38 Q17 36, 11 34Z" fill="var(--color-sage)" opacity="0.5"/>
      </svg>

      <!-- Floral corner — top left -->
      <svg class="absolute top-0 left-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 11s" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.2"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.15"/>
        <circle cx="42" cy="32" r="7" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="28" cy="52" r="4.5" fill="var(--color-blush)" opacity="0.15"/>
      </svg>

      <!-- Floral corner — bottom right -->
      <svg class="absolute bottom-0 right-0 w-28 h-28 md:w-44 md:h-44 gentle-float" style="animation-duration: 9s; animation-delay: -4s; transform: scale(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <path d="M10 0 Q45 35, 50 70 Q40 40, 25 18Z" fill="var(--color-sage)" opacity="0.15"/>
        <circle cx="38" cy="28" r="6" fill="var(--color-rose)" opacity="0.18"/>
      </svg>

      <!-- Leaf watercolor accents -->
      <svg class="leaf-accent top-4 left-4 w-24 h-24 gentle-float" style="animation-duration: 10s" viewBox="0 0 200 200" fill="none">
        <path d="M25 170 Q50 110, 90 75 Q70 110, 55 140 Q40 158, 25 170Z" fill="var(--color-sage)" opacity="0.1"/>
      </svg>
      <svg class="leaf-accent bottom-4 right-4 w-24 h-24 gentle-float" style="animation-duration: 8s; animation-delay: -4s; transform: scale(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 160 Q45 100, 80 70 Q60 100, 45 135 Q32 150, 20 160Z" fill="var(--color-sage-light)" opacity="0.08"/>
        <circle cx="85" cy="65" r="3" fill="var(--color-rose)" opacity="0.1"/>
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
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Wedding Gift</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Kirim Hadiah</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>
        <p class="text-cream/40 text-sm mt-6 max-w-md mx-auto leading-relaxed">
          Kehadiran Anda adalah hadiah terindah bagi kami. Namun jika Anda ingin memberikan tanda kasih, kami dengan senang hati menerimanya.
        </p>
      </div>

      <div class="space-y-6">
        <!-- Bank Transfer Cards -->
        <div
          v-for="(account, index) in config.gift.accounts"
          :key="index"
          class="reveal floral-card p-6 md:p-8"
        >
          <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 rounded-full bg-sage/10 flex items-center justify-center">
              <svg class="w-6 h-6 text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
              </svg>
            </div>
            <div>
              <h3 class="font-heading text-xl text-cream">Bank Transfer</h3>
              <p class="text-cream/40 text-sm">{{ account.bankName }}</p>
            </div>
          </div>
          <div class="bg-forest/60 rounded-xl p-4 flex items-center justify-between border border-sage/10">
            <div>
              <p class="text-cream/40 text-xs mb-1">Nomor Rekening</p>
              <p class="text-cream font-medium tracking-wider">{{ account.accountNumber }}</p>
              <p class="text-cream/40 text-xs mt-1">a.n. {{ account.accountHolder }}</p>
            </div>
            <button
              @click="copyToClipboard(account.accountNumberRaw, index)"
              class="px-4 py-2 text-xs tracking-wider uppercase border border-sage/30 text-sage rounded-lg hover:bg-sage hover:text-ivory transition-all duration-300"
            >
              {{ copiedIndex === index ? 'Tersalin!' : 'Salin' }}
            </button>
          </div>
        </div>

        <!-- Gift Address -->
        <div class="reveal floral-card p-6 md:p-8">
          <div class="flex items-center gap-4 mb-5">
            <div class="w-12 h-12 rounded-full bg-sage/10 flex items-center justify-center">
              <svg class="w-6 h-6 text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
              </svg>
            </div>
            <div>
              <h3 class="font-heading text-xl text-cream">Kirim Kado</h3>
              <p class="text-cream/40 text-sm">Alamat pengiriman hadiah</p>
            </div>
          </div>
          <div class="bg-forest/60 rounded-xl p-4 border border-sage/10">
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
import { hasWeddingApi, requestWeddingApi } from '../../composables/useWeddingApi'

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

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)']
const hearts = Array.from({ length: 5 }, (_, i) => ({
  id: i,
  x: 8 + Math.random() * 84,
  size: 20 + Math.random() * 20,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 3],
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
  // Tracking: send to backend (silent fail, only once per click)
  try {
    if (hasWeddingApi()) {
      const account = config.gift.accounts[index]
      await requestWeddingApi('/track-copy-bank.php', {
        method: 'POST',
        body: JSON.stringify({
          bank_name: account.bankName,
          account_number: account.accountNumberRaw
        })
      })
    }
  } catch {}
}
</script>
