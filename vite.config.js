import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: true,
    hmr: {
      host: 'localhost',
    },
  },
  build: {
    manifest: true,
    outDir: path.resolve(__dirname, 'public/build'),
    emptyOutDir: true,
    rollupOptions: {
      input: 'resources/js/main.ts',
    },
  },
})
