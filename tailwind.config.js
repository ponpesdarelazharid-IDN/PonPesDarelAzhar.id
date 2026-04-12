import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                emerald: {
                    400: '#34D399',
                    500: '#10B981',
                    600: '#059669',
                    700: '#047857'
                },
                slate: {
                    900: '#1E293B',
                },
                dark: {
                    main: '#0F172A',
                    card: '#1E293B',
                    text: '#F1F5F9'
                },
                light: {
                    main: '#F8FAFC',
                    text: '#1E293B'
                }
            }
        },
    },

    plugins: [forms],
};
