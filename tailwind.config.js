const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            animation: {
                'fade-in': 'fade-in ease-out',
                'scroll-down': 'scroll-down ease-out',
                'scroll-right': 'scroll-right ease-out',
            },

            keyframes: {
                'fade-in': {
                    '0%': {
                        'transform': 'scale(0)',
                        'opacity': '0'
                    },
                    '100%': {
                        'transform': 'scale(1)',
                        'opacity': '100'
                    }
                },
                'scroll-down': {
                    '0%': {
                        'transform': 'translateY(-50%) scaleY(0)',
                    },
                    '100%': {
                        'transform': 'translateY(0%) scaleY(1)',
                    }
                },
                'scroll-right': {
                    '0%': {
                        'transform': 'translateX(-50%) scaleX(0)',
                    },
                    '100%': {
                        'transform': 'translateX(0%) scaleX(1)',
                    }
                }
            },
        },
    },

    variants: {
        animationDelay: ['responsive'],
        animationDuration: ['responsive'],
        animationIteration: ['responsive'],
        animationTiming: ['responsive'],
        animationDirection: ['responsive'],
        animationFillMode: ['responsive'],
        animationPlayState: ['responsive'],
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwindcss-animation'),
    ],
};
