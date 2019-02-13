<template>
    <q-page padding class="docs-table">
                <p class="caption">您的商品（服务）列表</p>
                <q-table
                        :data="tableData"
                        ref="dataTable"
                        :columns="columns"
                        :filter="filter"
                        selection="multiple"
                        :selected.sync="selectedSecond"
                        row-key="id"
                        color="secondary"
                        title="请选择数据"
                >
                    <template slot="top-left" slot-scope="props">
                        <q-search
                                hide-underline
                                color="secondary"
                                v-model="filter"
                                class="col-6"
                        />
                        <q-btn color="secondary" flat label="增加" @click="addshow=!addshow" class="q-mr-sm" />
                    </template>
                    <template slot="top-selection" >
                        <q-btn color="secondary" flat label="修改" v-if="selectedSecond.length>=0" @click="updateshow=!updateshow" />
                        <q-btn color="negative" flat round icon="delete" @click="deleteRow" />
                        <div class="col" />
                    </template>
                    <q-td slot="body-cell-media" slot-scope="props" :props="props">
                        <q-carousel
                                color="white"
                                arrows
                                height="80px"
                        >
                            <q-carousel-slide v-for="item in props.value" :key="item.id" :img-src="'/img/media/'+item.id+'/'+item.file_name">
                            </q-carousel-slide>
                        </q-carousel>
                    </q-td>
                </q-table>
        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
        <addprod :addshow="addshow" v-on:refreshPData="initData" v-on:childByValue="childByValue"></addprod>
        <updateprod :updateshow="updateshow" :selectedRows="selectedSecond" v-on:refreshPData="initData" v-on:childByValueUpdate="childByValueUpdate"></updateprod>

    </q-page>
</template>

<script>
import addprod from '../business/addprod'
import updateprod from '../business/updateprod'

export default {
  name: 'my-vendor',
  components: {
    addprod,
    updateprod
  },
  $_veeValidate: {
    validator: 'newapply'
  },
  created: function () {
    this.initData()
  },
  methods: {
    childByValue: function (childValue) {
      this.addshow = childValue
    },
    childByValueUpdate: function (childValue) {
      this.updateshow = childValue
    },
    deleteRow () {
      this.$q.dialog({
        title: '删除确认',
        message: '确定要删除所选记录吗？',
        ok: '确定',
        cancel: '取消'
      }).then(() => {
        this.$axios({
          method: 'delete',
          url: '/api/v1/product/delMany',
          data: { toDel: this.selectedSecond }
        }).then((response) => {
          if (response.data.success) {
            this.initData()
            this.$q.notify({
              message: response.data.messages,
              type: 'positive'
            })
            // this.$refs.dataTable.loading = false
          } else {
            this.$q.notify({
              message: '数据删除失败',
              type: 'negative'
            })
          }
        })
      }).catch(() => {
        // this.$q.notify('Disagreed...')
      })
    },
    initData: function () {
      this.$axios({
        method: 'get',
        url: '/api/v1/product/getMyProducts'
      }).then((response) => {
        if (response.data.success) {
          let resAcc = response.data.data
          // console.log(resAcc[0].media)
          this.tableData = resAcc
          // this.$refs.dataTable.loading = false
        } else {
          this.$q.notify({
            message: '数据获取失败',
            type: 'negative'
          })
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
        url: '/api/v1/vendor/apply',
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
    'paginationControl.page' (page) {
      this.$q.notify({
        color: 'secondary',
        message: `Navigated to page ${page}`,
        actions: page < 4
          ? [{
            label: 'Go to last page',
            handler: () => {
              this.paginationControl.page = 4
            }
          }]
          : null
      })
    }
  },
  data () {
    return {
      addshow: false,
      updateshow: false,
      loader: false,
      tableData: [],
      columns: [
        {
          name: 'media',
          required: true,
          label: '图片',
          align: 'left',
          field: 'media',
          sortable: true
        },
        {
          name: 'name',
          required: true,
          label: '商品（服务）名',
          align: 'left',
          field: 'name',
          sortable: true
        },
        { name: 'price', label: '价格', field: 'price', sortable: true },
        { name: 'unit', label: '单位', field: 'unit', sortable: true },
        { name: 'memo', label: '说明介绍', field: 'memo' }
      ],

      filter: '',
      visibleColumns: ['name', 'price', 'unit', 'memo'],
      separator: 'horizontal',
      paginationControl: { rowsPerPage: 3, page: 1 },
      loading: false,
      selectedSecond: [],
      dark: true
    }
  }
}
</script>

<style scoped>

</style>
