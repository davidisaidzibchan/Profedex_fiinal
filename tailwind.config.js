import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'rosa': '#ff0074',
                'ambar': '#ffaa00',
                'verdoso': '#4c9dae',
                'cielo': '#6cb9ff',
                'amarillo': '#ffce6c',
                'morado': '#dd94ff',
                'verde': '#8df6aa',
                'amarillo-brillante': '#fff100',
                'azul-brillante': '#00ffe9',
                'verde-brillante': '#16ffa8',
                'morado-bajo': '#a680a3',
                'azul-bajo': '#3374b0',
                'gris': '#686868',
                'dorado-bajo': '#958345',
              },
        },
    },

    plugins: [forms, typography],
};
