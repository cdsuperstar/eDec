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
                <div
                    v-for="prod in MyCoupons"
                    v-bind:key="prod.pivot.id"
                    style="margin-bottom: 5px;"
                >
                    <q-list
                        class="toothbg"
                        style="background-color: #F7FFB8;border-radius: 2%;border-color: #F7FFD4"
                    >
                        <q-list-header style="background-color: #ffffff">
                            商品名称：{{ prod.product.name }} <br />
                            有效期：{{ prod.startdate }}
                            至
                            {{ prod.enddate }}
                        </q-list-header>
                        <q-item style="background-color:#F7FFD4">
                            <q-item-side left>
                                <q-card-media>
                                    <q-carousel
                                        color="white"
                                        arrows
                                        height="80px"
                                        style="border-radius: 10%;"
                                    >
                                        <q-carousel-slide
                                            v-for="item in prod.product.media"
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
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label text-color="red">
                                    <font size="6px" face="微软雅黑"
                                        >{{ prod.discount * 10 }}
                                    </font>
                                    <font
                                        size="4px"
                                        face="黑体"
                                        style="font-weight:bold"
                                        >折</font
                                    >
                                </q-item-tile>
                                <q-item-tile label text-color="red">
                                    [ {{ prod.name }} ]{{ prod.memo }}
                                </q-item-tile>
                            </q-item-main>
                            <q-item-side right>
                                <q-btn
                                    outline
                                    rounded
                                    class="btmnowrap"
                                    style="color: goldenrod;"
                                    label="使用"
                                    v-on:click="GetMyQR(prod.pivot.id)"
                                />
                            </q-item-side>
                        </q-item>
                    </q-list>
                </div>
            </q-tab-pane>
            <q-tab-pane name="used">
                <div
                    v-for="prod in MyUsedCoupons"
                    v-bind:key="prod.pivot.id"
                    style="margin-bottom: 5px;"
                >
                    <q-list
                        class="toothbg"
                        style="background-color: #e1ebfb;border-radius: 2%;border-color: #f1f6fd"
                    >
                        <q-list-header style="background-color: #ffffff">
                            商品名称：{{ prod.product.name }} <br />
                            有效期：{{ prod.startdate }}
                            至
                            {{ prod.enddate }}
                        </q-list-header>
                        <q-item style="background-color:#f1f6fd">
                            <q-item-side left>
                                <q-card-media>
                                    <q-carousel
                                        color="white"
                                        arrows
                                        height="80px"
                                        style="border-radius: 10%;"
                                    >
                                        <q-carousel-slide
                                            v-for="item in prod.product.media"
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
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label text-color="red">
                                    <font size="6px" face="微软雅黑"
                                        >{{ prod.discount * 10 }}
                                    </font>
                                    <font
                                        size="4px"
                                        face="黑体"
                                        style="font-weight:bold"
                                        >折</font
                                    >
                                </q-item-tile>
                                <q-item-tile label text-color="red">
                                    [ {{ prod.name }} ] {{ prod.memo }}
                                </q-item-tile>
                            </q-item-main>
                            <q-item-side right>
                                <div class="symnowrap">
                                    <font size="4" face="黑体">已使用</font>
                                </div>
                            </q-item-side>
                        </q-item>
                    </q-list>
                </div>
            </q-tab-pane>
            <q-tab-pane name="outdated">
                <div
                    v-for="prod in MyExpCoupons"
                    v-bind:key="prod.pivot.id"
                    style="margin-bottom: 5px;"
                >
                    <q-list
                        class="toothbg"
                        style="background-color: #e7e4e4;border-radius: 2%;border-color: #F7F5F5"
                    >
                        <q-list-header style="background-color: #ffffff">
                            商品名称：{{ prod.product.name }} <br />
                            有效期：{{ prod.startdate }}
                            至
                            {{ prod.enddate }}
                        </q-list-header>
                        <q-item style="background-color:#F7F5F5">
                            <q-item-side left>
                                <q-card-media>
                                    <q-carousel
                                        color="white"
                                        arrows
                                        height="80px"
                                        style="border-radius: 10%;"
                                    >
                                        <q-carousel-slide
                                            v-for="item in prod.product.media"
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
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label text-color="red">
                                    <font size="6px" face="微软雅黑"
                                        >{{ prod.discount * 10 }}
                                    </font>
                                    <font
                                        size="4px"
                                        face="黑体"
                                        style="font-weight:bold"
                                        >折</font
                                    >
                                </q-item-tile>
                                <q-item-tile label text-color="red">
                                    [ {{ prod.name }} ]{{ prod.memo }}
                                </q-item-tile>
                            </q-item-main>
                            <q-item-side right>
                                <div class="symnowrap">
                                    <font size="4" face="黑体">已过期</font>
                                </div>
                            </q-item-side>
                        </q-item>
                    </q-list>
                </div>
            </q-tab-pane>
        </q-tabs>

        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
        <QRIMG
            :QRimgshow="QRimgshow"
            v-on:QRchildByValueUpdate="QRchildByValueUpdate"
        ></QRIMG>
    </q-page>
</template>

<script>
import QRIMG from "./QRmodel";
import { mapActions, mapGetters } from "vuex";

export default {
    name: "mycoupons",
    components: {
        QRIMG
    },
    computed: {
        // ...mapState("bus", ["MyCoupons", "MyUsedCoupons", "MyExpCoupons"]),
        ...mapGetters("bus", ["MyCoupons", "MyUsedCoupons", "MyExpCoupons"])
    },
    created: function() {
        this.getMycoupons().then(
            () => {
                console.log(this.MyCoupons);
            },
            () => {
                // console.log("111111111");
            }
        );
        this.getMyUsedCoupons().then(
            () => {
                console.log(this.MyUsedCoupons);
            },
            () => {
                // console.log("111111111");
            }
        );
        this.getMyExpCoupons().then(
            () => {
                console.log(this.MyExpCoupons);
            },
            () => {
                // console.log("111111111");
            }
        );
        // this.initData();
    },
    methods: {
        ...mapActions("bus", [
            "getMycoupons",
            "getMyUsedCoupons",
            "getMyExpCoupons"
        ]),
        QRchildByValueUpdate: function(childValue) {
            this.QRimgshow = childValue;
        },
        GetMyQR: function(itid) {
            this.Qrimgid = itid;
            this.QRimgshow = true;
        }
    },
    watch: {},
    data() {
        return {
            loader: false,
            Qrimgid: null,
            QRimgshow: false,
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
div .q-card-media {
    width: 100px;
    border-radius: 10%;
}
.btmnowrap {
    background: #e9f3fc;
    color: white;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    /*text-overflow:ellipsis;*/
}
.symnowrap {
    /*background: #e9f3fc;*/
    /*color: white;*/
    display: block;
    white-space: nowrap;
    overflow: hidden;
    transform: rotate(-30deg);
    -ms-transform: rotate(-30deg); /* Internet Explorer 9*/
    -moz-transform: rotate(-30deg); /* Firefox */
    -webkit-transform: rotate(-30deg); /* Safari 和 Chrome */
    -o-transform: rotate(-30deg); /* Opera */
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);
    /*text-overflow:ellipsis;*/
    border-radius: 50%;
    border-style: solid;
    border-width: 1px;
    border-color: #737373;
    color: #979797;
    line-height: 50px;
    text-align: center;
}
</style>
