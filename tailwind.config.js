import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
<<<<<<< HEAD
=======
import tailwindcss from '@tailwindcss/vite'
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

<<<<<<< HEAD
    plugins: [forms],
=======
    plugins: [
        forms,
    ]

>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
};
