<template>
    <q-page padding class="docs-table">
        <p class="caption">优惠劵</p>
        <q-tabs class="shadow-1" color="secondary" glossy align="justify">
            <q-tab
                default
                name="unused"
                slot="title"
                icon="receipt"
                label="未使用"
            />
            <q-tab
                name="used"
                slot="title"
                icon="done_outline"
                label="已使用"
            />
            <q-tab
                name="outdated"
                slot="title"
                icon="delete_outline"
                label="已过期"
            />

            <q-tab-pane name="unused">
                <q-list
                    separator
                    v-for="prod in mycoupons"
                    v-bind:key="prod.id"
                >
                    <q-list-header>
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
                        阿斯顿发放
                    </q-list-header>
                    <q-item>
                        <q-item-main>
                            <q-item-tile label text-color="red">
                                <font size="6px">￥{{ prod.price }} </font>
                            </q-item-tile>
                            <q-item-tile label text-color="red">
                                [ {{ prod.name }} ] {{ prod.memo }}
                            </q-item-tile>
                            <q-item-tile label-lines text-color="black"
                                >有效期：{{ prod.created_at }} -
                                {{ prod.updated_at }}
                            </q-item-tile>
                        </q-item-main>
                        <q-item-side right>
                            <q-btn
                                outline
                                rounded
                                class="btmnowrap"
                                style="color: goldenrod;"
                                label="立即使用"
                            />
                        </q-item-side>
                    </q-item>
                </q-list>
            </q-tab-pane>
            <q-tab-pane name="used"> 已使用的</q-tab-pane>
            <q-tab-pane name="outdated">过期的</q-tab-pane>
        </q-tabs>

        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
    </q-page>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "mycoupons",
    components: {},
    computed: {
        ...mapState("bus", ["mycoupons"])
    },
    created: function() {
        this.getMycoupons().then(
            () => {
                // console.log(this.mycoupons);
            },
            () => {
                // console.log("111111111");
            }
        );
        // this.initData();
    },
    methods: {
        ...mapActions("bus", ["getMycoupons"])
    },
    watch: {},
    data() {
        return {
            loader: false,
            form_rules: {
                // name: 'required|max:30',
                phone: "required|max:15|numeric",
                address: "required|max:200"
            }
        };
    }
};
</script>

<style type="text/css">
/*div .q-card-media .relative-position {*/
/*width: 120px;*/
/*border-radius: 10%;*/
/*}*/
.btmnowrap {
    background: #fa8b23;
    color: white;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    /*text-overflow:ellipsis;*/
}
</style>
