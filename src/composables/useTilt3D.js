import { ref, onMounted, onUnmounted } from 'vue'

export function useTilt3D(elementRef, { max = 8, speed = 400, scale = 1.02 } = {}) {
  const tiltStyle = ref({})
  let rect = null

  function onMouseMove(e) {
    if (!elementRef.value) return
    rect = elementRef.value.getBoundingClientRect()
    const x = (e.clientX - rect.left) / rect.width
    const y = (e.clientY - rect.top) / rect.height
    const rotateX = (max - y * max * 2).toFixed(2)
    const rotateY = (x * max * 2 - max).toFixed(2)

    tiltStyle.value = {
      transform: `perspective(${speed}px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(${scale}, ${scale}, ${scale})`,
      transition: 'transform 0.15s ease-out'
    }
  }

  function onMouseLeave() {
    tiltStyle.value = {
      transform: 'perspective(600px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)',
      transition: 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)'
    }
  }

  onMounted(() => {
    if (!elementRef.value) return
    elementRef.value.addEventListener('mousemove', onMouseMove)
    elementRef.value.addEventListener('mouseleave', onMouseLeave)
  })

  onUnmounted(() => {
    if (!elementRef.value) return
    elementRef.value.removeEventListener('mousemove', onMouseMove)
    elementRef.value.removeEventListener('mouseleave', onMouseLeave)
  })

  return { tiltStyle }
}
