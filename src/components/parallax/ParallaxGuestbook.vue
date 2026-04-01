<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full watercolor-wash paper-texture">
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep via-forest/15 to-deep"></div>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="60" y="500" width="28" height="400" rx="5" opacity="0.85"/>
        <ellipse cx="74" cy="400" rx="92" ry="148" opacity="0.6"/>
        <ellipse cx="55" cy="340" rx="68" ry="108" opacity="0.5"/>
        <circle cx="132" cy="305" r="26" opacity="0.4"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="68" y="530" width="24" height="370" rx="5" opacity="0.75"/>
        <ellipse cx="80" cy="430" rx="82" ry="128" opacity="0.55"/>
        <ellipse cx="63" cy="375" rx="58" ry="92" opacity="0.45"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[6%] w-8 h-28 md:w-10 md:h-44" viewBox="0 0 40 180" fill="none" style="animation-duration: 10s">
        <path d="M20 0 Q15 30, 22 60 Q28 90, 18 120 Q14 150, 20 180" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M22 45 Q12 40, 10 50 Q16 48, 22 45Z" fill="var(--color-sage)" opacity="0.6"/>
        <path d="M18 105 Q28 100, 30 110 Q25 108, 18 105Z" fill="var(--color-sage-light)" opacity="0.5"/>
        <circle cx="20" cy="65" r="3.5" fill="var(--color-sage-light)" opacity="0.45"/>
      </svg>
      <svg class="vine-hang right-[5%] w-6 h-24 md:w-8 md:h-36" viewBox="0 0 30 150" fill="none" style="animation-duration: 12s; animation-delay: -5s">
        <path d="M15 0 Q18 25, 12 50 Q8 75, 16 100 Q20 125, 15 150" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.6"/>
        <path d="M12 35 Q20 30, 22 40 Q17 38, 12 35Z" fill="var(--color-sage)" opacity="0.5"/>
      </svg>

      <!-- Floral corner — top left -->
      <svg class="absolute top-0 left-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 11s" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.2"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.15"/>
        <circle cx="42" cy="32" r="7" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="28" cy="52" r="4.5" fill="var(--color-blush)" opacity="0.15"/>
        <path d="M38 28 Q40 18, 48 16 Q44 24, 38 28Z" fill="var(--color-sage)" opacity="0.2"/>
      </svg>

      <!-- Floral corner — bottom right -->
      <svg class="absolute bottom-0 right-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 9s; animation-delay: -4s; transform: scale(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <path d="M10 0 Q45 35, 50 70 Q40 40, 25 18Z" fill="var(--color-sage)" opacity="0.15"/>
        <circle cx="38" cy="28" r="6" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="22" cy="48" r="3.5" fill="var(--color-blush)" opacity="0.14"/>
      </svg>

      <!-- Leaf watercolor accents -->
      <svg class="leaf-accent top-0 left-0 w-24 h-24 text-sage/[0.08] gentle-float" style="animation-duration: 9s" viewBox="0 0 200 200" fill="none">
        <path d="M25 170 Q50 110, 90 75 Q70 110, 55 140 Q40 158, 25 170Z" fill="var(--color-sage)" opacity="0.1"/>
      </svg>
      <svg class="leaf-accent bottom-0 right-0 w-24 h-24 text-rose/[0.08] gentle-float" style="animation-duration: 11s; animation-delay: -5s; transform: scale(-1)" viewBox="0 0 200 200" fill="none">
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
        :key="'petal-'+p.id"
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

    <div class="relative max-w-2xl mx-auto">
      <div class="text-center mb-16 reveal">
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Ucapan & Doa</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Buku Tamu</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>
        <!-- Floral ornament -->
        <div class="mt-5 flex items-center justify-center">
          <svg class="w-16 h-8 text-sage/25" viewBox="0 0 120 50" fill="currentColor">
            <path d="M60 8 C50 20, 35 25, 20 22 C32 28, 42 34, 45 44 C52 34, 56 28, 60 22 C64 28, 68 34, 75 44 C78 34, 88 28, 100 22 C85 25, 70 20, 60 8Z"/>
            <circle cx="60" cy="22" r="3"/>
          </svg>
        </div>
      </div>

      <!-- Form -->
      <form @submit.prevent="addWish" class="reveal floral-card p-6 md:p-8 mb-8">
        <div class="space-y-4">
          <input
            v-model="name"
            type="text"
            required
            placeholder="Nama Anda"
            class="form-input"
          />
          <textarea
            v-model="newWish.message"
            required
            rows="3"
            placeholder="Tulis ucapan & doa untuk kedua mempelai..."
            class="form-input resize-none"
          ></textarea>
          <button
            type="submit"
            :disabled="isSubmitting"
            class="px-8 py-3 text-sm tracking-[0.15em] uppercase rounded-xl shadow-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed font-medium"
            style="background: linear-gradient(135deg, var(--color-sage-dark), var(--color-sage)); color: #faf8f5;"
          >
            {{ isSubmitting ? 'Mengirim...' : 'Kirim Ucapan' }}
          </button>
        </div>
      </form>

      <p v-if="errorMessage" class="mb-6 text-sm text-rose text-center">{{ errorMessage }}</p>

      <!-- Wishes -->
      <div class="max-h-[28rem] md:max-h-[36rem] overflow-y-auto pr-1 guestbook-scroll">
        <div class="space-y-4 stagger">
          <TransitionGroup name="list">
            <div
              v-for="wish in wishes"
              :key="wish.id"
              class="glass-card-light rounded-2xl p-6"
            >
              <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-sage/10 flex items-center justify-center shrink-0">
                  <span class="font-heading text-lg text-sage">{{ wish.name.charAt(0).toUpperCase() }}</span>
                </div>
                <div>
                  <p class="font-heading text-lg text-cream">{{ wish.name }}</p>
                  <p class="text-cream/50 text-sm mt-1 leading-relaxed">{{ wish.message }}</p>
                </div>
              </div>
            </div>
          </TransitionGroup>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import config from '../../config.json'
