import { resolve } from "path";
import { defineConfig } from "vite";
import symfonyPlugin from "vite-plugin-symfony";

/* if you're using React */
// import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    /* react(), // if you're using React */
    symfonyPlugin(),
  ],
  build: {
    manifest: true,
    emptyOutDir: true,
    assetsDir: "",
    cssCodeSplit: true,
    format: "cjs",
    outDir: "./public/build/",
    rollupOptions: {
      input: {
        app: "./assets/js/main.js",
      },
    },
  },
});
