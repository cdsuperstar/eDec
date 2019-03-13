<template>
    <q-page padding class="docs-table">
        <p class="caption">优惠劵</p>
        <q-tabs
            class="shadow-1"
            animated
            swipeable
            color="secondary"
            glossy
            align="justify"
        >
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
                    v-for="prod in tableData"
                    v-bind:key="prod.id"
                >
                    <q-card flat color="lime-1">
                        <q-item>
                            <q-item-side
                                :avatar="prod.picurl"
                                class="qitemcircle"
                            />
                            <q-item-main inset>
                                <q-item-tile label text-color="red">
                                    <font size="6px"
                                        >￥{{ prod.facevalue }}
                                    </font>
                                </q-item-tile>
                                <q-item-tile label text-color="red">
                                    {{ prod.condition }}
                                </q-item-tile>
                                <q-item-tile label-lines text-color="black"
                                    >[ {{ prod.type }} ] 有效期：{{
                                        prod.validityperiodstart
                                    }}
                                    - {{ prod.validityperiodend }}
                                </q-item-tile>
                            </q-item-main>
                            <q-card-actions>
                                <q-btn
                                    glossy
                                    rounded
                                    class="btmnowrap"
                                    label=" 去使用 "
                                />
                            </q-card-actions>
                        </q-item>
                    </q-card>
                    <q-card-separator />
                </q-list>
                未使用的
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
        ...mapState("bus", ["products"])
    },
    $_veeValidate: {
        validator: "newapply"
    },
    created: function() {
        // this.initData();
    },
    methods: {
        ...mapActions("bus", [
            "getMyproducts",
            "updateMycompany",
            "delMyproducts"
        ]),
        childByValue: function(childValue) {
            this.addshow = childValue;
        },
        childByValueUpdate: function(childValue) {
            this.selectedSecond = [];
            this.updateshow = childValue;
        },
        deleteRow() {
            this.$q
                .dialog({
                    title: "删除确认",
                    message: "确定要删除所选记录吗？",
                    ok: "确定",
                    cancel: "取消"
                })
                .then(() => {
                    this.delMyproducts(this.selectedSecond).then(
                        response => {
                            this.selectedSecond = [];
                            this.$master.self.$q.notify({
                                message: response.data.messages,
                                type: "positive"
                            });
                        },
                        errors => {
                            this.$master.self.$q.notify({
                                message: errors,
                                type: "negative"
                            });
                        }
                    );
                })
                .catch(() => {
                    // this.$q.notify('Disagreed...')
                });
        },
        initData: function() {
            this.selectedSecond = [];
        }
    },
    watch: {
        "paginationControl.page"(page) {
            this.$q.notify({
                color: "secondary",
                message: `Navigated to page ${page}`,
                actions:
                    page < 4
                        ? [
                              {
                                  label: "Go to last page",
                                  handler: () => {
                                      this.paginationControl.page = 4;
                                  }
                              }
                          ]
                        : null
            });
        }
    },
    data() {
        return {
            addshow: false,
            updateshow: false,
            loader: false,
            tableData: [
                {
                    id: 1,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 2,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 4,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 3,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 5,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 6,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 7,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 8,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 9,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 11,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 10,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 12,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 13,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 14,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 15,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 16,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 17,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 18,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 19,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 20,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 21,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 22,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                },
                {
                    id: 23,
                    name: "三合板主材",
                    picurl:
                        "/img/media/16/34559833bed1ea6c3d0c6b34e3dea8c5.jpg",
                    facevalue: 50,
                    validityperiodstart: "2019-3-13 12:00",
                    validityperiodend: "2019-3-23 12:00",
                    condition: "满99使用50",
                    type: "店铺优惠券"
                },
                {
                    id: 24,
                    name: "木工板",
                    picurl:
                        "/img/media/47/F1EBBA58-D8AD-47EA-9E95-A10FC871B040.jpeg",
                    facevalue: 150,
                    validityperiodstart: "2019-3-16 12:00",
                    validityperiodend: "2019-3-28 12:00",
                    condition: "满399使用150",
                    type: "店铺优惠券"
                }
            ],

            filter: "",
            visibleColumns: ["name", "price", "unit", "memo"],
            separator: "horizontal",
            paginationControl: { rowsPerPage: 3, page: 1 },
            loading: false,
            selectedSecond: [],
            dark: true
        };
    }
};
</script>

<style type="text/css">
.qitemcircle img {
    border-radius: 10%;
}
.btmnowrap {
    background: #fa8b23;
    text-color: white;
    display: block;
    white-space: nowrap;
    overflow: hidden;
    /*text-overflow:ellipsis;*/
}
</style>
