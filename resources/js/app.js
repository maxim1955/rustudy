/*import './bootstrap';*/
import {createApp, } from 'vue';
import {Vuelidate} from "vuelidate";
import App from './App.vue'
import router from './router'
import {createPinia} from "pinia";
import { createHead } from 'unhead'

const pinia = createPinia()
const head = createHead()
const app = createApp(App);
app
    .use(Vuelidate)
    .use(router)
    .use(pinia)
    .use(head)
    .mount('#app');
