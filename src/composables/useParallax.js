import { ref, onMounted, onUnmounted } from 'vue'

export function useParallax(elementRef, { maxOffset = 36, axis = 'y', reverse = false } = {}) {
  const parallaxStyle = ref({ transform: 'translate3d(0, 0, 0)' })
  let reduceMotionQuery = null

  function clamp(value, min, max) {
    return Math.min(max, Math.max(min, value))
  }

  function updateParallax() {
    if (!elementRef.value || typeof window === 'undefined') {
      return
    }

    if (reduceMotionQuery?.matches) {
      parallaxStyle.value = { transform: 'translate3d(0, 0, 0)' }
      return
    }

    const rect = elementRef.value.getBoundingClientRect()
    const viewportHeight = window.innerHeight || 1
    const elementCenter = rect.top + rect.height / 2
    const viewportCenter = viewportHeight / 2
    const progress = clamp((viewportCenter - elementCenter) / viewportHeight, -1, 1)
    const offset = clamp(progress * maxOffset, -maxOffset, maxOffset) * (reverse ? -1 : 1)

    parallaxStyle.value = axis === 'x'
      ? { transform: `translate3d(${offset.toFixed(2)}px, 0, 0)` }
      : { transform: `translate3d(0, ${offset.toFixed(2)}px, 0)` }
  }

  onMounted(() => {
    if (typeof window === 'undefined') {
      return
    }

    reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)')
    updateParallax()
    window.addEventListener('scroll', updateParallax, { passive: true })
    window.addEventListener('resize', updateParallax)
  })

  onUnmounted(() => {
    if (typeof window === 'undefined') {
      return
    }

    window.removeEventListener('scroll', updateParallax)
    window.removeEventListener('resize', updateParallax)
  })

  return { parallaxStyle }
}