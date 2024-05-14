import { fileURLToPath, URL } from 'node:url'

import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'

// eslint-disable-next-line no-undef
process.env = Object.assign(process.env, loadEnv(import.meta.mode, process.cwd(), ''))

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  optimizeDeps: {
    include: ['swiper/vue', 'swiper/modules', 'vue-awesome-swiper'] // Ensure Swiper and vue-awesome-swiper are included in optimizeDeps
  },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  server: {
    // eslint-disable-next-line no-undef
    port: process.env.TEST_PORT
  }
})
