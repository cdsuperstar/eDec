<template>
    <q-page>
        <form @submit.prevent="handleSubmit" class="docs-input row justify-center layout-padding" >
            <div style="width: 500px; max-width: 90vw;">
                <q-chip :avatar=form.avatar color="grey-4" text-color="black">{{ form.name }}</q-chip>
                <q-field
                        class="autofocus"
                        helper="请上传头像"
                >
                    <q-uploader
                            ref="fileuper"
                            auto-expand
                            :datasrc=form.avatar
                            hide-upload-button
                            hide-upload-progress
                            extensions=".gif,.jpg,.jpeg,.png,.bmp"
                            color="amber" float-label="个人头像"
                            url=""
                            >
                    </q-uploader>
                </q-field>
                <q-field
                    :count="30"
                    helper="请填写姓名"
                    :error="errors.has('name')"
                    :error-label="errors.first('name')"
                >
                    <q-input
                        float-label="称呼"
                        name="name"
                        v-model="form.name"
                        ref="name"
                        v-validate="form_rules.name"
                        data-vv-as="称呼"
                        stack-label="称呼"
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
                    :count="15"
                    helper="请填写联系电话"
                    :error="errors.has('phone')"
                    :error-label="errors.first('phone')"
                >
                    <q-input float-label="电话"
                             name="phone"
                             v-model="form.phone"
                             data-vv-as="电话不得长于15位."
                             v-validate="form_rules.phone"
                    />
                </q-field>

                <q-field
                    helper="请填写介绍及说明"
                >
                    <q-input float-label="介绍及说明" v-model="form.memo" type="textarea" />
                </q-field>

                <div class="row justify-center q-mt-md">
                    <q-btn
                        type="submit"
                        color="primary"
                        label=" 更 新 ">
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
  name: 'my-account',
  $_veeValidate: {
    validator: 'new'
  },
  created: function () {
    this.initData()
  },
  methods: {
    initData: function () {
      this.$axios({
        method: 'get',
        url: '/api/v1/getMyaccount'
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
        }).catch(() => {
          console.log(this.errors, 'validate exception line 109.')
        })
    },
    updateaccount () {
      this.loader = true
      let formData = new FormData()
      formData.append('avatar', this.$refs.fileuper.files[0])
      for (let key in this.form) {
        formData.append(key, this.form[key])
      }
      this.$axios({
        method: 'post',
        url: '/api/v1/updateAccount/',
        data: formData
      }
      ).then((response) => {
        this.initData()
        this.$q.notify({
          message: '更新成功',
          type: 'positive'
        })
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
    // 'form.name' (val) {
    //   if (this.errors.firstByRule('name', 'auth')) {
    //     this.errors.remove('name')
    //   }
    // },
    // 'form.address' (val) {
    //   if (this.errors.firstByRule('address', 'auth')) {
    //     this.errors.remove('addresss')
    //   }
    // }
  },
  data () {
    return {
      loader: false,
      form: {
        name: '',
        avatar: '',
        address: '',
        phone: '',
        memo: ''
      },
      form_rules: {
        name: 'required|max:30',
        phone: 'required|max:15|numeric',
        address: 'required|max:200'
      }
    }
  }
}
</script>

<style scoped>

</style>
