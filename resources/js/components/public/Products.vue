<template>
    <q-page class="card-examples row items-start ">
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
                <div v-for="prod in allProducts" :key="prod.id">
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
                                {{ prod.company.name }}
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
                                <q-item
                                    v-show="Boolean(prod.prcoupons.length)"
                                    v-for="item in prod.prcoupons"
                                    :key="item.id"
                                >
                                    <q-item-side>
                                        <q-item-tile
                                            color="secondary"
                                            icon="card_giftcard"
                                        />
                                    </q-item-side>
                                    <q-item-main>
                                        <q-item-tile label>
                                            {{ item.name }}
                                        </q-item-tile>
                                        <q-item-tile sublabel>
                                            {{ item.memo }}
                                        </q-item-tile>
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
import { mapActions, mapState } from "vuex";

export default {
    name: "products",
    components: {},
    $_veeValidate: {},
    created: function() {
        this.initData();
    },
    computed: {
        ...mapState("bus", ["allProducts"])
    },
    methods: {
        ...mapActions("bus", ["searchAllproduct"]),
        initData: function() {
            this.loader = true;
            let fm = new FormData();
            fm.append("ctype", "主材商户");
            fm.append("filter", this.filter);
            this.searchAllproduct(fm).then(
                resp => {
                    this.loader = false;
                    this.cnt = this.allProducts.length;
                },
                errors => {
                    this.loader = false;
                }
            );
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
