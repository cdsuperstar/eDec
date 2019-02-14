<template>
    <q-page class="card-examples row items-start">
        <div v-for="(prod , index ) in tableData" :key="prod.id">

            <q-card inline class="q-ma-sm" >
                <q-card-media>
                    <q-carousel
                            color="white"
                            arrows
                            height="120px"
                    >
                        <q-carousel-slide v-for="item in prod.media" :key="item.id" :img-src="'/img/media/'+item.id+'/'+item.file_name">
                        </q-carousel-slide>
                    </q-carousel>
                </q-card-media>
                <q-card-title>
                    {{ prod.name }}
                    <!--<span slot="subtitle">{{ prod.name }} 类别</span>-->
                </q-card-title>
                <q-card-main>
                    <q-list>
                        <q-item>
                            <q-item-side>
                                <q-item-tile color="primary" icon="euro_symbol" />
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label>价格</q-item-tile>
                                <q-item-tile sublabel>{{ prod.price}}</q-item-tile>
                            </q-item-main>
                        </q-item>
                        <q-item>
                            <q-item-side>
                                <q-item-tile color="black" icon="event_note" />
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label>介绍</q-item-tile>
                                <q-item-tile sublabel>{{ prod.memo }}</q-item-tile>
                            </q-item-main>
                        </q-item>
                        <q-item>
                            <q-item-side>
                                <q-item-tile color="secondary" icon="card_giftcard" />
                            </q-item-side>
                            <q-item-main>
                                <q-item-tile label>打折劵</q-item-tile>
                                <q-item-tile sublabel>满1000元9折劵 满5000元8折劵 满10000元7折劵</q-item-tile>
                            </q-item-main>
                        </q-item>
                    </q-list>
                </q-card-main>
            </q-card>

        </div>

        <q-inner-loading :visible="loader">
            <q-spinner-gears size="50px" color="primary"></q-spinner-gears>
        </q-inner-loading>
    </q-page>
</template>

<script>
export default {
  name: 'packages',
  components: {
  },
  $_veeValidate: {
  },
  created: function () {
    this.initData()
  },
  methods: {
    initData: function () {
      this.$axios({
        method: 'get',
        url: '/api/v1/product/getAllProducts'
      }).then((response) => {
        if (response.data.success) {
          let resAcc = response.data.data
          this.tableData = resAcc
        } else {
          this.$q.notify({
            message: '数据获取失败',
            type: 'negative'
          })
        }
      })
    },
    handleSubmit: function (submitEvent) {
    }
  },
  watch: {
  },
  data () {
    return {
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
      selectedSecond: [],
      dark: true
    }
  }
}
</script>

<style lang="stylus" scoped>
    .card-examples
    .q-card
    width 300px
             .bigger
             width 450px
                      max-width 90vw
    @media (max-width $breakpoint-xs-max)
        .q-card
        width 100%
</style>
