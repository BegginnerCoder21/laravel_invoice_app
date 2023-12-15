import './bootstrap';
import { createApp } from 'vue'
import Exemple from './components/exemple.vue';
import Example from './components/example.vue';
import router from './router';

const app = createApp();

app.component('exemple', Exemple);
// app.component('example', Example);

app.use(router).mount('#app')
