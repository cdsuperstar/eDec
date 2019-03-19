<template>
    <div>
        <q-toolbar
            color="primary"
            :glossy="$q.theme === 'mat'"
            :inverted="$q.theme === 'ios'"
        >
            <drawer></drawer>
            <q-toolbar-title>
                <span>功能导航</span>
            </q-toolbar-title>
            <!--<lang-manager></lang-manager>-->
            <q-btn
                flat
                dense
                icon="home"
                label="主界面"
                @click="$router.replace({ name: 'public.index' })"
            >
            </q-btn>
            <!--<q-btn-->
            <!--v-if="!isAuth"-->
            <!--flat-->
            <!--dense-->
            <!--:label="$t('login.login')"-->
            <!--@click="showLogin(true)"-->
            <!--&gt;-->
            <!--</q-btn>-->
            <!--<q-btn v-else-->
            <!--flat dense-->
            <!--label="菜单">-->
            <!--:label="userInfo.username">-->
            <!--</q-btn>-->
            <!--<q-btn-->
            <!--v-if="!isAuth"-->
            <!--flat-->
            <!--dense-->
            <!--label="登录"-->
            <!--@click="showRegister(true)"-->
            <!--&gt;-->
            <!--</q-btn>-->
            <!--<q-btn-->
            <!--v-else-->
            <!--flat-->
            <!--dense-->
            <!--icon="exit_to_app"-->
            <!--:label="$t('login.logout')"-->
            <!--@click="slogout()"-->
            <!--&gt;-->
            <!--</q-btn>-->
        </q-toolbar>

        <!--<login></login>-->
        <!--<register></register>-->
    </div>
</template>

<script>
// import Login from "../../auth/Login";
// import Register from "../../auth/Register";
import { mapActions, mapGetters } from "vuex";
// import LangManager from '../LangManager'
import Drawer from "../../layouts/master-layouts/Drawer";

export default {
    name: "user-toolbar",
    components: {
        // LangManager,
        // Login,
        // Register,
        Drawer
    },
    computed: {
        ...mapGetters("auth", ["isAuth", "userInfo"])
    },
    methods: {
        ...mapActions("auth", ["showRegister", "showLogin", "logout"]),
        slogout: function() {
            this.logout();
            // this.$store.replaceState({});
            // window.location.href = "/";
        }
    }
};
</script>
