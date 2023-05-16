<template>

    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-3 col-md-3" v-for="tap in taps">
                <div class="card" v-if="tap.keg_id != null">
                    <div class="header">
                        <h2 class="mt-3">{{ tap.name }}</h2>
                    </div>
                    <div class="body ribbon text-center" :class="tap.keg.send_warning ? 'border-orange' : ''">
                        <div class="ribbon-box orange" v-if="tap.keg.send_warning">
                            <i class="fa fa-warning"></i>
                        </div>
                        <div class="ribbon-box red" v-else-if="tap.mililiters == 0">
                            <i class="fa fa-close"></i>
                        </div>
                        <div class="mt-4" v-if="tap.keg == null">
                            <img class="img-thumbnail" :src="tap.image" alt="Nível" width="100">
                        </div>

                        <div class="mt-4" v-else>
                            <a :href="urlkegedit + '/' + tap.keg.slug">
                                <img class="img-thumbnail" :src="tap.image" alt="Nível" width="100">
                            </a>
                        </div>
                        <h3 class="mb-0 mt-3 font300" v-if="!tap.keg.send_warning">{{ tap.mililiters }}L</h3>
                        <h3 class="mb-0 mt-3 font300 text-orange" v-else>{{ tap.mililiters }}L</h3>
                        <small v-if="!tap.keg">
                            <span class="text-green font-15">Vazio</span>
                        </small>
                        <small v-else-if="getLevelTapInfo(tap)">
                            <span class="text-green font-15">Cheio</span>
                        </small>

                        <small v-else>
                            <span class="text-green font-15" v-if="!tap.keg.send_warning">{{ tap.percent }}% consumido</span>
                            <span class="text-orange font-15" v-else>{{ tap.percent }}% consumido</span>
                        </small>
                        <div class="mt-4">
                            <div class="text-center text-muted">
                                <i class="fa fa-beer badge-warning"></i> {{ tap.keg.beer_type.name }}
                            </div>

                            <div class="text-center text-muted">
                                <i class="fa fa-beer badge-warning"></i> Barril: {{ tap.keg.name }}
                            </div>

                            <div class="text-center text-muted">
                                <i class="fa fa-refresh badge-info" alt="Última Atualização" title="Última Atualização"></i> {{ tap.keg.last_synchronization }}
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <div class="row clearfix">
                            <div class="col-2 text-center">
                                <a :href="addalerturl + '/' + tap.keg.slug" class="open-modal" alt="Alertas" title="Alertas">
                                    <i class="fa fa-bell font-22 badge-warning"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" v-else>
                    <div class="header">
                        <h2 class="mt-3">{{ tap.name }}</h2>
                    </div>
                    <div class="body ribbon text-center">
                        <div class="ribbon-box red" v-if="tap.mililiters == 0">
                            <i class="fa fa-close"></i>
                        </div>
                        <div class="mt-4">
                            <a>
                                <img class="img-thumbnail" :src="tap.image" alt="Nível" width="100">
                            </a>
                        </div>

                        <h3 class="mb-0 mt-3 font300">{{ tap.mililiters }}L</h3>
                        <small>
                            <span class="text-green font-15">0% consumido</span>
                        </small>
                        <div class="mt-4">
                            <div class="text-center text-muted">
                                <i class="fa fa-beer badge-warning"></i> S/N
                            </div>

                            <div class="text-center text-muted">
                                <i class="fa fa-beer badge-warning"></i> Barril: S/N
                            </div>

                            <div class="text-center text-muted">
                                <i class="fa fa-refresh badge-info" alt="Última Atualização" title="Última Atualização"></i> S/N
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { http } from '../../config';
    import AttrKegToTap from "../AttrKegToTap/AttrKegToTap.vue";

    export default {

        props: [
            'tapscollection',
            'url',
            'urlkegedit',
            'urlreleasetap',
            'assignkegurl',
            'getpinurl',
            'addalerturl'
        ],

        components: {
            AttrKegToTap
        },

        created() {

            setInterval(this.getInfoTaps, 30000);

        },

        data() {

            return {
                taps: JSON.parse(this.tapscollection),
                image_keg: null
            }
        },

        methods: {
            getLevelTapInfo: function (tap) {
                return parseFloat(tap.mililiters) >= parseFloat(tap.keg.capacity);
            },

            getInfoTaps: async function () {
                const response = await http.get(this.url);
                if(response.data) {
                    this.taps = response.data.taps;
                }
            }
        }


    };
</script>
