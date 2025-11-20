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
                        900: '#050d1c',
                        800: '#08142c',
                        700: '#0d1f3d',
                        600: '#10274c',
                    },
                    royal: {
                        500: '#1b3d6b',
                        400: '#25507f',
                        300: '#2f5f91',
                    },
                    gold: {
                        DEFAULT: '#f2c572',
                        600: '#d8a648',
                        500: '#f2c572',
                        400: '#f7dca1',
                        200: '#fff2d6',
                    },
                    fern: {
                        500: '#1f7a5a',
                        400: '#2c8d6a',
                        200: '#9fcbb7',
                    },
                    brass: {
                        500: '#f2c572',
                        400: '#f7dca1',
                        200: '#fff2d6',
                    },
                    ivory: {
                        50: '#fdfaf3',
                        100: '#f4efe5',
                        200: '#e9e2d1',
                    },
                    slate: {
                        900: '#101828',
                        700: '#1f2c45',
                        500: '#4b587d',
                        300: '#7c88a8',
                        200: '#b6bed4',
                    },
                    primaryDark: '#0b152a',
                    deep: '#030a18',
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

