<template>
    <q-layout-footer>
        <q-toolbar color="secondary"
                   class="row items-start"
                   :glossy="$q.theme === 'mat'"
                   :inverted="$q.theme === 'ios'"
        >
            <q-btn flat
                   dense
                   class="col"
                   label="我的优惠劵"
                   icon="receipt"
                   >
            </q-btn>
            <q-btn flat
                   class="col animate-blink"
                   dense
                   to="/user/applyb"
                   label="商户入驻"
                   icon="input"
                   >
            </q-btn>
        </q-toolbar>
    </q-layout-footer>
</template>

<script>
export default {
  name: 'app-footer'
}
</script>

<style lang="stylus" scoped>
    a {
        text-decoration: none;
    }
    .animate-blink
        animation q-blink 2s steps(5, start) infinite
</style>
