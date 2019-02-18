<template>
    <q-modal v-model="show" position="">
        <form
            class="layout-padding"
            @submit.prevent="validateForm"
            ref="addprodform"
        >
            <q-field class="q-mb-md">
                <q-select
                    name="product_id"
                    stack-label="商品（服务）名称"
                    v-model="form.product_id"
                    :options="product"
                />
            </q-field>

            <q-field
                class="q-mb-md"
                autofocus
                :error="errors.has('user')"
                :error-label="errors.first('user')"
            >
                <q-input
                    v-model="form.name"
                    name="username"
                    type="text"
                    v-validate="form_rules.name"
                    data-vv-as="名称"
                    stack-label="名称"
                >
                </q-input>
            </q-field>

            <q-field
                class="q-mb-md"
                icon="money_off"
                label="折扣力度"
                :helper="form.discount + ' * 商品价格'"
            >
                <q-slider
                    class="dark"
                    v-model="form.discount"
                    :step="0.01"
                    :min="0.01"
                    :max="0.99"
                    label
                />
                <q-input
                    v-model="form.discount"
                    type="number"
                    :min="0.01"
                    :max="0.99"
                />
            </q-field>

            <q-field
                class="q-mb-md"
                label="打折劵总量"
                helper="请填写此次发布的打折劵总量"
            >
                <q-input
                    v-model="form.total"
                    type="number"
                    :min="1"
                    :decimals="0"
                    :max="99999"
                    stack-label="打折劵总量"
                />
            </q-field>
            <q-field
                class="q-mb-md"
                label="限领张数"
                helper="请填写此次发布的打折劵每人限领张数"
            >
                <q-input
                    v-model="form.maximum"
                    type="number"
                    :step="1"
                    :min="1"
                    :decimals="0"
                    :max="99999"
                    stack-label="限领张数"
                />
            </q-field>

            <q-field helper="请填写优惠起始日期">
                <q-datetime-picker
                    minimal
                    color="orange"
                    :max="form.enddate"
                    v-model="form.startdate"
                    type="date"
                />
            </q-field>

            <q-field helper="请填写介绍及说明">
                <q-datetime-picker
                    minimal
                    :min="form.startdate"
                    color="orange"
                    v-model="form.enddate"
                    type="date"
                />
            </q-field>

            <q-field helper="请填写优惠结束日期">
                <q-input
                    float-label="介绍及说明"
                    v-model="form.memo"
                    type="textarea"
                />
            </q-field>

            <div class="row justify-center q-mt-md">
                <q-btn type="submit" color="primary" label=" 添加商品 ">
                </q-btn>
                <div class="col" />
                <q-btn
                    color="secondary"
                    @click="$emit('childByValue', false)"
                    label="关闭"
                />
            </div>
        </form>
        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
    </q-modal>
</template>

<script>
import { mapActions, mapState } from "vuex";

export default {
    name: "addprcoupon",
    props: ["addshow"],
    $_veeValidate: {
        validator: "new"
    },
    components: {
        // VueRecaptcha
    },
    computed: {
        ...mapState("bus", ["products"]),
        show: {
            get: function() {
                return this.addshow;
            },
            set: function(show) {
                this.$emit("childByValue", false);
            }
        }
    },
    watch: {},
    methods: {
        ...mapActions("bus", ["addPrcoupon"]),
        // ...mapActions("bus", ["addPrcoupon", "getMyproducts"]),
        validateForm() {
            this.$validator
                .validateAll()
                .then(result => {
                    if (result) {
                        this.addproduct();
                        return false;
                    }
                })
                .catch(() => {});
        },
        initData: function() {
            for (let key in this.products) {
                this.product.push({
                    label: this.products[key].name,
                    value: this.products[key].id
                });
            }
        },
        addproduct() {
            this.loader = true;
            let formData = new FormData();
            for (let key in this.form) {
                formData.append(key, this.form[key]);
            }
            this.addPrcoupon(formData).then(
                response => {
                    for (let key in this.form) {
                        this.form[key] = null;
                    }
                    this.loader = false;
                    this.$master.self.$q.notify({
                        message: response.data.messages,
                        type: "positive"
                    });
                },
                errors => {
                    this.loader = false;
                    // this.$master.self.$q.notify({
                    //     message: errors.messages,
                    //     type: "negative"
                    // });
                }
            );
        }
    },
    created: function() {
        this.initData();
    },
    data() {
        return {
            loader: false,
            product: [],
            form: {
                product_id: null,
                name: "8折劵",
                discount: 0.8,
                total: 100,
                maximum: 2,
                startdate: "2019-2-10",
                enddate: "2019-2-20",
                memo: "8折劵你服不服？ 拿去过年"
            },
            form_rules: {
                name: "required|max:50",
                product_id: "required"
            }
        };
    }
};
</script>

<style scoped></style>
