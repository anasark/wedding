import { gsap } from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'

export function setupScrollAnimation({ gsap: gsapInstance, ScrollTrigger: ScrollTriggerClass, camera, petalGroup, triggerElement = document.documentElement }) {
  const g = gsapInstance || gsap
  const ST = ScrollTriggerClass || ScrollTrigger
  g.registerPlugin(ST)

  const tl = g.timeline({
    scrollTrigger: {
      trigger: triggerElement,
      start: 'top top',
      end: 'bottom bottom',
      scrub: true,
      invalidateOnRefresh: true,
    }
  })

  // Camera zoom-in and subtle offset as user scrolls
  tl.to(camera.position, { z: 6, duration: 1, ease: 'none' }, 0)
  tl.to(camera.position, { x: 0.8, y: -0.6, duration: 1, ease: 'none' }, 0.2)

  // Petal group rotation and drift mapped to scroll progress
  tl.to(petalGroup.rotation, { y: Math.PI * 1.5, x: Math.PI * 0.4, duration: 1, ease: 'none' }, 0)
  tl.to(petalGroup.position, { y: -2, duration: 1, ease: 'none' }, 0)

  function cleanup() {
    const all = ST.getAll ? ST.getAll() : []
    all.forEach(s => s.kill && s.kill())
    tl.kill()
  }

  return cleanup
}
