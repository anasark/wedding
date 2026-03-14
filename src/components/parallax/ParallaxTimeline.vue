<template>
  <section class="relative overflow-hidden py-24 md:py-32 px-6 w-full watercolor-wash paper-texture">
    <!-- Parallax decorations -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <!-- Tree silhouette — left -->
      <svg class="tree-bg-left" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="60" y="500" width="28" height="400" rx="5" opacity="0.9"/>
        <ellipse cx="74" cy="400" rx="95" ry="150" opacity="0.65"/>
        <ellipse cx="55" cy="340" rx="70" ry="110" opacity="0.55"/>
        <circle cx="135" cy="310" r="28" opacity="0.45"/>
        <circle cx="15" cy="280" r="20" opacity="0.4"/>
      </svg>

      <!-- Tree silhouette — right -->
      <svg class="tree-bg-right" viewBox="0 0 400 900" fill="var(--color-sage-dark)" preserveAspectRatio="xMinYMax meet">
        <rect x="70" y="530" width="25" height="370" rx="5" opacity="0.8"/>
        <ellipse cx="82" cy="430" rx="85" ry="130" opacity="0.6"/>
        <ellipse cx="65" cy="380" rx="60" ry="95" opacity="0.5"/>
        <circle cx="140" cy="340" r="22" opacity="0.4"/>
      </svg>

      <!-- Hanging vines -->
      <svg class="vine-hang left-[5%] md:left-[10%] w-10 h-32 md:w-12 md:h-48" viewBox="0 0 50 200" fill="none" style="animation-duration: 11s">
        <path d="M25 0 Q20 35, 28 70 Q33 105, 22 140 Q18 175, 25 200" stroke="var(--color-sage)" stroke-width="2" fill="none" opacity="0.8"/>
        <path d="M28 55 Q18 50, 16 60 Q22 58, 28 55Z" fill="var(--color-sage)" opacity="0.6"/>
        <path d="M22 115 Q32 110, 34 120 Q28 118, 22 115Z" fill="var(--color-sage-light)" opacity="0.55"/>
        <circle cx="25" cy="70" r="4" fill="var(--color-sage-light)" opacity="0.5"/>
      </svg>
      <svg class="vine-hang right-[8%] md:right-[12%] w-8 h-28 md:w-10 md:h-40" viewBox="0 0 40 170" fill="none" style="animation-duration: 9s; animation-delay: -3s">
        <path d="M20 0 Q15 30, 22 60 Q28 90, 18 120 Q14 150, 20 170" stroke="var(--color-sage)" stroke-width="1.5" fill="none" opacity="0.7"/>
        <path d="M22 45 Q14 40, 12 48 Q17 46, 22 45Z" fill="var(--color-sage)" opacity="0.55"/>
        <circle cx="20" cy="90" r="3" fill="var(--color-sage-light)" opacity="0.45"/>
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

      <div
        ref="orbRef"
        class="p-layer absolute top-10 right-[-5rem] h-64 w-64 rounded-full blur-3xl"
        :style="{ ...orbStyle, background: 'radial-gradient(circle, rgba(196,145,138,0.08), transparent 70%)' }"
      ></div>
      <div
        ref="orb2Ref"
        class="p-layer absolute bottom-10 left-[-3rem] h-48 w-48 rounded-full blur-3xl"
        :style="{ ...orb2Style, background: 'radial-gradient(circle, rgba(122,158,122,0.07), transparent 70%)' }"
      ></div>
      <!-- Floral corner — top right -->
      <svg class="absolute top-0 right-0 w-36 h-36 md:w-52 md:h-52 gentle-float" style="animation-duration: 10s; transform: scaleX(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q30 45, 25 90 Q22 60, 10 35 Q5 20, 0 0Z" fill="var(--color-sage)" opacity="0.22"/>
        <path d="M15 0 Q50 30, 55 75 Q45 45, 30 20Z" fill="var(--color-sage-dark)" opacity="0.16"/>
        <path d="M0 15 Q20 50, 15 85 Q10 55, 0 30Z" fill="var(--color-sage-light)" opacity="0.18"/>
        <circle cx="45" cy="35" r="8" fill="var(--color-rose)" opacity="0.2"/>
        <circle cx="30" cy="55" r="5" fill="var(--color-blush)" opacity="0.16"/>
        <circle cx="55" cy="60" r="4" fill="var(--color-rose-light)" opacity="0.18"/>
        <path d="M40 30 Q42 20, 50 18 Q46 25, 40 30Z" fill="var(--color-sage)" opacity="0.2"/>
      </svg>

      <!-- Floral corner — bottom left -->
      <svg class="absolute bottom-0 left-0 w-32 h-32 md:w-48 md:h-48 gentle-float" style="animation-duration: 8s; animation-delay: -4s; transform: scaleY(-1)" viewBox="0 0 200 200" fill="none">
        <path d="M0 0 Q35 40, 30 85 Q25 55, 12 30 Q6 18, 0 0Z" fill="var(--color-sage-dark)" opacity="0.18"/>
        <path d="M10 0 Q45 35, 50 70 Q40 40, 25 18Z" fill="var(--color-sage)" opacity="0.15"/>
        <circle cx="38" cy="28" r="6" fill="var(--color-rose)" opacity="0.18"/>
        <circle cx="22" cy="48" r="3.5" fill="var(--color-blush)" opacity="0.14"/>
      </svg>
      <!-- Scattered petals -->
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

    <div class="relative max-w-4xl mx-auto z-10">
      <!-- Section header -->
      <div ref="headerRef" class="p-layer text-center mb-20 reveal" :style="headerStyle">
        <p class="text-sage/70 text-xs tracking-[0.4em] uppercase mb-4 font-light">Save the Date</p>
        <h2 class="font-heading text-4xl md:text-6xl text-cream">Acara Pernikahan</h2>
        <div class="mt-4 mx-auto w-16 h-px bg-gradient-to-r from-transparent via-sage/50 to-transparent"></div>
      </div>

      <!-- Timeline -->
      <div class="relative">
        <!-- Vertical line (desktop) -->
        <div class="hidden md:block timeline-line" style="background: linear-gradient(to bottom, transparent, var(--color-sage), transparent);"></div>

        <div ref="cardsRef" class="p-layer space-y-12 md:space-y-24" :style="cardsStyle">
          <div
            v-for="(event, index) in config.events"
            :key="index"
            class="relative"
            :class="index % 2 === 0 ? 'reveal-left' : 'reveal-right'"
          >
            <!-- Timeline dot (desktop) -->
            <div class="hidden md:block timeline-dot" :style="{ top: '2.5rem' }"></div>

            <div
              class="md:w-[calc(50%-3rem)] floral-card p-8 md:p-10"
              :class="index % 2 === 0 ? 'md:mr-auto' : 'md:ml-auto'"
            >
              <!-- Floral corner SVG decorations inside card -->
              <svg class="absolute top-3 left-3 w-8 h-8 text-sage/20" viewBox="0 0 40 40" fill="none">
                <path d="M5 35 Q10 20, 20 12 Q15 22, 10 30 Q8 33, 5 35Z" fill="currentColor"/>
                <circle cx="22" cy="10" r="3" fill="var(--color-rose)" opacity="0.3"/>
              </svg>
              <svg class="absolute bottom-3 right-3 w-8 h-8 text-sage/20" viewBox="0 0 40 40" fill="none" style="transform: scale(-1)">
                <path d="M5 35 Q10 20, 20 12 Q15 22, 10 30 Q8 33, 5 35Z" fill="currentColor"/>
                <circle cx="22" cy="10" r="3" fill="var(--color-rose)" opacity="0.3"/>
              </svg>

              <!-- Icon -->
              <div class="w-14 h-14 rounded-full bg-sage/10 flex items-center justify-center mb-6 mx-auto md:mx-0">
                <svg v-if="event.icon === 'heart'" class="w-7 h-7 text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <svg v-else class="w-7 h-7 text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z" />
                </svg>
              </div>

              <h3 class="font-heading text-2xl md:text-3xl text-cream mb-5 text-center md:text-left">{{ event.title }}</h3>

              <div class="space-y-3 text-cream/60 text-sm">
                <div class="flex items-center gap-3">
                  <svg class="w-4 h-4 text-sage/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                  </svg>
                  <span>{{ event.date }}</span>
                </div>
                <div class="flex items-center gap-3">
                  <svg class="w-4 h-4 text-sage/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ event.time }}</span>
                </div>
                <div class="flex items-center gap-3">
                  <svg class="w-4 h-4 text-sage/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                  </svg>
                  <span>{{ event.location }}</span>
                </div>
              </div>

              <div class="flex flex-wrap gap-3 mt-6">
                <a
                  :href="event.mapsUrl"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-flex items-center gap-2 px-6 py-2.5 border border-sage/30 text-sage text-xs tracking-[0.15em] uppercase rounded-full hover:bg-sage hover:text-ivory transition-all duration-300"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                  </svg>
                  Google Maps
                </a>
                <a
                  v-if="event.calendarUrl"
                  :href="event.calendarUrl"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-flex items-center gap-2 px-6 py-2.5 border border-rose/30 text-rose text-xs tracking-[0.15em] uppercase rounded-full hover:bg-rose hover:text-ivory transition-all duration-300"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                  </svg>
                  Add to Calendar
                </a>
              </div>
            </div>
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

const orbRef = ref(null)
const orb2Ref = ref(null)
const headerRef = ref(null)
const cardsRef = ref(null)

const { parallaxStyle: orbStyle } = useParallax(orbRef, { maxOffset: 80, reverse: true })
const { parallaxStyle: orb2Style } = useParallax(orb2Ref, { maxOffset: 60 })
const { parallaxStyle: headerStyle } = useParallax(headerRef, { maxOffset: 20, reverse: true })
const { parallaxStyle: cardsStyle } = useParallax(cardsRef, { maxOffset: 30 })

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

const heartColors = ['var(--color-rose)', 'var(--color-rose-light)', 'var(--color-blush)', 'var(--color-rose-dark)']
const hearts = Array.from({ length: 7 }, (_, i) => ({
  id: i,
  x: 5 + Math.random() * 90,
  size: 18 + Math.random() * 22,
  duration: 10 + Math.random() * 12,
  delay: Math.random() * 10,
  opacity: 0.4 + Math.random() * 0.35,
  color: heartColors[i % 4],
}))
</script>
