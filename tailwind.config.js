import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                bg: 'var(--color-bg)',
                surface: 'var(--color-surface)',
                'surface-2': 'var(--color-surface-2)',
                ink: 'var(--color-ink)',
                muted: 'var(--color-muted)',
                line: 'var(--color-line)',
                live: 'var(--color-live)',
            },
            fontFamily: {
                sans: ['Geist', 'Hanken Grotesk', ...defaultTheme.fontFamily.sans],
            },
            borderRadius: {
                card: 'var(--radius-card)',
                pill: 'var(--radius-pill)',
            },
        },
    },

    plugins: [forms],
};
