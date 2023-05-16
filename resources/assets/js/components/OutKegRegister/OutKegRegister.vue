<template>
    <div class="modal fade modal-out-keg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle" v-if="show_keg_info">
                        <i class="fa fa-database font-22 badge-warning"></i> {{ keg.name }}
                    </h5>
                    <h5 v-else>
                        <i class="fa fa-database font-22 badge-warning"></i> Saida de barril
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <div class="row text-center" v-if="show_keg_info">
                            <div class="col-6 border-right pb-4 pt-4">
                                <label class="mb-0">Capacidade</label>
                                <h4 class="font-30 font-weight-bold text-col-blue">{{ keg.capacity }}L</h4>
                            </div>
                            <div class="col-6 pb-4 pt-4">
                                <label class="mb-0">Volume disponível</label>
                                <h4 class="font-30 font-weight-bold text-col-blue">{{ keg.volume_available }}L</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    <label>PIN</label>
                                    <input type="text" class="form-control" placeholder="PIN" name="name" v-model="pin" :disabled="keg !== false">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12"  v-if="show_keg_info">
                                <div class="form-group">
                                    <label>Responsável pela coleta</label>
                                    <input type="text" class="form-control" placeholder="Responsável pela coleta" v-model="outbound_name" :disabled="keg.outbound_name">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer" v-if="!collected">
                        <button type="button" class="btn btn-round btn-default" data-dismiss="modal" v-if="!clicked_button">Fechar</button>
                        <button class="btn btn-round btn-primary" @click="save($event)" :disabled="clicked_button">{{ text_button }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import { http } from '../../config';

    export default {
        props: ['currentkeg', 'url'],

        data() {
            return {
                keg: this.currentkeg,
                pin: this.currentkeg.pin_keg,
                show_keg_info: this.currentkeg != 'false' ? true : false,
                outbound_name: this.currentkeg.outbound_name,
                status: 'Collected',
                collected: this.currentkeg.outbound_datetime ? true : false,
                text_button: 'Saída',
                clicked_button: false
            }
        },

        methods: {

            save: async function(event) {
                event.preventDefault();
                this.text_button = 'Aguarde...';
                this.clicked_button = true;

                const data = {
                    outbound_name: this.outbound_name,
                    status: this.status
                };

                const response = await http.post(this.url, data);
                if(response.data.status == true) {

                    this.collected = true;
                    this.$swal.fire(
                        response.data.message,
                        'Seu barril foi coletado com sucesso',
                        'success'
                    )
                }
            }
        }
    };
</script>
