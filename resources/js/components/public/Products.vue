<template>
    <q-page class="card-examples row items-start justify-center">
        <div class="doc-container ">
            <div class="col row">
                <q-search
                    style="width: 250px; max-width: 80vw;"
                    color="amber"
                    v-model="filter"
                    clearable
                    no-icon
                    float-label="查找您感兴趣的商品。"
                />
                <q-btn flat icon="search" label="查找" @click="initData" />
            </div>
            <div>共有 {{ this.cnt }} 项供您选择。</div>

            <div class="row items-start justify-center" inline>
                <div v-for="prod in tableData" :key="prod.id">
                    <q-card class="q-ma-sm">
                        <q-card-media>
                            <q-carousel color="white" arrows height="120px">
                                <q-carousel-slide
                                    v-for="item in prod.media"
                                    :key="item.id"
                                    :img-src="
                                        '/img/media/' +
                                            item.id +
                                            '/' +
                                            item.file_name
                                    "
                                ></q-carousel-slide>
                            </q-carousel>
                        </q-card-media>
                        <q-card-title>
                            {{ prod.name }}
                            <span slot="subtitle">
                                公司：{{ prod.company.name }}
                                <a :href="'tel:' + prod.company.tel">
                                    <q-icon
                                        name="local_phone"
                                        class="fa-sm"
                                    />{{ prod.company.tel }}
                                </a>
                            </span>
                        </q-card-title>
                        <q-card-main>
                            <q-list>
                                <q-item>
                                    <q-item-side>
                                        <q-item-tile
                                            color="primary"
                                            icon="euro_symbol"
                                        />
                                    </q-item-side>
                                    <q-item-main>
                                        <q-item-tile label>价格</q-item-tile>
                                        <q-item-tile sublabel>
                                            {{ prod.price }}
                                        </q-item-tile>
                                    </q-item-main>
                                </q-item>
                                <q-item>
                                    <q-item-side>
                                        <q-item-tile
                                            color="black"
                                            icon="event_note"
                                        />
                                    </q-item-side>
                                    <q-item-main>
                                        <q-item-tile label>介绍</q-item-tile>
                                        <q-item-tile sublabel>
                                            {{ prod.memo }}
                                        </q-item-tile>
                                    </q-item-main>
                                </q-item>
                                <q-item>
                                    <q-item-side>
                                        <q-item-tile
                                            color="secondary"
                                            icon="card_giftcard"
                                        />
                                    </q-item-side>
                                    <q-item-main>
                                        <q-item-tile label>打折劵</q-item-tile>
                                        <q-item-tile sublabel
                                            >满1000元9折劵 满5000元8折劵
                                            满10000元7折劵</q-item-tile
                                        >
                                    </q-item-main>
                                </q-item>
                            </q-list>
                        </q-card-main>
                    </q-card>
                </div>
            </div>
        </div>

        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
    </q-page>
</template>

<script>
// import { filter } from "quasar";

export default {
    name: "packages",
    components: {},
    $_veeValidate: {},
    created: function() {
        this.initData();
    },
    methods: {
        initData: function() {
            this.loader = true;
            this.$axios({
                method: "get",
                url: "/api/v1/product/getAllProducts/主材商户/" + this.filter
            }).then(response => {
                this.loader = false;
                if (response.data.success) {
                    this.tableData = response.data.data;
                    this.cnt = response.data.count;
                } else {
                    this.$q.notify({
                        message: "数据获取失败",
                        type: "negative"
                    });
                }
            });
            this.loader = false;
        },
        handleSubmit: function(submitEvent) {}
    },
    watch: {},
    data() {
        return {
            cnt: 0,
            loader: false,
            tableData: [],
            filter: "",
            dark: true
        };
    }
};
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
