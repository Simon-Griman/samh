import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {resolve} from 'path';

export default defineConfig({
    plugins: [
        laravel([
            'resources/sass/app.scss',
            'resources/js/app.js',
        ]),
    ],
});
