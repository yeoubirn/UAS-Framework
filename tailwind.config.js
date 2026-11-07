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
                    DEFAULT: '#1D4ED8',
                    dark: '#1E3A8A',
                },
                accent: {
                    DEFAULT: '#F59E0B',
                    hover: '#D97706',
                },
                surface: {
                    bg: '#F8FAFC',
                    card: '#FFFFFF',
                    border: '#E2E8F0',
                },
                content: {
                    primary: '#0F172A',
                    secondary: '#64748B',
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
