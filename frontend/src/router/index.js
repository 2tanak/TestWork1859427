import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Articles from '../views/Articles.vue'
import Update from '../views/Update.vue'
import Create from '../views/Create.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'articles',
    component: Articles
  },
  {
    path: '/articles',
    name: 'articles',
    component: Articles
  },
  {
    path: '/update/:id',
	props: true,
    name: 'update',
    component: Update
  },
  {
    path: '/create',
    name: 'create',
    component: Create
  },
  
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
