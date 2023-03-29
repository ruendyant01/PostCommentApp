import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import {createPinia} from 'pinia';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import './assets/main.css'

const app = createApp(App)

app.use(router)
const pinia = createPinia()

app.use(VueSweetalert2);

app.use(pinia);
app.mount('#app')
