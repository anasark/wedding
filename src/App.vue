<script setup>
import { ref, nextTick, onMounted } from 'vue'
import { useScrollReveal } from './composables/useScrollReveal'
import { hasWeddingApi, requestWeddingApi } from './composables/useWeddingApi'
import HeroSection from './components/HeroSection.vue'
import QuoteSection from './components/QuoteSection.vue'
import CoupleProfile from './components/CoupleProfile.vue'
import EventDetails from './components/EventDetails.vue'
import Countdown from './components/Countdown.vue'
import RSVPForm from './components/RSVPForm.vue'
import Guestbook from './components/Guestbook.vue'
import GiftSection from './components/GiftSection.vue'
import MapSection from './components/MapSection.vue'
import FooterSection from './components/Footer.vue'

const opened = ref(false)

useScrollReveal()

onMounted(() => {
  console.log('[DEBUG] App.vue is starting tracking process.')
  console.log('[DEBUG] hasWeddingApi() result:', hasWeddingApi())

  // Hanya track jika koneksi ke API backend dinamis dikonfigurasi
  if (hasWeddingApi()) {
    console.log('[DEBUG] API configured! Sending tracking request to /visit.php...')
    // Gunakan nama /visit.php agar tidak diblokir oleh AdBlocker / Brave Shields
    requestWeddingApi('/visit.php', { method: 'POST' })
      .then((res) => console.log('[DEBUG] Tracking request returned:', res))
      .catch((err) => console.error('[DEBUG] Tracking request threw an error:', err))
  } else {
    console.log('[DEBUG] hasWeddingApi returned false. Tracking skipped.')
  }
})

function openInvitation() {
  opened.value = true
  nextTick(() => {
    document.getElementById('quote')?.scrollIntoView({ behavior: 'smooth' })
    // Re-observe new sections
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) entry.target.classList.add('visible')
        })
      },
      { threshold: 0.1 }
    )
    document
      .querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .zoom-in-3d, .flip-in')
      .forEach((el) => observer.observe(el))
  })
}
</script>

<template>
  <div class="min-h-screen bg-ivory">
    <HeroSection :opened="opened" @open="openInvitation" />

    <template v-if="opened">
      <div id="quote">
        <QuoteSection />
      </div>
      <CoupleProfile />
      <EventDetails />
      <Countdown />
      <RSVPForm />
      <Guestbook />
      <GiftSection />
      <MapSection />
      <FooterSection />
    </template>
  </div>
</template>
