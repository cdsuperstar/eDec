<template>
    <div>
        <q-layout view="lHh Lpr lFf">
            <q-layout-header reveal>
                <router-view name="top-menu"></router-view>
            </q-layout-header>
            <q-page-container>
                <router-view></router-view>
            </q-page-container>
            <router-view name="app-footer"></router-view>
        </q-layout>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "app",
    watch: {
        auth(value) {
            if (value) {
                this.getUserInfo();
            }
        }
    },
    created: function() {
        this.getMycompany();
        this.getMyproducts().then(
            r => {},
            e => {
                this.$master.self.$q.notify({
                    message: e,
                    type: "negative"
                });
            }
        );
        this.getPrcoupons().then(
            r => {},
            e => {
                this.$master.self.$q.notify({
                    message: "数据获取失败",
                    type: "negative"
                });
            }
        );
    },
    computed: {
        ...mapState("auth", ["auth"])
        // ...mapState("bus", ["company"])
    },
    methods: {
        ...mapActions("auth", ["getUserInfo"]),
        ...mapActions("bus", ["getMycompany", "getMyproducts", "getPrcoupons"])
    }
};
</script>

<style scoped></style>
