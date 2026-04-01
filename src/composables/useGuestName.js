import { ref } from 'vue'

const name = ref('')

export function useGuestName() {
  return name
}
