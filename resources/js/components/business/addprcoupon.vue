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
                    :options="form.product"
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
            </q-field>

            <q-field
                class="q-mb-md"
                label="打折劵总量"
                helper="请填写此次发布的打折劵总量"
            >
                <q-input
                    v-model="form.total"
                    type="number"
                    :step="10"
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

            <q-field helper="请填写介绍及说明">
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
        show: {
            get: function() {
                return this.addshow;
            },
            set: function(show) {
                this.$emit("childByValue", false);
            }
        }
    },
    watch: {
        selectedRows(value) {
            // this.$master.setRecaptchaLang(this.$refs.recaptcha.$el, value);
        }
    },
    methods: {
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
            this.$axios({
                method: "get",
                url: "/api/v1/product/getMyProducts"
            }).then(response => {
                if (response.data.success) {
                    for (let key in response.data.data) {
                        // this.form.product[key].label =
                        //     response.data.data[key].name;
                        // this.form.product[key].value =
                        //     response.data.data[key].id;
                        this.form.product.push({
                            label: response.data.data[key].name,
                            value: response.data.data[key].id
                        });
                    }
                } else {
                    this.$q.notify({
                        message: "数据获取失败",
                        type: "negative"
                    });
                }
            });
        },
        addproduct() {
            this.loader = true;
            let formData = new FormData();
            for (let key in this.form) {
                formData.append(key, this.form[key]);
            }
            this.$axios({
                method: "post",
                url: this.$master.api("/prcoupon/add"),
                data: formData
            })
                .then(response => {
                    if (response.data.success) {
                        this.show = false;
                        this.$emit("refreshPData", false);
                        for (let key in this.form) {
                            // this.form[key] = null;
                        }
                        this.$q.notify({
                            message: response.data.messages,
                            type: "positive"
                        });
                    } else {
                        this.$q.notify({
                            message: response.data.messages,
                            type: "negative"
                        });
                    }
                })
                .catch(errors => {
                    let list = this.$master.hasErrors(errors);
                    if (list) {
                        for (const key of Object.keys(list)) {
                            if (list.hasOwnProperty(key)) {
                                this.errors.add({
                                    field: key,
                                    msg: list[key][0],
                                    rule: key
                                });
                            }
                        }
                    }
                })
                .finally(() => {
                    this.loader = false;
                });
        }
    },
    created: function() {
        this.initData();
    },
    data() {
        return {
            loader: false,
            form: {
                product: [],
                product_id: null,
                name: null,
                discount: 0,
                total: null,
                maximum: null,
                startdate: null,
                enddate: null,
                memo: null,
                username: null
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
