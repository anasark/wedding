<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full watercolor-wash paper-texture">
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div
        ref="orbRef"
        class="p-layer absolute -top-20 left-[-4rem] h-56 w-56 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(196,145,138,0.1), transparent 70%)' }"
      ></div>

      <!-- Tree silhouettes -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="57" y="490" width="27" height="410" rx="5" opacity="0.85"/>
        <ellipse cx="70" cy="390" rx="90" ry="145" opacity="0.6"/>
        <ellipse cx="52" cy="330" rx="65" ry="105" opacity="0.5"/>
        <circle cx="128" cy="300" r="24" opacity="0.4"/>
      </svg>
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="66" y="520" width="23" height="380" rx="5" opacity="0.75"/>
        <ellipse cx="78" cy="420" rx="80" ry="126" opacity="0.55"/>
        <ellipse cx="60" cy="365" rx="56" ry="88" opacity="0.45"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[5%] w-8 h-28 md:w-10 md:h-42" viewBox="0 0 40 170" fill="none" style="animation-duration: 11s">
        <path d="M20 0 Q16 28, 24 56 Q30 84, 17 115 Q13 143, 20 170" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.7"/>
        <path d="M24 42 Q14 37, 12 47 Q18 45, 24 42Z" fill="var(--color-sage)" opacity="0.55"/>
        <circle cx="20" cy="60" r="3" fill="var(--color-sage-light)" opacity="0.45"/>
      </svg>
      <svg class="vine-hang right-[7%] w-6 h-24 md:w-8 md:h-36" viewBox="0 0 30 150" fill="none" style="animation-duration: 9s; animation-delay: -4s">
        <path d="M15 0 Q19 22, 11 48 Q7 72, 17 96 Q21 120, 15 150" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.6"/>
        <path d="M11 32 Q20 28, 22 36 Q17 34, 11 32Z" fill="var(--color-sage)" opacity="0.5"/>
      </svg>

      <!-- Floral corner — top right -->
      <svg class="absolute top-0 right-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 10s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.2"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.15"/>
        <circle cx="42" cy="32" r="7" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="28" cy="52" r="4.5" fill="var(--color-blush)" opacity="0.15"/>
      </svg>

      <!-- Floral corner — bottom left -->
      <svg class="absolute bottom-0 left-0 w-28 h-28 md:w-44 md:h-44 gentle-float" style="animation-duration: 9s; animation-delay: -3s; transform: scaleY(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <circle cx="35" cy="28" r="6" fill="var(--color-rose)" opacity="0.16"/>
        <circle cx="20" cy="45" r="3.5" fill="var(--color-blush)" opacity="0.13"/>
      </svg>

      <!-- Leaf watercolor accents -->
      <svg class="leaf-accent top-0 right-0 w-28 h-28 gentle-float" style="animation-duration: 10s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M25 170 Q50 110, 90 75 Q70 110, 55 140 Q40 158, 25 170Z" fill="var(--color-sage)" opacity="0.1"/>
        <circle cx="95" cy="70" r="3" fill="var(--color-rose)" opacity="0.1"/>
      </svg>
      <svg class="leaf-accent bottom-0 left-0 w-24 h-24 gentle-float" style="animation-duration: 8s; animation-delay: -4s; transform: scaleY(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M20 160 Q45 100, 80 70 Q60 100, 45 135 Q32 150, 20 160Z" fill="var(--color-sage-light)" opacity="0.08"/>
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
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Konfirmasi Kehadiran</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">RSVP</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>
        <div class="mt-5 flex items-center justify-center">
          <svg class="w-20 h-8 text-sage/25" viewBox="0 0 160 50" fill="currentColor">
            <path d="M80 10 C70 20, 55 25, 40 22 C50 28, 60 32, 65 42 C70 32, 75 28, 80 24 C85 28, 90 32, 95 42 C100 32, 110 28, 120 22 C105 25, 90 20, 80 10Z"/>
            <path d="M80 24 L76 30 L80 36 L84 30 Z" opacity="0.5"/>
          </svg>
        </div>
      </div>

      <form @submit.prevent="submitForm" class="reveal floral-card p-8 md:p-10">
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
                  ? 'border-sage bg-sage/10 text-sage'
                  : 'border-cream/15 text-cream/40 hover:border-sage/30'"
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
            style="background: linear-gradient(135deg, var(--color-sage-dark), var(--color-sage)); color: #faf8f5;"
          >
            {{ isSubmitting ? 'Mengirim...' : submitted ? 'Terima Kasih!' : 'Kirim RSVP' }}
          </button>
        </div>
      </form>

      <p v-if="errorMessage" class="mt-4 text-sm text-rose text-center">{{ errorMessage }}</p>

      <transition name="slide-up">
        <div v-if="submitted" class="mt-6 text-center">
          <p class="text-sage font-heading text-xl">Konfirmasi Anda telah tercatat!</p>
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
