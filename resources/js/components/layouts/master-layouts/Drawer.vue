<template>
  <div>
    <q-btn
      flat dense round
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
      <q-list
        no-border
        link
        inset-delimiter
      >
        <q-list-header>{{$t('drawer.title')}}</q-list-header>
        <q-item @click.native="openURL('http://quasar-framework.org')">
          <q-item-side icon="school" />
          <q-item-main style="color:black" label="商户" sublabel="管理商户" />
        </q-item>
        <q-item @click.native="openURL('https://github.com/quasarframework/')">
          <q-item-side icon="code" />
          <q-item-main style="color:black" label="供应商" sublabel="管理供应商" />
        </q-item>
      </q-list>
    </q-layout-drawer>
  </div>
</template>

<script>
import { openURL } from 'quasar-framework/dist/quasar.mat.esm'
export default {
  name: 'Drawer',
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
