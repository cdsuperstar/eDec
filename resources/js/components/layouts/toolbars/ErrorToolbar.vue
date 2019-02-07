<template>
    <div>
        <q-toolbar color="blue-grey-14">
            <q-toolbar-title>
                <span>错误404</span>
            </q-toolbar-title>
            <lang-manager></lang-manager>
            <q-btn flat dense label="转去欢迎页" @click="redirect"></q-btn>
        </q-toolbar>
    </div>
</template>

<script>
import LangManager from '../LangManager'
export default {
  name: 'error-toolbar',
  components: { LangManager },
  methods: {
    redirect () {
      this.$router.replace({
        name: 'public.index'
      })
    }
  }
}
</script>

<style scoped>

</style>
