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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#06B6D4',
                    dark: '#0891B2',
                },
                navy: {
                    DEFAULT: '#0B1F4B',
                    dark: '#071533',
                    light: '#132B66',
                },
                accent: {
                    DEFAULT: '#F97316',
                    hover: '#EA580C',
                },
                surface: {
                    bg: '#F0F9FF',
                    card: '#FFFFFF',
                    border: '#BAE6FD',
                },
                content: {
                    primary: '#0F172A',
                    secondary: '#475569',
                },
                category: {
                    proyektor: '#7C3AED',
                    cctv: '#EA580C',
                    wifi: '#0891B2',
                },
                status: {
                    pending: '#F59E0B',
                    dikonfirmasi: '#2563EB',
                    selesai: '#16A34A',
                    ditolak: '#DC2626',
                },
            },
        },
    },

    plugins: [forms],
};
