import { defineConfig } from 'vite'
import liveReload from 'vite-plugin-live-reload'
import { resolve } from 'path'

export default defineConfig({
  root: process.cwd(),

  plugins: [
    liveReload(__dirname+'/**/*.php')
  ],

  base: process.env.NODE_ENV === 'development' ? '/' : '/dist/',

  build: {
    outDir: resolve(__dirname, './dist'),
    emptyOutDir: true,

    // IMPORTANT: Enable CSS code splitting
    cssCodeSplit: true,

    // Generate CSS files separately
    cssMinify: true,

    manifest: true,

    rollupOptions: {
      input: {
        main: resolve(__dirname, 'main.js')
      },
      output: {
        assetFileNames: (assetInfo) => {
          // Explicitly handle CSS files
          if (assetInfo.name.endsWith('.css')) {
            return 'assets/[name].[hash][extname]'
          }
          return 'assets/[name].[hash][extname]'
        }
      }
    }
  },

  css: {
    // Enable CSS source maps
    devSourcemap: true
  },

  server: {
    cors: true,
    strictPort: true,
    port: 3000,
    https: false,
    hmr: {
      host: 'localhost'
    }
  }
})