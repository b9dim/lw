import defaultTheme from 'tailwindcss/defaultTheme';

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
                sans: ['Cairo', 'Tajawal', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    DEFAULT: '#115E3B',
                    dark: '#0B2F24',
                    light: '#2d5a3d',
                },
                'primaryDark': '#0B2F24',
                'deep': '#072017',
                'gold': {
                    DEFAULT: '#C8A848',
                    dark: '#A0842F',
                },
                'accent': {
                    DEFAULT: '#C8A848',
                },
                'text': {
                    dark: '#1a1a1a',
                    gray: '#666666',
                    light: '#999999',
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};

