<template>
    <div>
        <q-btn
            flat
            dense
            round
            @click="leftDrawerOpen = !leftDrawerOpen"
            aria-label="Menu"
        >
            <q-icon name="menu" />
        </q-btn>
        <q-layout-drawer
            side="left"
            v-model="leftDrawerOpen"
            :content-class="$q.theme === 'mat' ? 'bg-grey-2' : null"
        >
            <q-list no-border link inset-delimiter>
                <q-list-header>功能导航</q-list-header>
                <q-item to="/user/myaccount">
                    <q-item-side icon="people" />
                    <q-item-main
                        style="color:black"
                        label="我的帐户"
                        sublabel="管理我的平台帐户信息"
                    />
                </q-item>
                <q-item to="/user/mycompany">
                    <q-item-side icon="home" />
                    <q-item-main
                        style="color:black"
                        label="我的公司（商铺）"
                        sublabel="管理我的公司（商铺）信息"
                    />
                </q-item>
                <q-item to="/user/myvendor" v-show="company.id ? true : false">
                    <q-item-side icon="shopping_cart" />
                    <q-item-main
                        style="color:black"
                        label="我的商品服务"
                        sublabel="管理我的商品服务信息"
                    />
                </q-item>
                <q-item to="/user/coupons" v-show="company.id ? true : false">
                    <q-item-side icon="receipt" />
                    <q-item-main
                        style="color:black"
                        label="打折劵管理"
                        sublabel="管理我的打折劵信息"
                    />
                </q-item>
            </q-list>
        </q-layout-drawer>
    </div>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "drawer",
    watch: {},
    computed: {
        ...mapState("bus", ["company"])
    },
    methods: {
        // ...mapActions("bus", ["getMycompany"])
    },
    data() {
        return {
            leftDrawerOpen: this.$q.platform.is.desktop
        };
    }
};
</script>

<style></style>
