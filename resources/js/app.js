import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router from './router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
//Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import '@mdi/font/css/materialdesignicons.css'
const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App).use(vuetify);
const pinia = createPinia();

app.use(router);
app.use(pinia);
app.use(VueAxios, axios);
app.mount('#app');
