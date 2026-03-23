<template>
  <div ref="container" class="main-scene fixed inset-0 pointer-events-none"></div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import * as THREE from 'three'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import { setupScrollAnimation } from '../../composables/useScrollAnimation'

gsap.registerPlugin(ScrollTrigger)

const container = ref(null)
let renderer, scene, camera, petalGroup, cleanupScroll

onMounted(() => {
  const el = container.value
  const width = el.clientWidth || window.innerWidth
  const height = el.clientHeight || window.innerHeight

  renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true })
  renderer.setPixelRatio(window.devicePixelRatio || 1)
  renderer.setSize(width, height)
  el.appendChild(renderer.domElement)

  scene = new THREE.Scene()
  camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000)
  camera.position.set(0, 0, 12)

  const ambient = new THREE.AmbientLight(0xffffff, 0.9)
  scene.add(ambient)
  const dir = new THREE.DirectionalLight(0xffffff, 0.6)
  dir.position.set(5, 10, 7)
  scene.add(dir)

  petalGroup = new THREE.Group()
  scene.add(petalGroup)

  // Create simple petals (plane geometry with random placement)
  const geom = new THREE.PlaneGeometry(0.6, 0.4)
  for (let i = 0; i < 60; i++) {
    const mat = new THREE.MeshStandardMaterial({ color: new THREE.Color().setHSL(0.98 - Math.random() * 0.08, 0.6, 0.7), side: THREE.DoubleSide })
    const m = new THREE.Mesh(geom, mat)
    m.position.set((Math.random() - 0.5) * 12, (Math.random() - 0.5) * 8, (Math.random() - 0.5) * 6)
    m.rotation.set(Math.random() * Math.PI, Math.random() * Math.PI, Math.random() * Math.PI)
    m.material.roughness = 0.6
    petalGroup.add(m)
  }

  let rafId
  const animate = () => {
    petalGroup.rotation.y += 0.0015
    renderer.render(scene, camera)
    rafId = requestAnimationFrame(animate)
  }
  animate()

  // Setup scroll-driven animation (GSAP ScrollTrigger) via composable
  cleanupScroll = setupScrollAnimation({ gsap, ScrollTrigger, camera, petalGroup, triggerElement: document.documentElement })

  const onResize = () => {
    const w = el.clientWidth || window.innerWidth
    const h = el.clientHeight || window.innerHeight
    camera.aspect = w / h
    camera.updateProjectionMatrix()
    renderer.setSize(w, h)
  }
  window.addEventListener('resize', onResize)

  onBeforeUnmount(() => {
    cancelAnimationFrame(rafId)
    if (cleanupScroll) cleanupScroll()
    window.removeEventListener('resize', onResize)
    renderer.dispose()
  })
})
</script>

<style scoped>
.main-scene { z-index: 0; }
</style>
