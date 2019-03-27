<template>
    <q-modal v-model="QRshow" minimized position="">
        <!--<img src="/img/media/59/563143.jpg" width="300px" height="300px" />-->
        <!--<img :src="Qrimgshowid" width="300px" height="300px" />-->
        <q-card>
            <q-card-media style="width: 280px;height: 325px;">
                <q-card-title slot="overlay">
                    <div slot="subtitle" class="text-center">
                        点击图片以外区域本窗口自动关闭
                    </div>
                </q-card-title>
                <img
                    src="/img/media/59/1553654171.png"
                    style="width: 280px;height: 280px;"
                    align="center"
                />
            </q-card-media>
        </q-card>
    </q-modal>
</template>

<script>
// import { mapActions, mapState, mapGetters } from "vuex";

export default {
    name: "QRIMG",
    props: ["Qrimgid", "QRimgshow"],
    computed: {
        Qrimgshowid: {
            get: function() {
                console.log(this.Qrimgid);
                return this.Qrimgid;
            },
            set: function(res) {
                console.log(res);
            }
        },
        QRshow: {
            get: function() {
                return this.QRimgshow;
            },
            set: function(res) {
                this.$emit("QRchildByValueUpdate", false);
                // console.log(res);
            }
        }
    },
    data() {
        return {
            loader: false
        };
    }
};
</script>

<style type="text/css"></style>
