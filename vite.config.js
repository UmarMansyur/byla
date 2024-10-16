import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                'resources/views/admin/**/*.blade.php',
                'resources/views/pengguna/**/*.blade.php',
                'app/**/*.php',
                'config/**/*.php',
                'routes/**/*.php',
                'app/Http/Controllers/**/*.php',
                'app/Models/**/*.php',
                'app/Http/Services/**/*.php',
            ],
        }),
    ],
});
