import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import preact from '@preact/preset-vite';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/assets/js/app.jsx',
        'resources/assets/scss/styles.scss',
      ],
    }),
    preact(),
  ],
});
