<template>
    <q-page padding class="docs-table">
        <p class="caption">打折劵列表</p>
        <q-table
            :data="this.prcoupons"
            ref="dataTable"
            :columns="columns"
            :filter="filter"
            selection="multiple"
            :selected.sync="selectedSecond"
            row-key="id"
            color="secondary"
            title="请选择数据"
        >
            <template slot="top-left">
                <q-search
                    hide-underline
                    color="secondary"
                    v-model="filter"
                    class="col-6"
                />
                <q-btn
                    color="secondary"
                    flat
                    label="增加"
                    @click="addshow = !addshow"
                    class="q-mr-sm"
                />
            </template>
            <template slot="top-selection">
                <q-btn
                    color="secondary"
                    flat
                    round
                    icon="edit"
                    v-if="selectedSecond.length >= 0"
                    @click="updateshow = !updateshow"
                />
                <q-btn
                    color="negative"
                    flat
                    round
                    icon="delete"
                    @click="deleteRow"
                />
                <div class="col" />
            </template>
        </q-table>
        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>

        <addprcoupon
            :addshow="addshow"
            v-on:childByValue="childByValue"
        ></addprcoupon>
        <UpdatePrcoupon
            :updateshow="updateshow"
            :selectedRows="selectedSecond"
            v-on:childByValueUpdate="childByValueUpdate"
        ></UpdatePrcoupon>
    </q-page>
</template>

<script>
// import addprcoupon from () => {return "../business/addprcoupon"};

import { mapActions, mapState } from "vuex";
const addprcoupon = () => import("../business/addprcoupon");
const UpdatePrcoupon = () => import("../business/updateprcoupon");
// import UpdatePrcoupon from "../business/updateprcoupon";

export default {
    name: "coupons",
    components: {
        addprcoupon,
        UpdatePrcoupon
    },
    computed: {
        ...mapState("bus", ["prcoupons"])
    },
    $_veeValidate: {
        validator: "newapply"
    },
    created: function() {
        this.selectedSecond = [];
    },
    methods: {
        ...mapActions("bus", ["delPrcoupons"]),
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
                    this.delPrcoupons(this.selectedSecond).then(
                        resp => {
                            this.$q.notify({
                                message: resp.data.messages,
                                type: "positive"
                            });
                        },
                        errors => {
                            this.$q.notify({
                                message: "数据删除失败",
                                type: "negative"
                            });
                        }
                    );
                })
                .catch(() => {
                    // this.$q.notify('Disagreed...')
                });
        }
    },
    watch: {
        prcoupons(value) {
            // this.tableData = value;
        },
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
                    name: "product",
                    required: true,
                    label: "商品名",
                    align: "left",
                    field: row => row.product.name,
                    sortable: true
                },
                {
                    name: "name",
                    required: true,
                    label: "打折劵名",
                    align: "left",
                    field: "name",
                    sortable: true
                },
                {
                    name: "discount",
                    required: true,
                    label: "折扣力度",
                    align: "left",
                    field: "discount",
                    sortable: true
                },
                {
                    name: "total",
                    required: true,
                    label: "劵总量",
                    align: "left",
                    field: "total",
                    sortable: true
                },
                {
                    name: "maximum",
                    required: true,
                    label: "人均申领上限",
                    align: "left",
                    field: "maximum",
                    sortable: true
                },
                {
                    name: "startdate",
                    required: true,
                    label: "活动开始时间",
                    align: "left",
                    field: "startdate",
                    sortable: true
                },
                {
                    name: "enddate",
                    required: true,
                    label: "活动结束时间",
                    align: "left",
                    field: "enddate",
                    sortable: true
                },
                { name: "memo", label: "说明介绍", field: "memo" }
            ],

            filter: "",
            visibleColumns: [
                "product",
                "name",
                "discount",
                "total",
                "maximum",
                "startdate",
                "enddate",
                "memo"
            ],
            separator: "horizontal",
            paginationControl: { rowsPerPage: 10, page: 1 },
            loading: false,
            selectedSecond: [],
            dark: true
        };
    }
};
</script>

<style scoped></style>
