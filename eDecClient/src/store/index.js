import Vue from 'vue'
import Vuex from 'vuex'

import lang from './lang'
import auth from './auth'
Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      lang,
      auth
    }
  })

  return Store
}
