import Router from 'vue-router'
import Home from './Home.vue'
import Welcome from './views/Welcome.vue'
import MemberRegister from './views/MemberRegister.vue'

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
      {
        path: '/member-register',
        name: 'member-register',
        component: MemberRegister
      }
  ]
});