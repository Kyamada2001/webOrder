import Router from 'vue-router'
import SelectMemberRegister from './views/member/Select-Register.vue'
import Top from './views/Top.vue'
import MemberRegisterEmail from './views/member/Register-email.vue'
import MemberRegisterCompleted from './views/member/Register-complete.vue'

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
      path: '/member/register-email',
      name: 'member-register-email',
      component: MemberRegisterEmail
    },
    {
      path: '/member/register-complete',
      name: 'member-register-complete',
      component: MemberRegisterCompleted
    },
  ]
});