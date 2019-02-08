<template>
    <q-layout-footer>
        <q-toolbar color="secondary"
                   class="row items-start"
                   :glossy="$q.theme === 'mat'"
                   :inverted="$q.theme === 'ios'"
        >
            <q-btn flat
                   dense
                   class="col animate-blink"
                   label="我的优惠劵"
                   icon="receipt"
                   @click="$router.push('/products')">
            </q-btn>
            <q-btn flat
                   class="col"
                   dense
                   label="商户入驻"
                   icon="input"
                   @click="$router.push('/packages')">
            </q-btn>
        </q-toolbar>
    </q-layout-footer>
</template>

<script>
export default {
  name: 'app-footer'
}
</script>

<style scoped>
    a {
        text-decoration: none;
    }
</style>
