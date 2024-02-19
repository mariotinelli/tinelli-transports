import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';


window.Alpine = Alpine;

Alpine.plugin(persist)
//
// Alpine.store('darkMode', {
//     on: Alpine.$persist(true).as('darkMode_on'),
//
//     init() {
//         if (this.on) {
//             document.documentElement.classList.add('dark')
//         } else {
//             document.documentElement.classList.remove('dark')
//         }
//     },
//
//     toggle() {
//         this.on = !this.on
//     }
// })

Alpine.start();
