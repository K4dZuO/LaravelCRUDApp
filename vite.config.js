import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss', // Укажите SCSS-файл
                'resources/js/app.js',    // Укажите JS-файл
            ],
            refresh: true, // Автообновление
        }),
    ],
});
