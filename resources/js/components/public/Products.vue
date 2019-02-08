<template>
    <q-page class="card-examples row items-start">
        <q-card inline class="q-ma-sm" v-for="n in 10">
            <q-card-media>
                <img src="https://gss1.bdstatic.com/9vo3dSag_xI4khGkpoWK1HF6hhy/baike/c0%3Dbaike80%2C5%2C5%2C80%2C26/sign=e8f4de87612762d09433acedc185639f/95eef01f3a292df5a1e6cdb1be315c6034a87368.jpg">
            </q-card-media>
            <q-card-title>
                地板
                <span slot="subtitle">实木地板{{ n }}</span>
            </q-card-title>
            <q-card-main>
                <q-list>
                    <q-item>
                        <q-item-side>
                            <q-item-tile color="primary" icon="local bar" />
                        </q-item-side>
                        <q-item-main>
                            <q-item-tile label>价格</q-item-tile>
                            <q-item-tile sublabel>1000</q-item-tile>
                        </q-item-main>
                    </q-item>
                    <q-item>
                        <q-item-side>
                            <q-item-tile color="primary" icon="local bar" />
                        </q-item-side>
                        <q-item-main>
                            <q-item-tile label>介绍</q-item-tile>
                            <q-item-tile sublabel>实木地板是天然木材经烘干、加工后形成的地面装饰材料。又名原木地板，是用实木直接加工成的地板。它具有木材自然生长的纹理，是热的不良导体，能起到冬暖夏凉的作用</q-item-tile>
                        </q-item-main>
                    </q-item>
                    <q-item>
                        <q-item-side>
                            <q-item-tile color="primary" icon="local bar" />
                        </q-item-side>
                        <q-item-main>
                            <q-item-tile label>打折劵</q-item-tile>
                            <q-item-tile sublabel>满1000元9折劵X10 满5000元8折劵 满10000元7折劵</q-item-tile>
                        </q-item-main>
                    </q-item>
                </q-list>
            </q-card-main>
        </q-card>
    </q-page>
</template>

<script>
export default {
  name: 'products'
}
</script>

<style lang="stylus" scoped>
    .card-examples
        .q-card
            width 300px
        .bigger
            width 450px
            max-width 90vw
        @media (max-width $breakpoint-xs-max)
            .q-card
                width 100%
</style>
