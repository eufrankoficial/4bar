<template>
    <div class="modal fade modal-attr-keg-tap" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="fa fa-database font-22 badge-warning"></i> Atribuir barril a torneira
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="row text-center" v-if="show_keg_info">
                            <div class="col-4 border-right pb-4 pt-4">
                                <label class="mb-0">Capacidade</label>
                                <h4 class="font-30 font-weight-bold text-col-blue">{{ keg.capacity }}L</h4>
                            </div>
                            <div class="col-4 pb-4 pt-4">
                                <label class="mb-0">Volume disponível</label>
                                <h4 class="font-30 font-weight-bold text-col-blue">{{ keg.volume_available }}L</h4>
                            </div>
                            <div class="col-4 pb-4 pt-4">
                                <label class="mb-0">Cerveja</label>
                                <h4 class="font-30 font-weight-bold text-col-blue">{{ keg.beer_type.name }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <select v-model="pin_keg" class="form-control custom-select" @change="getKegInfo($event)">
                                        <option value="0">{{ placeholder }}</option>
                                        <option v-for="pin in pins"
                                                :value="pin.pin_keg"
                                        >
                                            {{ pin.pin_keg }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Fechar</button>
                        <button class="btn btn-round btn-primary" v-show="show_get_keg" @click="getKegInfo($event)">Buscar barril</button>
                        <button class="btn btn-round btn-primary" v-show="show_submit" @click="attrKegToTap($event)">Atribuir barril</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import { http } from '../../config';

    export default {
        props: ['getpinurl', 'tap', 'assignkegurl'],


        mounted() {
            this.getPins();
        },


        data() {
            return {
                show_keg_info: false,
                keg: null,
                pin_keg: 0,
                show_submit: false,
                show_get_keg: true,
                pins: null,
                placeholder: 'Informe o pin do barril que quer atribuir a essa torneira'
            }
        },

        methods: {

            getPins: async function() {
                await http.get(this.getpinurl).then(response => {
                    if(response.data.status) {
                        this.pins = response.data.pins;
                    }
                });
            },


            getKegInfo: async function(event) {
                event.preventDefault();
                const response = await http.get(this.getpinurl + '/' + this.pin_keg).then(response => {
                    if(response.data.status) {
                        this.keg = response.data.keg;
                        this.show_keg_info = true;
                        this.show_get_keg = false;
                        this.show_submit = true;
                        return true;
                    }

                    this.$swal('Atenção!', response.data.message, 'warning');
                }).catch(error => {
                    this.$swal('Atenção!', 'Barril inválido', 'warning');
                    return false;
                });
            },

            attrKegToTap: async function(event) {
                event.preventDefault();

                const data = {
                    keg_id: this.keg.id
                };

                if(this.pin_keg == 0) {
                    this.$swal('Atenção!', 'Informe o barril', 'warning');
                    return false;
                }

                const url = this.assignkegurl + '/' + this.tap.slug + '/' + this.keg.slug;
                const response = await http.post(url, data);

                if(!response.data.status) {
                    this.$swal('Atenção!', response.data.message, 'warning');
                    return false;
                }

                this.$swal('Sucesso!', 'Barril atribuído com sucesso', 'success');

                window.history.pushState({},"", response.data.route);
                location.reload();

            }
        }
    };
</script>
