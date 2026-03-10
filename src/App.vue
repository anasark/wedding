<script setup>
import { ref, nextTick } from 'vue'
import { useScrollReveal } from './composables/useScrollReveal'
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
