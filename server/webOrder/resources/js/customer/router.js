import Router from 'vue-router'
import MemberRegister from './views/member/Register.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/member/register',
      name: 'member-register',
      component: MemberRegister
    }
  ]
});