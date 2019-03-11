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
                <q-list separator>
                    <q-collapsible avatar="/img/media/53/175-2-1600x900.jpg" label="富森美家居" opened>

                        <q-card flat color="lime-1">
                            <q-item color="amber-1">
                                <q-item-side image="/img/media/53/175-2-1600x900.jpg" />
                                <q-item-main inset>
                                    <q-item-tile label text-color="black"> <font color="red" size="14px">￥50 </font> <font color="red" >满99减50</font></q-item-tile>
                                    <q-item-tile label-lines text-color="black">[ 店铺优惠券 ] 有效期：2019.3.1-2019.4.30
                                    </q-item-tile>
                                </q-item-main>
                                <q-card-actions>
                                    <q-btn glossy style="background: #FA8B23; color: white" rounded label=" 去使用 " />
                                </q-card-actions>
                            </q-item>
                        </q-card>
                        <q-card-separator />

                        <q-card flat color="lime-1">
                            <q-item color="amber-1">
                                <q-item-side image="/img/media/53/175-2-1600x900.jpg" />
                                <q-item-main inset>
                                    <q-item-tile label text-color="black"> <font color="red" size="14px">￥100 </font> <font color="red" >满499减100</font></q-item-tile>
                                    <q-item-tile label-lines text-color="black">[ 店铺优惠券 ] 有效期：2019.3.1-2019.4.30
                                    </q-item-tile>
                                </q-item-main>
                                <q-card-actions>
                                    <q-btn glossy style="background: #FA8B23; color: white" rounded label=" 去使用 " />
                                </q-card-actions>
                            </q-item>
                        </q-card>
                        <q-card-separator />

                    </q-collapsible>

                    <q-collapsible avatar="/img/media/53/175-2-1600x900.jpg" label="XXX生活馆">

                        <q-card flat color="lime-1">
                            <q-item color="amber-1">
                                <q-item-side image="/img/media/53/175-2-1600x900.jpg" />
                                <q-item-main inset>
                                    <q-item-tile label text-color="black"> <font color="red" size="14px">￥50 </font> <font color="red" >满99减50</font></q-item-tile>
                                    <q-item-tile label-lines text-color="black">[ 店铺优惠券 ] 有效期：2019.3.1-2019.4.30
                                    </q-item-tile>
                                </q-item-main>
                                <q-card-actions>
                                    <q-btn glossy style="background: #FA8B23; color: white" rounded label=" 去使用 " />
                                </q-card-actions>
                            </q-item>
                        </q-card>
                        <q-card-separator />

                        <q-card flat color="lime-1">
                            <q-item color="amber-1">
                                <q-item-side image="/img/media/53/175-2-1600x900.jpg" />
                                <q-item-main inset>
                                    <q-item-tile label text-color="black"> <font color="red" size="14px">￥100 </font> <font color="red" >满499减100</font></q-item-tile>
                                    <q-item-tile label-lines text-color="black">[ 店铺优惠券 ] 有效期：2019.3.1-2019.4.30
                                    </q-item-tile>
                                </q-item-main>
                                <q-card-actions>
                                    <q-btn glossy style="background: #FA8B23; color: white" rounded label=" 去使用 " />
                                </q-card-actions>
                            </q-item>
                        </q-card>
                        <q-card-separator />

                    </q-collapsible>
                </q-list>


                未使用的

            </q-tab-pane>
            <q-tab-pane name="used">已使用的</q-tab-pane>
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
            tableData: [],
            columns: [
                {
                    name: "media",
                    required: true,
                    label: "图片",
                    align: "left",
                    field: "media",
                    sortable: true
                },
                {
                    name: "name",
                    required: true,
                    label: "商品（服务）名",
                    align: "left",
                    field: "name",
                    sortable: true
                },
                {
                    name: "price",
                    label: "价格",
                    field: "price",
                    sortable: true
                },
                { name: "unit", label: "单位", field: "unit", sortable: true },
                { name: "memo", label: "说明介绍", field: "memo" }
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

<style scoped></style>
