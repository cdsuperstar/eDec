<template>
    <q-page>
        <form @submit.prevent="handleSubmit" class="docs-input row justify-center layout-padding" >
            <div style="width: 500px; max-width: 90vw;">
                <q-field
                >
                    <q-input float-label="申请类型"
                             name="owner"
                             readonly
                             aria-disabled="true"
                             value="装修公司"
                    />
                </q-field>

                <q-field
                        :count="30"
                        helper="公司名称申请后不得更改，如需变更请联系后台。"
                >
                    <q-input
                            float-label="公司(商铺)名称"
                            name="name"
                            v-model="form.name"
                            readonly=""
                            ref="name"
                            stack-label="公司(商铺)名称"
                    />
                </q-field>

                <q-field
                >
                    <q-input
                            float-label="后台审核状态"
                            name="name"
                            v-model="form.stat"
                            readonly=""
                            ref="name"
                            stack-label="后台审核状态"
                    />
                </q-field>

                <q-field
                        :count="200"
                        helper="请填写联系地址"
                        :error="errors.has('address')"
                        :error-label="errors.first('address')"
                >
                    <q-input
                            float-label="地址"
                            name="address"
                            data-vv-as="地址不得大于200."
                            v-model="form.address"
                            ref="address"
                            v-validate="form_rules.address"
                    />
                </q-field>

                <q-field
                        helper="公司负责人申请后不得更改，如需变更请联系后台。"
                >
                    <q-input float-label="公司负责人"
                             name="owner"
                             readonly=""
                             v-model="form.owner"
                    />
                </q-field>

                <q-field
                        :count="15"
                        helper="请填写公司固定电话"
                >
                    <q-input float-label="固定电话"
                             name="tel"
                             v-model="form.tel"
                    />
                </q-field>

                <q-field
                        :count="15"
                        helper="请填写联系电话"
                        :error="errors.has('phone')"
                        :error-label="errors.first('phone')"
                >
                    <q-input float-label="移动电话"
                             name="phone"
                             v-model="form.phone"
                             data-vv-as="电话不得长于15位."
                             v-validate="form_rules.phone"
                    />
                </q-field>

                <q-field
                        helper="公司情况介绍"
                >
                    <q-input float-label="介绍及说明" v-model="form.memo" type="textarea" />
                </q-field>

                <q-field
                        helper="公司装修工艺介绍"
                >
                    <q-input float-label="介绍及说明" v-model="form.aomemo" type="textarea" />
                </q-field>

                <div class="row justify-center q-mt-md">
                    <q-btn
                            type="submit"
                            color="primary"
                            label=" 修 改 公 司 信 息 ">
                    </q-btn>
                </div>

            </div>

        </form>
        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>

    </q-page>
</template>

<script>
export default {
  name: 'my-company',
  $_veeValidate: {
    validator: 'newapply'
  },
  created: function () {
    this.initData()
  },
  methods: {
    initData: function () {
      this.$axios({
        method: 'get',
        url: '/api/v1/company/mine'
      }).then((response) => {
        if (response) {
          let resAcc = response.data
          for (let key in resAcc) {
            this.form[key] = resAcc[key]
          }
        }
      })
    },
    handleSubmit: function (submitEvent) {
      this.$validator.validateAll()
        .then((result) => {
          if (result) {
            this.updateaccount()
            return false
          } else {
            console.log(result, 'validate failed.')
          }
        }).catch((e) => {
          this.loader = false
          console.log(this.errors, 'validate exception line 109.', e)
        })
    },
    updateaccount () {
      this.loader = true
      let formData = new FormData()
      for (let key in this.form) {
        formData.append(key, this.form[key])
      }
      this.$axios({
        method: 'post',
        url: '/api/v1/company/apply',
        data: formData
      }
      ).then((response) => {
        this.initData()
        this.$q.notify({
          message: response.data.messages,
          type: 'positive'
        })
        this.loader = false
      }).catch((errors) => {
        let list = this.$master.hasErrors(errors)
        if (list) {
          let message = this.$master.getValue(errors, ['response', 'data', 'message'])
          let type = message
          for (const key of Object.keys(list)) {
            if (list.hasOwnProperty(key)) {
              type = ((message === 'invalid_credentials') ? 'auth' : key)
              this.errors.add({
                field: key,
                msg: list[key][0],
                rule: type
              })
              console.log(this.errors)
            }
          }
        }
      }).finally(() => {
        this.loader = false
      })
    }
  },
  watch: {
  },
  data () {
    return {
      loader: false,
      form: {
        applyapi: '',
        name: '',
        address: '',
        owner: '',
        tel: '',
        phone: '',
        memo: '',
        aomemo: ''
      },
      form_rules: {
        // name: 'required|max:30',
        phone: 'required|max:15|numeric',
        address: 'required|max:200'
      }
    }
  }
}
</script>

<style scoped>

</style>
