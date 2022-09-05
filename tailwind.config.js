const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'primary-blue': '#293A82',
                'primary-yellow': '#E7AE41',
                'secondary-gray': '#343A40',
                'success': '#1A873C',
                'warning': '#DE6421',
                'danger': '#C71720',
                'info': '#0072E3',
                bland:{
                    100: '#E9E9E9',
                    200: '#DDDEDE',
                    300: '#C6C7C8',
                    400: '#8F9091',
                    500: '#56585A',
                    600: '#1E2023',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
