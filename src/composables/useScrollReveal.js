import { onMounted, onUnmounted } from 'vue'

export function useScrollReveal() {
  let observer = null
  const ANIMATED_CLASSES = '.fade-in, .slide-in-left, .slide-in-right, .zoom-in-3d, .flip-in'

  onMounted(() => {
    observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible')
          }
        })
      },
      { threshold: 0.1 }
    )

    document.querySelectorAll(ANIMATED_CLASSES).forEach((el) => {
      observer.observe(el)
    })
  })

  onUnmounted(() => {
    observer?.disconnect()
  })

  return { ANIMATED_CLASSES }
}
