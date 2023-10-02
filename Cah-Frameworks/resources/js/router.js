import Home from '../views/Home.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL), 
    routes:[
        {
            path: '/', 
            component: Home,
            name: 'Home',
            meta:
            {
                title: "Cards Against Hummanity",
            }
        }
    ]
})

router.beforeEach((to, from, next) =>{
    document.title = `${to.meta.title}`; 
    next();
  })
export default router