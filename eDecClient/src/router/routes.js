import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import { AuthManager } from './auth-manager'
import * as All from './external-import/external-files'

const routes = [
  // {
  //   path: '/',
  //   component: () => import('layouts/MyLayout.vue'),
  //   children: [
  //     { path: '', component: () => import('pages/Index.vue') }
  //   ]
  // }
  {
    path: '/',
    components: {
      default: All.PublicLayout,
      'top-menu': All.WelcomeToolbar,
      'app-footer': All.AppFooter
    },
    children: [
      {
        path: '/',
        name: 'public.index',
        component: All.Welcome
      }
    ],
    beforeEnter (to, from, next) {
      AuthManager.optionalAuth(to, from, next)
    }
  },
  {
    path: '/user',
    components: {
      default: All.UserLayout,
      'top-menu': All.UserToolbar,
      'app-footer': All.AppFooter
    },
    children: [
      {
        path: '/',
        name: 'user.index',
        component: All.User
      }
    ],
    beforeEnter (to, from, next) {
      AuthManager.forceAuth(to, from, next)
    }
  },
  {
    path: '/e404',
    components: {
      default: All.ErrorLayout,
      'top-menu': All.ErrorToolbar,
      'app-footer': All.AppFooter
    },
    children: [
      {
        path: '/',
        name: 'e404',
        component: All.NotFound
      }
    ],
    beforeEnter (to, from, next) {
      // AuthManager.optionalAuth(to, from, next)
    }
  },
  {
    path: '*',
    redirect: {
      name: 'e404'
    }
  }
]

const router = new VueRouter({
  scrollBehavior: () => ({ y: 0 }),
  routes,
  linkActiveClass: 'active',
  // Leave these as is and change from quasar.conf.js instead!
  // quasar.conf.js -> build -> vueRouterMode
  // quasar.conf.js -> build -> publicPath
  mode: process.env.VUE_ROUTER_MODE,
  base: process.env.VUE_ROUTER_BASE
})

router.beforeEach((to, from, next) => {
  if (typeof router.app.$root.$master.self === 'undefined') {
    router.app.$root.$master.self = router.app.$root
    router.app.$root.$master._setAxiosDefault()
  }
  next()
})

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default router
