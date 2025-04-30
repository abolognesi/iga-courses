import { createApp } from 'vue';
import App from './App.vue'
import router from './router'

// Crea la instancia de la aplicación Vue
const app = createApp(App);

// Usa el enrutador
app.use(router);

// Monta la aplicación en el elemento #app del DOM
app.mount('#app');
