import './bootstrap';
import TomSelect from 'tom-select';
import Litepicker from 'litepicker';
import * as tabler from '@tabler/core/dist/js/tabler.min.js';
window.tabler = tabler;

document.addEventListener("DOMContentLoaded", () => {
    // Inisialisasi TomSelect untuk elemen dengan kelas 'tom-select'
    if (document.querySelector('.tom-select')) {
        document.querySelectorAll('.tom-select').forEach((el) => {
            new TomSelect(el, {
                plugins: ['remove_button'],
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    }

    // Inisialisasi Litepicker untuk elemen dengan id 'content-editor'
    if (document.getElementById('content-editor')) {
        const editor = new Litepicker({
            element: document.getElementById('content-editor'),
            // Opsi tambahan bisa ditambahkan di sini
        });
    }
});