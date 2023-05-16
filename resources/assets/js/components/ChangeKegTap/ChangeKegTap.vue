<template>
    <div class="card">
        <div class="body">
            <a href="javascript:void(0);" data-toggle="modal" data-target=".modal-change-keg">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-info text-white rounded-circle">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <div class="ml-4">
                        <span>Trocar Barril</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="modal fade modal-change-keg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            <i class="fa fa-database font-22 badge-warning"></i> Pin Atual: {{ keg.pin_keg }} - {{ tap.name }}
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form>
                        <div class="modal-body">
                            <div class="row text-center">
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
                                    <h4 class="font-30 font-weight-bold text-col-blue">{{ keg.name }}</h4>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Trocar barril para</label>
                                        <select v-model="pin_to" class="form-control custom-select" @change="checkKeg($event)">
                                            <option value="0">{{ pin_to_placeholder }}</option>
                                            <option v-for="pin in pins"
                                                    :value="pin.pin_keg"
                                            >
                                                {{ pin.pin_keg }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Barril terminou?</label>
                                        <select v-model="barrel_finished" class="form-control">
                                            <option value="selecione">Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Fechar</button>
                            <button class="btn btn-round btn-primary" :disabled="show_submit_button" @click="changeKeg($event)">Trocar barril</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import { http } from '../../config';

    export default {
        props: ['tapprop', 'kegprop', 'url', 'getpinurl'],

        mounted() {
            this.getPins();
        },

        data() {
            return {
                tap: JSON.parse(this.tapprop),
                keg: JSON.parse(this.kegprop),
                pin_to: 0,
                pins: null,
                pin_to_placeholder: "Informe o pin do barril",
                show_submit_button: false,
                barrel_finished: 'selecione'
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

            checkKeg: function(event) {

                if(this.pin_to == this.keg.pin_keg) {
                    this.show_submit_button = true;
                    return;
                }

                this.show_submit_button = false;
            },

            changeKeg:  async function(event) {
                event.preventDefault();

                if(this.barrel_finished == 'selecione') {
                    this.$swal('Atenção!', 'Informe se o barril terminou', 'warning');
                    return false;
                }

                if(this.pin_to == 0) {
                    this.$swal('Atenção!', 'Informe o barril', 'warning');
                    return false;
                }

                this.$swal.fire({
                    title: 'Atenção',
                    text: "Você deseja realmente executar essa ação?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, eu quero!'
                }).then(async (result) => {
                    if (result.value) {

                        const data = {
                            pin_keg: this.pin_to,
                            tap_id: this.tap.id,
                            barrel_finished: this.barrel_finished
                        };

                        const response = await http.post(this.url, data);
                        console.log(response);
                        if(!response.data.status) {
                            this.$swal('Atenção!', response.data.message, 'warning');
                            return false;
                        }

                        this.$swal('Sucesso!', response.data.message, 'success');


                        window.history.pushState({},"", response.data.route);
                        location.reload();
                        return true;
                    }
                })


            }
        },
    };
</script>
