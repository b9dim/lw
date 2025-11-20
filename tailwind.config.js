import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: '1.5rem',
                lg: '2rem',
                xl: '2.5rem',
            },
        },
        extend: {
            screens: {
                xs: '480px',
                lg: '992px',
                xl: '1280px',
            },
            fontFamily: {
                sans: ['Tajawal', 'Cairo', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ink: {
                    900: '#041f1a',
                    800: '#0a261f',
                    700: '#0f2f25',
                    600: '#13392c',
                },
                fern: {
                    500: '#1f7a5a',
                    400: '#2c8d6a',
                    200: '#9fcbb7',
                },
                brass: {
                    500: '#d7b46a',
                    400: '#e3c480',
                    200: '#f4e2bb',
                },
                ivory: {
                    50: '#f9f6ef',
                    100: '#f3ede3',
                    200: '#e7dece',
                },
                slate: {
                    900: '#1f2a27',
                    700: '#2f3c39',
                    500: '#4c5c58',
                    300: '#7f8c86',
                    200: '#b0bab6',
                },
                success: '#2f9b75',
                info: '#3c80c3',
                warning: '#f7c064',
                danger: '#d95c4a',
            },
            borderRadius: {
                pill: '999px',
                xl: '2.5rem',
            },
            boxShadow: {
                soft: '0 10px 25px rgba(4,31,26,0.1)',
                medium: '0 20px 40px rgba(4,31,26,0.15)',
                strong: '0 30px 70px rgba(4,31,26,0.18)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};

