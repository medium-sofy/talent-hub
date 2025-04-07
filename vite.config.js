import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
<<<<<<< HEAD
=======
import tailwindcss from '@tailwindcss/vite'
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
<<<<<<< HEAD
        }),
=======
        })
>>>>>>> c4b440931959f3fe81af478374ac416720e5628f
    ],
});
