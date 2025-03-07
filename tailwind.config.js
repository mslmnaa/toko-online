import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f3faf4', // Hijau sangat muda
                    100: '#d3f0d9',
                    200: '#a9e0b4',
                    300: '#7fd08f',
                    400: '#55c06a',
                    500: '#2cb045', // Hijau utama
                    600: '#229138',
                    700: '#1a712b',
                    800: '#12521f',
                    900: '#0a3213',
                },
                secondary: {
                    50: '#fff5f5', // Merah muda terang
                    100: '#ffe3e3',
                    200: '#ffc9c9',
                    300: '#ffabab',
                    400: '#ff8c8c',
                    500: '#ff6e6e', // Merah segar (terkait sembako/makanan)
                    600: '#cc5858',
                    700: '#994141',
                    800: '#662b2b',
                    900: '#331515',
                },
                accent: {
                    50: '#fffbea', // Kuning pucat
                    100: '#fff3c4',
                    200: '#ffe899',
                    300: '#ffdb6e',
                    400: '#ffcf44',
                    500: '#ffc31a', // Kuning keemasan (untuk daya tarik CTA)
                    600: '#cc9c15',
                    700: '#997410',
                    800: '#664d0a',
                    900: '#332705',
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
};
