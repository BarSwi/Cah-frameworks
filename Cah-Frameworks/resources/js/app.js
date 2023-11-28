import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler.js'
import {createPinia} from 'pinia'
//import {userSettings} from '../storage/userSettings.js'
import App from '../views/App.vue'
import router from './router.js'



const app = createApp(App)
app.use(router)
app.use(createPinia())
app.mount('#app')


