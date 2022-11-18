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
                    DEFAULT: '#166064',  
                    '50': '#57D3DA',  
                    '100': '#47CFD6',  
                    '200': '#2CC0C8',  
                    '300': '#25A0A7',  
                    '400': '#1D8085',  
                    '500': '#166064',  
                    '600': '#0C3436',  
                    '700': '#020808',  
                    '800': '#000000',  
                    '900': '#000000'
                },
                second: {  
                    DEFAULT: '#166064',  
                    '50': '#57D3DA',  
                    '100': '#47CFD6',  
                    '200': '#2CC0C8',  
                    '300': '#25A0A7',  
                    '400': '#1D8085',  
                    '500': '#166064',  
                    '600': '#0C3436',  
                    '700': '#020808',  
                    '800': '#000000',  
                    '900': '#000000'
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};