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
                label="主材商"
                class="col"
                icon="shopping_cart"
                to="/products"
            >
            </q-btn>
            <q-btn
                flat
                dense
                class="col"
                label="装修公司"
                icon="store"
                to="/packages"
            >
            </q-btn>
            <q-btn
                flat
                dense
                class="col"
                label="装修工"
                icon="how_to_reg"
                to="/packages"
            >
            </q-btn>
            <!--
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
            -->
        </q-toolbar>
    </div>
</template>

<script>
// import LangManager from '../LangManager'
export default {
    name: "welcome-toolbar"
};
</script>
