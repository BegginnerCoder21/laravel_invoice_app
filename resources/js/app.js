import './bootstrap';
import { createApp } from 'vue'
import app from './views/App.vue';
import router from './router/index.js';

createApp(app).use(router).mount('#app')
