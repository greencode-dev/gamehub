import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.jsx'],
            refresh: true,
        }),
    ],
    resolve: {
        extensions: ['.jsx', '.js', '.ts', '.tsx', '.json'],
    },
    server: {
        cors: true,
        host: 'localhost',
    },
});
