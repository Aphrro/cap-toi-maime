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
                'cap': {
                    50: '#fdf2f3',
                    100: '#fce7e8',
                    200: '#f9d2d5',
                    300: '#f4adb3',
                    400: '#ec7f8a',
                    500: '#e05264',
                    600: '#cb334a',
                    700: '#a9273d',
                    800: '#8d2438',
                    900: '#722F37',
                    950: '#440f18',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Bowlby One SC', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
