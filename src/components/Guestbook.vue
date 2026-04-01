<template>
  <section class="py-20 md:py-28 px-6">
    <div class="max-w-2xl mx-auto">
      <div class="text-center mb-12 zoom-in-3d">
        <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Ucapan & Doa</p>
        <h2 class="font-heading text-4xl md:text-5xl text-charcoal">Buku Tamu</h2>
      </div>

      <!-- Wish Form -->
      <form @submit.prevent="addWish" class="fade-in bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gold/10 mb-8 card-3d relative overflow-hidden">
        <div class="space-y-4">
          <input
            v-model="name"
            type="text"
            required
            placeholder="Your name"
            class="w-full px-4 py-3 rounded-xl border border-gold/20 bg-ivory text-charcoal text-sm focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/30 transition placeholder:text-charcoal-light/50"
          />
          <textarea
            v-model="newWish.message"
            required
            rows="3"
              placeholder="Tulis ucapan & doa untuk kedua mempelai..."
            class="w-full px-4 py-3 rounded-xl border border-gold/20 bg-ivory text-charcoal text-sm focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/30 transition resize-none placeholder:text-charcoal-light/50"
          ></textarea>
          <button
            type="submit"
            :disabled="isSubmitting"
            class="px-8 py-3 bg-gold text-white text-sm tracking-[0.15em] uppercase rounded-xl shadow-md hover:bg-gold-dark transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {{ isSubmitting ? 'Mengirim...' : 'Kirim Ucapan' }}
          </button>
        </div>
      </form>

      <p v-if="errorMessage" class="mb-6 text-sm text-pink-dark text-center">{{ errorMessage }}</p>

      <!-- Wishes List -->
      <div class="space-y-4">
        <TransitionGroup name="list">
          <div
            v-for="wish in wishes"
            :key="wish.id"
            class="bg-white rounded-2xl p-6 shadow-sm border border-gold/10"
          >
            <div class="flex items-start gap-3">
              <div class="w-10 h-10 rounded-full bg-pink-light flex items-center justify-center shrink-0">
                <span class="font-heading text-lg text-gold">{{ wish.name.charAt(0).toUpperCase() }}</span>
              </div>
              <div>
                <p class="font-heading text-lg text-charcoal">{{ wish.name }}</p>
                <p class="text-charcoal-light text-sm mt-1 leading-relaxed">{{ wish.message }}</p>
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
import config from '../config.json'
import { readStoredJson, writeStoredJson } from '../composables/useJsonStorage'
import { hasWeddingApi, requestWeddingApi } from '../composables/useWeddingApi'
import { useGuestName } from '../composables/useGuestName'

const GUESTBOOK_STORAGE_KEY = 'wedding:guestbookWishes'

const name = useGuestName()
const newWish = ref({ name: '', message: '' })

const wishes = ref(readStoredJson(GUESTBOOK_STORAGE_KEY, [...config.initialWishes]))
const isSubmitting = ref(false)
const errorMessage = ref('')

writeStoredJson(GUESTBOOK_STORAGE_KEY, wishes.value)

let nextId = wishes.value.reduce((maxId, wish) => Math.max(maxId, Number(wish.id) || 0), 0) + 1

onMounted(async () => {
  if (!hasWeddingApi()) {
    return
  }

  try {
    const response = await requestWeddingApi('/guestbook.php')
    wishes.value = Array.isArray(response.data) ? response.data : []
  } catch (error) {
    console.error('Buku tamu API error:', error)
    // Silently use the local stored wishes, no UI error text
  }
})

async function addWish() {
  isSubmitting.value = true
  errorMessage.value = ''

  const wish = {
    id: nextId++,
    name: name.value.trim(),
    message: newWish.value.message.trim(),
    createdAt: new Date().toISOString()
  }

  try {
    if (hasWeddingApi()) {
      const response = await requestWeddingApi('/guestbook.php', {
        method: 'POST',
        body: JSON.stringify({
          name: wish.name,
          message: wish.message,
        }),
      })

      if (response.data) {
        wishes.value.unshift(response.data)
      }
    } else {
      wishes.value.unshift(wish)
      writeStoredJson(GUESTBOOK_STORAGE_KEY, wishes.value)
    }

    newWish.value = { name: '', message: '' }
    name.value = ''
  } catch (error) {
    console.error('Kirim ucapan API error:', error)
    // Walaupun fetch gagal (misal kena CORS), tetap kita tampilkan di UI (offline fallback) 
    // supaya UX tetap bagus dan seolah berhasil
    wishes.value.unshift(wish)
    writeStoredJson(GUESTBOOK_STORAGE_KEY, wishes.value)
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.list-enter-active {
  transition: all 0.4s ease-out;
}
.list-enter-from {
  opacity: 0;
  transform: translateY(-20px);
}
</style>
