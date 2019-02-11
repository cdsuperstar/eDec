<template>
    <q-page class="card-examples row items-start">
        <div v-for="(item,index) in 31" v-bind:key="index">
            <q-card inline class="q-ma-sm" >
                <q-card-media>
                    <img src="https://gss3.bdstatic.com/7Po3dSag_xI4khGkpoWK1HF6hhy/baike/c0%3Dbaike92%2C5%2C5%2C92%2C30/sign=6d5b9a3f728b4710da22f59ea2a7a898/622762d0f703918f77165fd4513d269758eec4ed.jpg">
                </q-card-media>
                <q-card-title>
                    装修套餐
                    <span slot="subtitle">装修套餐{{ item }}</span>
                </q-card-title>
                <q-card-main>
                    <q-list>
                        <q-item>
                            <q-item-side>
                                <q-item-tile color="primary" icon="local bar" />
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label>价格</q-item-tile>
                                <q-item-tile sublabel>28800</q-item-tile>
                            </q-item-main>
                        </q-item>
                        <q-item>
                            <q-item-side>
                                <q-item-tile color="primary" icon="local bar" />
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label>介绍</q-item-tile>
                                <q-item-tile sublabel>
                                    第一代家装套餐，“28800，精装搬回家”
                                    2005年2月14日，三优实创装饰率先推出“￥28800，精装搬回家”活动。套餐装修首次进入北京家装市场2005年以后的装修行业进入残酷竞争时代，提出装饰化装修和工厂化装修；
                                    2006年，国家规定菜单式装修，目的是明码标价，满足不同客户的需求；
                                    2006-2007年，装饰企业竞相模仿，套餐装修遍地开花。北京市场出现了许多不同规格的企业纷纷效仿“套餐装修模式”。之后，套餐装修进入残酷的竞争阶段。
                                </q-item-tile>
                            </q-item-main>
                        </q-item>
                        <q-item>
                            <q-item-side>
                                <q-item-tile color="primary" icon="local bar" />
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label>打折劵</q-item-tile>
                                <q-item-tile sublabel>9折劵 8折劵</q-item-tile>
                            </q-item-main>
                        </q-item>
                    </q-list>
                </q-card-main>
            </q-card>
        </div>
    </q-page>
</template>

<script>
export default {
  name: 'packages'
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
