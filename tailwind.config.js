import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            colors: {
                'ctm-burgundy': {
                    DEFAULT: '#7A1F2E',
                    dark: '#5D1722',
                    light: '#9A3040',
                },
                'ctm-teal': {
                    DEFAULT: '#007A8C',
                    dark: '#005F6B',
                    light: '#2B6B75',
                },
                'ctm-black': '#0A1F2E',
                'ctm-cream': '#F5F5F5',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Bowlby One SC', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
