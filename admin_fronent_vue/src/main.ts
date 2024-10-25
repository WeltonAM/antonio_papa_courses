import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store'; 
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader';
import axios from 'axios';

axios.defaults.baseURL = import.meta.env.VITE_API_URL;
axios.defaults.withCredentials = true;

axios.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token'); 
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

loadFonts();

const app = createApp(App);
app.use(router);
app.use(store);
app.use(vuetify);
app.mount('#app');
