import Router from 'vue-router'
import SelectMemberRegister from './views/member/Select-Register.vue'
import Top from './views/Top.vue'
import MemberRegisterEmail from './views/member/Register-email.vue'
import MemberRegisterCompleted from './views/member/Register-complete.vue'
import SelectMemberLogin from './views/member/Select-Login.vue'
import MemberLoginEmail from './views/member/Login-email.vue'
import ShopIndex from './views/shop/index.vue'
import ShopDetail from './views/shop/detail.vue'

//エラー系
import SystemError from './views/errors/System.vue'

import store from './store'

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
      path: '/shops',
      name: 'shops',
      component: ShopIndex
    },
    {
      path: '/shop/:shopId/detail',
      name: 'shopDetail',
      component: ShopDetail
    },
    {
      path: '/member/login-email',
      name: 'member-login-email',
      component: MemberLoginEmail,
      beforeEnter(to, from, next){
        if(store.getters['auth/check']){
          next('/')
          //セッションで「ログイン済です。再ログインする場合は一度ログアウトして下さい」みたいなメッセージを出したい
        }else{
          next()
        }
      }
    },

    {
      path: '/500',
      component: SystemError,
    }
  ]
});