const apiBaseUrl = (import.meta.env.VITE_API_BASE_URL || '').trim().replace(/\/$/, '')

export function hasWeddingApi() {
  return apiBaseUrl.length > 0
}

export async function requestWeddingApi(path, options = {}) {
  if (!hasWeddingApi()) {
    throw new Error('Wedding API URL is not configured.')
  }

  const normalizedPath = path.startsWith('/') ? path : `/${path}`
  const response = await fetch(`${apiBaseUrl}${normalizedPath}`, {
    headers: {
      'Content-Type': 'application/json',
      ...(options.headers || {}),
    },
    ...options,
  })

  const payload = await response.json().catch(() => ({}))

  if (!response.ok) {
    throw new Error(payload.message || 'Request failed.')
  }

  return payload
}