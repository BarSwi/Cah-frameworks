import Home from '../views/Home.vue'
import { createRouter, createWebHistory } from 'vue-router'
const routes = [
    {
        path: '/', 
        component: Home,
        name: 'Home'
    }
]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL), 
    routes:[

    ]
})

router.beforeEach((to, from, next) =>{
    document.title = `${to.meta.title}`; 
    next();
  })
export default router