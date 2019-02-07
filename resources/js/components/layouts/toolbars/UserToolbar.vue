<template>
    <div>
        <q-toolbar c        color="primary"
                            :glossy="$q.theme === 'mat'"
                            :inverted="$q.theme === 'ios'"
>
            <drawer></drawer>
            <q-toolbar-title>
                <span>功能导航</span>
            </q-toolbar-title>
            <lang-manager></lang-manager>
            <q-btn flat
                   dense
                   label="转去欢迎"
                   @click="$router.replace({name: 'public.index'})">
            </q-btn>
            <q-btn v-if="!isAuth"
                   flat
                   dense
                   :label="$t('login.login')"
                   @click="showLogin(true)">
            </q-btn>
            <q-btn v-else
                   flat dense
                   :label="userInfo.username">
            </q-btn>
            <q-btn v-if="!isAuth"
                   flat
                   dense
                   label="Sign in"
                   @click="showRegister(true)">
            </q-btn>
            <q-btn v-else
                   flat
                   dense
                   :label="$t('login.logout')"
                   @click="logout()">
            </q-btn>
        </q-toolbar>

        <login></login>
        <register></register>
    </div>
</template>

<script>
import Login from '../../auth/Login'
import Register from '../../auth/Register'
import { mapActions, mapGetters } from 'vuex'
import LangManager from '../LangManager'
import Drawer from '../../layouts/master-layouts/Drawer'

export default {
  name: 'user-toolbar',
  components: {
    LangManager,
    Login,
    Register,
    Drawer
  },
  computed: {
    ...mapGetters('auth', ['isAuth', 'userInfo'])
  },
  methods: {
    ...mapActions('auth', ['showRegister', 'showLogin', 'logout'])
  }
}
</script>
