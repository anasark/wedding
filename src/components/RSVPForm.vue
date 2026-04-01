<template>
  <section class="py-20 md:py-28 px-6 bg-ivory-dark/50">
    <div class="max-w-xl mx-auto">
      <div class="text-center mb-12 zoom-in-3d">
        <p class="text-gold text-sm tracking-[0.3em] uppercase mb-3">Konfirmasi Kehadiran</p>
        <h2 class="font-heading text-4xl md:text-5xl text-charcoal">RSVP</h2>
      </div>

      <form @submit.prevent="submitForm" class="fade-in bg-white rounded-2xl p-8 md:p-10 shadow-sm border border-gold/10 card-3d relative overflow-hidden">
        <div class="space-y-6">
          <!-- Name -->
          <div>
            <label class="block text-charcoal text-sm font-medium mb-2">Nama Lengkap</label>
            <input
              v-model="name"
              type="text"
              required
              placeholder="Masukkan nama Anda"
              class="w-full px-4 py-3 rounded-xl border border-gold/20 bg-ivory text-charcoal text-sm focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/30 transition placeholder:text-charcoal-light/50"
            />
          </div>

          <!-- Attendance -->
          <div>
            <label class="block text-charcoal text-sm font-medium mb-3">Apakah Anda akan hadir?</label>
            <div class="flex gap-4">
              <label
                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border cursor-pointer transition-all text-sm"
                :class="form.attendance === 'yes' ? 'border-gold bg-gold/10 text-gold' : 'border-gold/20 text-charcoal-light hover:border-gold/40'"
              >
                <input v-model="form.attendance" type="radio" value="yes" class="sr-only" />
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                Hadir
              </label>
              <label
                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border cursor-pointer transition-all text-sm"
                :class="form.attendance === 'no' ? 'border-pink-dark bg-pink/20 text-pink-dark' : 'border-gold/20 text-charcoal-light hover:border-gold/40'"
              >
                <input v-model="form.attendance" type="radio" value="no" class="sr-only" />
                Tidak Hadir
              </label>
            </div>
          </div>

          <!-- Number of Guests -->
          <div v-if="form.attendance === 'yes'">
            <label class="block text-charcoal text-sm font-medium mb-2">Jumlah Tamu</label>
            <select
              v-model="form.guests"
              class="w-full px-4 py-3 rounded-xl border border-gold/20 bg-ivory text-charcoal text-sm focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold/30 transition"
            >
              <option value="1">1 Orang</option>
              <option value="2">2 Orang</option>
              <option value="3">3 Orang</option>
              <option value="4">4 Orang</option>
              <option value="5">5 Orang</option>
            </select>
          </div>

          <!-- Submit -->
          <button
            type="submit"
            :disabled="submitted || isSubmitting"
            class="w-full py-3.5 bg-gold text-white text-sm tracking-[0.15em] uppercase rounded-xl shadow-md hover:bg-gold-dark transition-all duration-300 hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {{ isSubmitting ? 'Mengirim...' : submitted ? 'Terima Kasih!' : 'Kirim RSVP' }}
          </button>
        </div>
      </form>

      <p v-if="errorMessage" class="mt-4 text-sm text-pink-dark text-center">{{ errorMessage }}</p>

      <transition name="slide-up">
        <div v-if="submitted" class="mt-6 text-center fade-in visible">
          <p class="text-gold font-heading text-xl">Konfirmasi Anda telah tercatat!</p>
          <p class="text-charcoal-light text-sm mt-1">Terima kasih atas responnya.</p>
        </div>
      </transition>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { readStoredJson, writeStoredJson } from '../composables/useJsonStorage'
import { hasWeddingApi, requestWeddingApi } from '../composables/useWeddingApi'
import { useGuestName } from '../composables/useGuestName'

const RSVP_STORAGE_KEY = 'wedding:rsvpResponses'

const name = useGuestName()
const form = ref({
  attendance: 'yes',
  guests: '1'
})

const submitted = ref(false)
const rsvpResponses = ref(readStoredJson(RSVP_STORAGE_KEY, []))
const isSubmitting = ref(false)
const errorMessage = ref('')

writeStoredJson(RSVP_STORAGE_KEY, rsvpResponses.value)

async function submitForm() {
  isSubmitting.value = true
  errorMessage.value = ''

  const payload = {
    name: name.value.trim(),
    attendance: form.value.attendance,
    guests: form.value.attendance === 'yes' ? Number(form.value.guests) : 0,
  }

  try {
    if (hasWeddingApi()) {
      const response = await requestWeddingApi('/rsvp.php', {
        method: 'POST',
        body: JSON.stringify(payload),
      })

      if (response.data) {
        rsvpResponses.value.unshift(response.data)
      }
    } else {
      rsvpResponses.value.unshift({
        id: Date.now(),
        ...payload,
        submittedAt: new Date().toISOString()
      })
      writeStoredJson(RSVP_STORAGE_KEY, rsvpResponses.value)
    }

    submitted.value = true
  } catch (error) {
    errorMessage.value = error instanceof Error ? error.message : 'RSVP gagal dikirim.'
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
.slide-up-enter-active {
  transition: all 0.4s ease-out;
}
.slide-up-enter-from {
  opacity: 0;
  transform: translateY(10px);
}
</style>
