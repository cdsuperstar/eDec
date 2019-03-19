<template>
    <q-layout-footer reveal>
        <q-toolbar
            color="primary"
            class="row items-start"
            :glossy="$q.theme === 'mat'"
            :inverted="$q.theme === 'ios'"
        >
            <q-btn
                flat
                dense
                class="col"
                to="/user/mycoupons"
                label="我的优惠劵"
                icon="receipt"
            >
            </q-btn>
            <q-btn
                flat
                class="col"
                dense
                to="/user/applyb"
                label="商户入驻"
                icon="input"
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
    </q-layout-footer>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Login from "../../auth/Login";
import Register from "../../auth/Register";


export default {
    name: "app-footer",
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

<style lang="stylus" scoped>
a {
    text-decoration: none;
}
.animate-blink
    animation q-blink 2s steps(5, start) infinite
</style>
