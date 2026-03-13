<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full">
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute inset-0 bg-gradient-to-b from-deep via-forest/15 to-deep"></div>
      <!-- Floral corners -->
      <svg class="absolute top-0 left-0 w-24 h-24 text-gold/[0.06]" viewBox="0 0 200 200" fill="currentColor">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <svg class="absolute bottom-0 right-0 w-24 h-24 text-rose/[0.06]" viewBox="0 0 200 200" fill="currentColor" style="transform: scale(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
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
        <p class="text-gold/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Ucapan & Doa</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Buku Tamu</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-gold/60 to-transparent"></div>
        <!-- Floral ornament -->
        <div class="mt-5 flex items-center justify-center">
          <svg class="w-16 h-8 text-gold/25" viewBox="0 0 120 50" fill="currentColor">
            <path d="M60 8 C50 20, 35 25, 20 22 C32 28, 42 34, 45 44 C52 34, 56 28, 60 22 C64 28, 68 34, 75 44 C78 34, 88 28, 100 22 C85 25, 70 20, 60 8Z"/>
            <circle cx="60" cy="22" r="3"/>
          </svg>
        </div>
      </div>

      <!-- Form -->
      <form @submit.prevent="addWish" class="reveal glass-card ornament-corners rounded-2xl p-6 md:p-8 mb-8">
        <div class="space-y-4">
          <input
            v-model="newWish.name"
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
            style="background: linear-gradient(135deg, var(--color-gold-dark), var(--color-gold)); color: #faf8f5;"
          >
            {{ isSubmitting ? 'Mengirim...' : 'Kirim Ucapan' }}
          </button>
        </div>
      </form>

      <p v-if="errorMessage" class="mb-6 text-sm text-rose text-center">{{ errorMessage }}</p>

      <!-- Wishes -->
      <div class="space-y-4 stagger">
        <TransitionGroup name="list">
          <div
            v-for="wish in wishes"
            :key="wish.id"
            class="glass-card-light rounded-2xl p-6"
          >
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center shrink-0">
                <span class="font-heading text-lg text-gold">{{ wish.name.charAt(0).toUpperCase() }}</span>
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
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import config from '../../config.json'
import { readStoredJson, writeStoredJson } from '../../composables/useJsonStorage'
import { hasWeddingApi, requestWeddingApi } from '../../composables/useWeddingApi'

const GUESTBOOK_STORAGE_KEY = 'wedding:guestbookWishes'

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
    name: newWish.value.name.trim(),
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
</style>
