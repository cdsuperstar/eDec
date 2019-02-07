<template>
    <div>
        <q-toolbar         color="primary"
                           :glossy="$q.theme === 'mat'"
                           :inverted="$q.theme === 'ios'"
>
            <q-toolbar-title>
                <span>欢迎！</span>
            </q-toolbar-title>
            <lang-manager></lang-manager>
            <q-btn flat
                   dense
                   label="测试404"
                   @click="$router.replace({name: 'e404'})">
            </q-btn>
            <q-btn v-if="!isAuth"
                   flat
                   dense
                   :label="$t('login.title')"
                   @click="showLogin(true)">
            </q-btn>
            <q-btn v-else
                   flat
                   dense
                   :label="userInfo.username"
                   @click="$router.replace({name: 'user.index'})">
            </q-btn>
            <q-btn v-if="!isAuth"
                   flat
                   dense
                   :label="$t('register.title')"
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
export default {
  name: 'welcome-toolbar',
  components: {
    LangManager,
    Login,
    Register
  },
  computed: {
    ...mapGetters('auth', ['isAuth', 'userInfo'])
  },
  methods: {
    ...mapActions('auth', ['showRegister', 'showLogin', 'logout'])
  }
}
</script>
