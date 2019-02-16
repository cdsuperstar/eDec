<template>
    <q-modal v-model="show" position="">
        <form
            v-if="selectedRows.length > 0"
            class="layout-padding"
            @submit.prevent="validateForm"
        >
            <q-carousel color="white" arrows height="80px">
                <q-carousel-slide
                    v-for="item in selectedRows[0].media"
                    :key="item.id"
                    :img-src="'/img/media/' + item.id + '/' + item.file_name"
                />
            </q-carousel>

            <q-field class="q-mb-md">
                <q-uploader
                    ref="fileuper"
                    expand-style="Object"
                    auto-expand
                    multiple
                    hide-upload-button
                    hide-upload-progress
                    extensions=".gif,.jpg,.jpeg,.png,.bmp"
                    color="amber"
                    float-label="商品照片"
                    url=""
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
                    v-validate="form_rules.name"
                    name="username"
                    type="text"
                    data-vv-as="名称"
                    stack-label="名称"
                />
            </q-field>

            <q-field class="q-mb-md">
                <q-input
                    v-model="form.unit"
                    name="unit"
                    type="text"
                    stack-label="计量单位"
                />
            </q-field>

            <q-field class="q-mb-md" helper="请填写商品原价">
                <q-input
                    v-model="form.price"
                    type="number"
                    :decimals="2"
                    :max="9999999"
                    prefix="￥"
                    stack-label="价格"
                />
            </q-field>

            <q-field helper="请填写介绍及说明">
                <q-input
                    v-model="form.memo"
                    float-label="介绍及说明"
                    type="textarea"
                />
            </q-field>

            <div class="row justify-center q-mt-md">
                <q-btn type="submit" color="primary" label=" 保存商品 " />
                <div class="col" />
                <q-btn
                    color="secondary"
                    label="关闭"
                    @click="$emit('childByValueUpdate', false)"
                />
            </div>
        </form>
        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary" />
        </q-inner-loading>
    </q-modal>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: "Updateprod",
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
            form: {
                name: null,
                files: null,
                unit: null,
                price: null,
                memo: null,
                username: null
            },
            form_rules: {
                name: "required|max:50"
            }
        };
    },
    computed: {
        show: {
            get: function() {
                return this.updateshow;
            },
            set: function(show) {
                this.$emit("childByValueUpdate", false);
            }
        }
    },
    watch: {
        selectedRows(value) {
            this.form = value[0];
        }
    },
    methods: {
        ...mapActions("bus", ["updateMyproduct"]),
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
            for (let key in this.$refs.fileuper.files) {
                formData.append("avatar[]", this.$refs.fileuper.files[key]);
            }
            for (let key in this.form) {
                formData.append(key, this.form[key]);
            }

            this.updateMyproduct(formData).then(
                r => {
                    this.show = false;
                    this.$emit("refreshPData");
                    this.$refs.fileuper.reset();
                    for (let key in this.form) {
                        this.form[key] = null;
                    }
                    this.$q.notify({
                        message: r.data.messages,
                        type: "positive"
                    });
                    this.loader = false;
                },
                errors => {
                    this.$q.notify({
                        message: errors,
                        type: "negative"
                    });
                    this.loader = false;
                }
            );
        }
    }
};
</script>

<style scoped></style>
