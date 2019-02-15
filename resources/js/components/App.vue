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
    computed: {
        ...mapState("auth", ["auth"])
    },
    methods: {
        ...mapActions("auth", ["getUserInfo"])
    }
};
</script>

<style scoped></style>
