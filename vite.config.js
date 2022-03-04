// vite.config.js
import { resolve } from "path";
import { unlinkSync, existsSync } from "fs";
import symfonyPlugin from 'vite-plugin-symfony';

export default {
  plugins: [symfonyPlugin()],
  server: {
    watch: {
      disableGlobbing: false,
    },
  },
  root: "./assets",
  base: "/build/",
  build: {
    manifest: true,
    emptyOutDir: true,
    assetsDir: "",
    cssCodeSplit: true,
    format: 'cjs',
    outDir: "../public/build/",
    rollupOptions: {
      input: {
        app: "./assets/js/main.js", 
      },
    },
  },
};