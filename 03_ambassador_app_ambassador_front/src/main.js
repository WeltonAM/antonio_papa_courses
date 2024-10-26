import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api/ambassador/';
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

createApp(App)
.use(store)
.use(router)
.mount('#app')
