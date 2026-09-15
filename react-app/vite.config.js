import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],
  server: {
    port: 3000,
    proxy: {
      '/nexus_tms_doc/dispatch/api': {
        target: 'http://localhost',
        changeOrigin: true,
      },
      '/nexus_tms_doc/dispatch/videos': {
        target: 'http://localhost',
        changeOrigin: true,
      },
    },
  },
  build: {
    outDir: 'dist',
    base: '/nexus_tms_doc/dispatch/',
  },
})
