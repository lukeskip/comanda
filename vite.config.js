import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import dotenv from 'dotenv';

export default defineConfig(({ mode }) => {
    const env = dotenv.config({ path: `.env` }).parsed;

    return {
        plugins: [
            laravel({
                input: 'resources/js/app.js',
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        css: {
            preprocessorOptions: {
                scss: {
                    additionalData: `@import "resources/scss/globals.scss";`,
                },
            },
        },
        define: {
            'process.env': env
        }
    };
});
