<template>
    <q-page padding class="docs-table">
        <p class="caption">您的商品（服务）列表</p>
        <q-table
            :data="products"
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
            <q-td slot="body-cell-media" slot-scope="props" :props="props">
                <q-carousel color="white" arrows height="120px">
                    <q-carousel-slide
                        v-for="item in props.value"
                        :key="item.id"
                        :img-src="
                            '/img/media/' + item.id + '/' + item.file_name
                        "
                    >
                    </q-carousel-slide>
                </q-carousel>
            </q-td>
        </q-table>
        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
        <addprod :addshow="addshow" v-on:childByValue="childByValue"></addprod>
        <updateprod
            :updateshow="updateshow"
            :selectedRows="selectedSecond"
            v-on:refreshPData="selectedSecond = []"
            v-on:childByValueUpdate="childByValueUpdate"
        ></updateprod>
    </q-page>
</template>

<script>
import addprod from "../business/addprod";
import updateprod from "../business/updateprod";
import { mapActions, mapState } from "vuex";

export default {
    name: "my-vendor",
    components: {
        addprod,
        updateprod
    },
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
