<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbRef"
        class="p-layer absolute -top-20 left-[-4rem] h-56 w-56 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(196,145,138,0.1), transparent 70%)' }"
      ></div>
      <!-- Floral corners -->
      <svg class="absolute top-0 right-0 w-28 h-28 text-gold/[0.06]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleX(-1)">
        <path d="M0 0 C30 20, 50 60, 40 100 C30 80, 15 50, 0 40Z"/>
        <path d="M0 0 C20 30, 60 50, 100 40 C80 30, 50 15, 40 0Z"/>
      </svg>
      <svg class="absolute bottom-0 left-0 w-24 h-24 text-rose/[0.06]" viewBox="0 0 200 200" fill="currentColor" style="transform: scaleY(-1)">
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
        <p class="text-gold/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Konfirmasi Kehadiran</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">RSVP</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-gold/60 to-transparent"></div>
        <div class="mt-5 flex items-center justify-center">
          <svg class="w-20 h-8 text-gold/25" viewBox="0 0 160 50" fill="currentColor">
            <path d="M80 10 C70 20, 55 25, 40 22 C50 28, 60 32, 65 42 C70 32, 75 28, 80 24 C85 28, 90 32, 95 42 C100 32, 110 28, 120 22 C105 25, 90 20, 80 10Z"/>
            <path d="M80 24 L76 30 L80 36 L84 30 Z" opacity="0.5"/>
          </svg>
        </div>
      </div>

      <form @submit.prevent="submitForm" class="reveal glass-card ornament-corners rounded-2xl p-8 md:p-10">
        <div class="space-y-6">
          <!-- Name -->
          <div>
            <label class="block text-cream/70 text-sm font-medium mb-2">Nama Lengkap</label>
            <input
              v-model="form.name"
              type="text"
              required
              placeholder="Masukkan nama Anda"
              class="form-input"
            />
          </div>

          <!-- Attendance -->
          <div>
            <label class="block text-cream/70 text-sm font-medium mb-3">Apakah Anda akan hadir?</label>
            <div class="flex gap-4">
              <label
                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border cursor-pointer transition-all text-sm"
                :class="form.attendance === 'yes'
                  ? 'border-gold bg-gold/10 text-gold'
                  : 'border-cream/15 text-cream/40 hover:border-gold/30'"
              >
                <input v-model="form.attendance" type="radio" value="yes" class="sr-only" />
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                Hadir
              </label>
              <label
                class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl border cursor-pointer transition-all text-sm"
                :class="form.attendance === 'no'
                  ? 'border-rose bg-rose/10 text-rose'
                  : 'border-cream/15 text-cream/40 hover:border-rose/30'"
              >
                <input v-model="form.attendance" type="radio" value="no" class="sr-only" />
                Tidak Hadir
              </label>
            </div>
          </div>

          <!-- Number of Guests -->
          <div v-if="form.attendance === 'yes'">
            <label class="block text-cream/70 text-sm font-medium mb-2">Jumlah Tamu</label>
            <select v-model="form.guests" class="form-input">
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
            class="w-full py-3.5 text-sm tracking-[0.15em] uppercase rounded-xl shadow-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed font-medium"
            style="background: linear-gradient(135deg, var(--color-gold-dark), var(--color-gold)); color: #faf8f5;"
          >
            {{ isSubmitting ? 'Mengirim...' : submitted ? 'Terima Kasih!' : 'Kirim RSVP' }}
          </button>
        </div>
      </form>

      <p v-if="errorMessage" class="mt-4 text-sm text-rose text-center">{{ errorMessage }}</p>

      <transition name="slide-up">
        <div v-if="submitted" class="mt-6 text-center">
          <p class="text-gold font-heading text-xl">Konfirmasi Anda telah tercatat!</p>
          <p class="text-cream/50 text-sm mt-1">Terima kasih atas responnya.</p>
        </div>
      </transition>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'
import { useParallax } from '../../composables/useParallax'
import { readStoredJson, writeStoredJson } from '../../composables/useJsonStorage'
import { hasWeddingApi, requestWeddingApi } from '../../composables/useWeddingApi'

const RSVP_STORAGE_KEY = 'wedding:rsvpResponses'

const orbRef = ref(null)
const { parallaxStyle: orbStyle } = useParallax(orbRef, { maxOffset: 60, reverse: true })

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

const form = ref({ name: '', attendance: 'yes', guests: '1' })
const submitted = ref(false)
const rsvpResponses = ref(readStoredJson(RSVP_STORAGE_KEY, []))
const isSubmitting = ref(false)
const errorMessage = ref('')

writeStoredJson(RSVP_STORAGE_KEY, rsvpResponses.value)

async function submitForm() {
  isSubmitting.value = true
  errorMessage.value = ''

  const payload = {
    name: form.value.name.trim(),
    attendance: form.value.attendance,
    guests: form.value.attendance === 'yes' ? Number(form.value.guests) : 0,
  }

  try {
    if (hasWeddingApi()) {
      const response = await requestWeddingApi('/rsvp.php', {
        method: 'POST',
        body: JSON.stringify(payload),
      })
      if (response.data) rsvpResponses.value.unshift(response.data)
    } else {
      rsvpResponses.value.unshift({
        id: Date.now(),
        ...payload,
        submittedAt: new Date().toISOString(),
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
.slide-up-enter-active { transition: all 0.4s ease-out; }
.slide-up-enter-from { opacity: 0; transform: translateY(10px); }
</style>
