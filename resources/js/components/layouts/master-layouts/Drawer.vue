<template>
    <div>
        <q-btn
            flat dense round
            @click="leftDrawerOpen = !leftDrawerOpen"
            aria-label="Menu"
        >
            <q-icon name="menu"/>
        </q-btn>
        <q-layout-drawer
            side="left"
            v-model="leftDrawerOpen"
            :content-class="$q.theme === 'mat' ? 'bg-grey-2' : null"
        >
            <q-list
                no-border
                link
                inset-delimiter
            >
                <q-list-header>功能导航</q-list-header>
                <q-item to="/user/myaccount">
                    <q-item-side icon="people"/>
                    <q-item-main style="color:black" label="帐户" sublabel="管理我的平台帐户信息"/>
                </q-item>
                <q-item to="/user/myvendor">
                    <q-item-side icon="shopping_cart"/>
                    <q-item-main style="color:black" label="供应商" sublabel="管理我的平台供应商"/>
                </q-item>
                <q-item to="/user/mycompany">
                    <q-item-side icon="home"/>
                    <q-item-main style="color:black" label="装修公司" sublabel="管理我的平台装修公司"/>
                </q-item>
            </q-list>
        </q-layout-drawer>
    </div>
</template>

<script>
import { openURL } from 'quasar-framework/dist/quasar.mat.esm'

export default {
  name: 'drawer',
  methods: {
    openURL
  },
  data () {
    return {
      leftDrawerOpen: this.$q.platform.is.desktop
    }
  }
}
</script>

<style>
</style>
