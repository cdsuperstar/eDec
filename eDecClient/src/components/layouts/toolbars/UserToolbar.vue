<template>
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
            <q-btn flat
                   dense
                   label="Go to Welcome"
                   @click="$router.replace({name: 'public.index'})">
            </q-btn>
            <q-btn v-if="!isAuth"
                   flat
                   dense
                   label="Log in"
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
                   label="Sign out"
                   @click="logout()">
            </q-btn>

        <login></login>
        <register></register>
      </q-toolbar>
</template>

<script>
import Login from '../../auth/Login'
import Register from '../../auth/Register'
import { mapActions, mapGetters } from 'vuex'
import LangManager from '../LangManager'
export default {
  name: 'user-toolbar',
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
<style scoped>
</style>
