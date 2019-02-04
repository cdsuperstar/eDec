<template>
  <div>
  <q-toolbar
    color="primary"
    :glossy="$q.theme === 'mat'"
    :inverted="$q.theme === 'ios'"
  >
    <drawer></drawer>
    <q-toolbar-title>
      {{ $t('toolbar.name') }}
    </q-toolbar-title>
    <lang-manager></lang-manager>
            <!--<q-btn flat-->
                   <!--dense-->
                   <!--label="See 404"-->
                   <!--@click="$router.replace({name: 'e404'})">-->
            <!--</q-btn>-->
            <q-btn v-if="!isAuth"
                   flat
                   dense
                   :label="$t('toolbar.login')"
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
                   :label="$t('toolbar.register')"
                   @click="showRegister(true)">
            </q-btn>
            <q-btn v-else
                   flat
                   dense
                   label="Sign out"
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
import Drawer from '../../common/Drawer'
export default {
  name: 'welcome-toolbar',
  components: {
    Drawer,
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

<style scoped>

</style>
