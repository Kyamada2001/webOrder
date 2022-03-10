import Router from 'vue-router'
import MemberRegister from './views/member/Register.vue'
import Top from './views/Top.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'top',
      component: Top
    },
    {
      path: '/member/register',
      name: 'member-register',
      component: MemberRegister
    },
  ]
});