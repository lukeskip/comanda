import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'sm': '1.05rem',
                'base': '1.2rem',
                'lg': '1.35rem',
                'xl': '1.5rem',
                '2xl': '1.8rem',
              },
        },
    },

    plugins: [forms],
};
