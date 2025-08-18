import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            // Tambahkan file SCSS dan JS utama Anda di sini
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
