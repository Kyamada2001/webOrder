import Router from 'vue-router'
import SelectMemberRegister from './views/member/Select-Register.vue'
import Top from './views/Top.vue'
import MemberRegisterEmail from './views/member/Register-email.vue'
import MemberRegisterCompleted from './views/member/Register-complete.vue'
import SelectMemberLogin from './views/member/Select-Login.vue'
import MemberLoginEmail from './views/member/Login-email.vue'

//エラー系
import SystemError from './views/errors/System.vue'

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
    {
      path: '/member/select-login',
      name: 'member-select-login',
      component: SelectMemberLogin
    },
    {
      path: '/member/login-email',
      name: 'member-login-email',
      component: MemberLoginEmail
    },

    {
      path: '/500',
      component: SystemError,
    }
  ]
});