import { readStoredJson, writeStoredJson } from '../../composables/useJsonStorage'
import { hasWeddingApi, requestWeddingApi } from '../../composables/useWeddingApi'
import { useGuestName } from '../../composables/useGuestName'

const GUESTBOOK_STORAGE_KEY = 'wedding:guestbookWishes'

const name = useGuestName()
const newWish = ref({ name: '', message: '' })

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
const hearts = Array.from({ length: 6 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 20 + Math.random() * 22,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 3],
}))

const wishes = ref(readStoredJson(GUESTBOOK_STORAGE_KEY, [...config.initialWishes]))
const isSubmitting = ref(false)
const errorMessage = ref('')

writeStoredJson(GUESTBOOK_STORAGE_KEY, wishes.value)
let nextId = wishes.value.reduce((maxId, wish) => Math.max(maxId, Number(wish.id) || 0), 0) + 1

onMounted(async () => {
  if (!hasWeddingApi()) return
  try {
    const response = await requestWeddingApi('/guestbook.php')
    wishes.value = Array.isArray(response.data) ? response.data : []
  } catch (error) {
    errorMessage.value = error instanceof Error ? error.message : 'Buku tamu gagal dimuat.'
  }
})

async function addWish() {
  isSubmitting.value = true
  errorMessage.value = ''
  const wish = {
    id: nextId++,
    name: name.value.trim(),
    message: newWish.value.message.trim(),
    createdAt: new Date().toISOString(),
  }
  try {
    if (hasWeddingApi()) {
      const response = await requestWeddingApi('/guestbook.php', {
        method: 'POST',
        body: JSON.stringify({ name: wish.name, message: wish.message }),
      })
      if (response.data) wishes.value.unshift(response.data)
    } else {
      wishes.value.unshift(wish)
      writeStoredJson(GUESTBOOK_STORAGE_KEY, wishes.value)
    }
    newWish.value = { name: '', message: '' }
    name.value = ''
  } catch (error) {
    errorMessage.value = error instanceof Error ? error.message : 'Ucapan gagal dikirim.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.list-enter-active { transition: all 0.4s ease-out; }
.list-enter-from { opacity: 0; transform: translateY(-20px); }

.guestbook-scroll::-webkit-scrollbar { width: 5px; }
.guestbook-scroll::-webkit-scrollbar-track { background: transparent; }
.guestbook-scroll::-webkit-scrollbar-thumb { background: var(--color-sage); border-radius: 999px; }
.guestbook-scroll { scrollbar-width: thin; scrollbar-color: var(--color-sage) transparent; }
</style>
