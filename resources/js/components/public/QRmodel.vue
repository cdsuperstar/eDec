<template>
    <q-modal v-model="QRshow" position="">
        <!--<img src="/img/media/59/563143.jpg" width="300px" height="300px" />-->
        <!--<img :src="Qrimgshowid" width="300px" height="300px" />-->
        <q-card>
            <q-card-media
                overlay-position="top"
                style="width: 300px;height: 300px;"
            >
                <img src="/img/media/59/563143.jpg" />
                <q-card-title slot="overlay">
                    <div slot="subtitle" class="text-left">
                        点图片外自动退出
                    </div>
                </q-card-title>
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
