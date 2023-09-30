import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler.js'
import App from '../views/App.vue'
import router from './router.js'

const app = createApp(App)
app.use(router)
app.mount('#app')
