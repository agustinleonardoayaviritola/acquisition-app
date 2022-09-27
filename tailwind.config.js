const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        screens: {
            'sm': '640px',
            // => @media (min-width: 640px) { ... }

            'md': '768px',
            // => @media (min-width: 768px) { ... }

            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }

            'xl': '1280px',
            // => @media (min-width: 1280px) { ... }

            '2xl': '1536px',
            // => @media (min-width: 1536px) { ... }
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    '50': '#E6C6D3',
                    '100': '#E0B7C8',
                    '200': '#D39BB2',
                    '300': '#C77F9C',
                    '400': '#BB6286',
                    '500': '#AA4A71',
                    '600': '#833957',
                    '700': '#5C283D',
                    '800': '#351723',
                    '900': '#0E0609'
                },

                second: {  
                    DEFAULT: '#9F2A2A',  
                    '50': '#F8EBE4',  
                    '100': '#F2D7CC',  
                    '200': '#E5AC9C',  
                    '300': '#D87B6C',  
                    '400': '#CB463B',  
                    '500': '#9F2A2A',  
                    '600': '#83232A',  
                    '700': '#661B26',  
                    '800': '#4A1420',  
                    '900': '#2E0C16'
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};