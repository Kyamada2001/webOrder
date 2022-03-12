import Router from 'vue-router'
import SelectMemberRegister from './views/member/Select-Register.vue'
import Top from './views/Top.vue'
import MemberRegister from './views/member/Register.vue'

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'top',
      component: Top
    },
    {
      path: '/member/select-register',
      name: 'member-select-register',
      component: SelectMemberRegister
    },
    {
      path: '/member/register',
      name: 'member-register',
      component: MemberRegister
    },
  ]
});