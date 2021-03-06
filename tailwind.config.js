const colors = require('tailwindcss/colors');

module.exports = {
    purge: {
        preserveHtmlElements: true,
        content: [
            './resources/**/*.vue',
            './resources/**/*.blade.php'
        ],
        options: {
            safelist: [
                /^w-[0-9]+\/[0-9]+/,     // All variations of width classes we dynamically use in the view-builder
                /^w-[0-9]+/,             // Different sizes used for icons
                /^h-[0-9]+/,             // ^
                /^border-[a-z]+-500/,
                /^bg-[a-z]+-400/,
                /^bg-[a-z]+-500/,
                /^bg-[a-z]+-600/,
                /^bg-[a-z]+-700/,
                /^text-[a-z]+-500/,
                /^text-[a-z]+-600/,
                /^grid-cols-[0-9]+/,     // Used for dashboard-widgets
                /^fill-current/,
            ]
        }
    },
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                gray: {
                    50:  '#FBFDFE',
                    100: '#F1F5F9',
                    150: '#EAEFF5',
                    200: '#E2E8F0',
                    250: '#D9E0EA',
                    300: '#CFD8E3',
                    350: '#B3BFCF',
                    400: '#97A6BA',
                    450: '#7E8DA3',
                    500: '#64748B',
                    550: '#56657A',
                    600: '#475569',
                    650: '#3F4B5E',
                    700: '#364152',
                    750: '#2F3949',
                    800: '#27303F',
                    850: '#212837',
                    900: '#1A202E',
                    950: '#0D1017',
                },
                orange: colors.orange,
                teal: colors.teal,
            },
            spacing: {
                '0.5': '0.125rem',
                '1.5': '0.375rem',
                '2.5': '0.625rem',
                '3.5': '0.875rem',
                '72': '18rem',
                '80': '20rem',
            },
            maxHeight: {
                '3/4': '75%',
                'full': '100%',
                '128': '16rem',
                '256': '24rem',
            },
            minHeight: {
                '64': '8rem',
            },
            animation: {
                'spin-reverse': 'spin-reverse 1s linear infinite',
                'spin-slow': 'spin 2s linear infinite',
                'scale-x': 'scale-x linear 1s forwards',
            },
            keyframes: {
                'spin-reverse': {
                    'from': { transform: 'rotate(360deg)' },
                    'to': { transform: 'rotate(0deg)' },
                },
                'scale-x': {
                    '0%': { transform: 'scaleX(1)' },
                    '100%': { transform: 'scaleX(0)' },
                }
            },
            transitionDuration: {
                '50': '50ms',
            },
            width: {
                '72': '18rem',
                '80': '20rem',
                '88': '22rem',
                '96': '24rem',
            }
        },
    },
    variants: {
        float: ['responsive', 'direction'],
        margin: ['responsive', 'direction', 'first', 'last'],
        padding: ['responsive', 'direction'],
        textAlign: ['responsive', 'direction']
    },
    plugins: [
        require('tailwindcss-dir')(),
    ],
}