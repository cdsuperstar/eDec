<template>
    <div>
        <q-toolbar
            color="primary"
            class="row items-start"
            :glossy="$q.theme === 'mat'"
            :inverted="$q.theme === 'ios'"
        >
            <q-toolbar-title>
                <!--<span>欢迎！</span>-->
            </q-toolbar-title>
            <!--<lang-manager></lang-manager>-->
            <q-btn
                flat
                dense
                label="主材"
                class="col"
                icon="shopping_cart"
                to="/products"
            >
            </q-btn>
            <q-btn
                flat
                dense
                class="col"
                label="装修"
                icon="card_giftcard"
                to="/packages"
            >
            </q-btn>
            <q-btn
                v-if="!isAuth"
                flat
                class="col"
                icon="vpn_key"
                dense
                :label="$t('login.title')"
                @click="showLogin(true)"
            >
            </q-btn>
            <q-btn
                v-else
                flat
                dense
                class="col"
                icon="extension"
                label="设置"
                @click="$router.replace({ name: 'user.index' })"
            >
            </q-btn>
            <q-btn
                v-if="!isAuth"
                flat
                dense
                icon="assignment_ind"
                class="col"
                :label="$t('register.title')"
                @click="showRegister(true)"
            >
            </q-btn>
            <q-btn
                v-else
                flat
                icon="exit_to_app"
                class="col"
                dense
                :label="$t('login.logout')"
                @click="logout()"
            >
            </q-btn>
        </q-toolbar>

        <login></login>
        <register></register>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Login from "../../auth/Login";
import Register from "../../auth/Register";
// import LangManager from '../LangManager'

export default {
    name: "welcome-toolbar",
    components: {
        // LangManager,
        Login,
        Register
    },
    computed: {
        ...mapGetters("auth", ["isAuth", "userInfo"])
    },
    methods: {
        ...mapActions("auth", ["showRegister", "showLogin", "logout"])
    }
};
</script>
