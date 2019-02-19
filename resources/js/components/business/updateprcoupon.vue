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
                    :step="0.01"
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
                <q-btn type="submit" color="primary" label=" 修改商品 ">
                </q-btn>
                <div class="col" />
                <q-btn
                    color="secondary"
                    @click="$emit('childByValueUpdate', false)"
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
    name: "UpdatePrcoupon",
    components: {
        // VueRecaptcha
    },
    props: ["updateshow", "selectedRows"],
    $_veeValidate: {
        validator: "new"
    },
    data() {
        return {
            loader: false,
            product: [],
            form: {
                product_id: null,
                name: null,
                discount: null,
                total: null,
                maximum: null,
                startdate: null,
                enddate: null,
                memo: null,
                username: null
            },
            form_rules: {
                name: "required|max:50"
            }
        };
    },
    computed: {
        ...mapState("bus", ["products"]),
        show: {
            get: function() {
                return this.updateshow;
            },
            set: function(show) {
                this.$emit("childByValueUpdate", false);
            }
        }
    },
    created: function() {
        for (let key in this.products) {
            this.product.push({
                label: this.products[key].name,
                value: this.products[key].id
            });
        }
    },
    watch: {
        selectedRows(value) {
            if (value[0]) this.form = value[0];
        }
    },
    methods: {
        ...mapActions("bus", ["updatePrcoupon"]),
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
        addproduct() {
            this.loader = true;
            let formData = new FormData();

            for (let key in this.form) {
                formData.append(key, this.form[key]);
            }

            this.updatePrcoupon(formData).then(
                response => {
                    this.show = false;
                    this.loader = false;
                    for (let key in this.form) {
                        this.form[key] = null;
                    }
                    this.$q.notify({
                        message: response.data.messages,
                        type: "positive"
                    });
                },
                errors => {
                    this.show = false;
                    this.loader = false;
                    this.$q.notify({
                        message: errors.messages,
                        type: "negative"
                    });
                }
            );
        }
    }
};
</script>

<style scoped></style>
