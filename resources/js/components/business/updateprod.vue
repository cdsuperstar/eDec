<template>
    <q-modal v-model="show" position="">
        <form class="layout-padding" @submit.prevent="validateForm" v-if="selectedRows.length>0">
            <q-carousel
                    color="white"
                    arrows
                    height="80px"
            >
                <q-carousel-slide v-for="item in selectedRows[0].media" :key="item.id" :img-src="'/img/media/'+item.id+'/'+item.file_name">
                </q-carousel-slide>
            </q-carousel>

            <q-field
                class="q-mb-md"
                >
                <q-uploader
                        ref="fileuper"
                        expand-style="Object"
                        auto-expand
                        multiple
                        hide-upload-button
                        hide-upload-progress
                        extensions=".gif,.jpg,.jpeg,.png,.bmp"
                        color="amber" float-label="商品照片"
                        url=""
                >
                </q-uploader>
            </q-field>

            <q-field
                class="q-mb-md"
                autofocus
                :error="errors.has('user')"
                :error-label="errors.first('user')">
                <q-input
                    v-model="form.name"
                    name="username"
                    type="text"
                    v-validate="form_rules.name"
                    data-vv-as="名称"
                    stack-label="名称">
                </q-input>
            </q-field>

            <q-field
                class="q-mb-md"
            >
                <q-input
                    v-model="form.unit"
                    name="unit"
                    type="text"
                    stack-label="计量单位">
                </q-input>
            </q-field>

            <q-field
                class="q-mb-md"
                helper="请填写商品原价"
            >
                <q-input
                        v-model="form.price"
                         type="number"
                        :decimals="2"
                        :max=9999999
                        prefix="￥" stack-label="价格" />
            </q-field>

            <q-field
                    helper="请填写介绍及说明"
            >
                <q-input float-label="介绍及说明" v-model="form.memo" type="textarea" />
            </q-field>

            <div class="row justify-center q-mt-md">
                <q-btn type="submit"
                       color="primary"
                       label=" 保存商品 ">
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
export default {
  name: 'updateprod',
  props: ['updateshow', 'selectedRows'],
  $_veeValidate: {
    validator: 'new'
  },
  components: {
    // VueRecaptcha
  },
  computed: {
    show: {
      get: function () {
        return this.updateshow
      },
      set: function (show) {
        this.$emit('childByValueUpdate', false)
      }
    }
  },
  watch: {
    selectedRows (value) {
      this.form = value[0]
      console.log(value.length)
    }
  },
  methods: {
    validateForm () {
      this.$validator.validateAll()
        .then((result) => {
          if (result) {
            this.addproduct()
            return false
          }
        }).catch(() => {
        })
    },
    addproduct () {
      this.loader = true
      let formData = new FormData()
      for (let key in this.$refs.fileuper.files) {
        formData.append('avatar[]', this.$refs.fileuper.files[key])
      }
      for (let key in this.form) {
        formData.append(key, this.form[key])
      }
      this.$axios({
        method: 'post',
        url: this.$master.api('/product/updateProduct'),
        data: formData
      }).then((response) => {
        if (response.data.success) {
          this.show = false
          this.$emit('refreshPData', false)
          this.$q.notify({
            message: response.data.messages,
            type: 'positive'
          })
        } else {
          this.$q.notify({
            message: response.data.messages,
            type: 'negative'
          })
        }
      }).catch((errors) => {
        let list = this.$master.hasErrors(errors)
        if (list) {
          for (const key of Object.keys(list)) {
            if (list.hasOwnProperty(key)) {
              this.errors.add({
                field: key,
                msg: list[key][0],
                rule: key
              })
            }
          }
        }
      }).finally(() => {
        this.loader = false
      })
    }
  },
  data () {
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
        name: 'required|max:50'
      }
    }
  }
}
</script>

<style scoped>

</style>
