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
                    DEFAULT: '#1a472a',
                    dark: '#0f2818',
                    light: '#2d5a3d',
                },
                'accent': {
                    DEFAULT: '#c9a961',
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

