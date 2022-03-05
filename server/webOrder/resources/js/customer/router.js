import Router from 'vue-router'
import Home from './views/Home.vue'
import Welcome from './views/Welcome.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/home',
      name: 'home',
      component: Home
    },
    {
        path: '/welcome',
        name: 'welcome',
        component: Welcome
      },
  ]
});