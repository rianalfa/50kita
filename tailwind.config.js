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

    safelist: [
        'bg-gray-300',
        'bg-gray-800',
        'bg-red-400',
        'bg-red-900',
        'bg-orange-500',
        'bg-yellow-400',
        'bg-lime-500',
        'bg-emerald-400',
        'bg-teal-400',
        'bg-cyan-400',
        'bg-sky-300',
        'bg-sky-600',
        'bg-blue-500',
        'bg-blue-700',
        'bg-indigo-500',
        'bg-violet-500',
        'bg-fuchsia-600',
        'bg-pink-400',
        'bg-rose-500',
        'text-gray-300',
        'text-gray-800',
        'text-red-400',
        'text-red-900',
        'text-orange-500',
        'text-yellow-400',
        'text-lime-500',
        'text-emerald-400',
        'text-teal-400',
        'text-cyan-400',
        'text-sky-300',
        'text-sky-600',
        'text-blue-500',
        'text-blue-700',
        'text-indigo-500',
        'text-violet-500',
        'text-fuchsia-600',
        'text-pink-400',
        'text-rose-500',
    ],
};
