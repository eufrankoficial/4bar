<template>
    <div class="col-md-6 col-sm-12">
        <div class="text-right">
            <a href="javascript:void(0);" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-add-cold-chamber">
                <i class="icon-plus"></i> Adicionar
            </a>
        </div>


        <div class="modal fade modal-add-cold-chamber" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                <i class="fa fa-desktop font-22 badge-warning"></i> Nova Câmara Fria
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Sensores</label>
                                            <select class="form-control custom-select" v-model="sensor_id">
                                                <option value="">Escolha</option>
                                                <option v-for="sensor in sensors" :value="sensor.id">{{ sensor.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Capacidade</label>
                                            <input type="number" class="form-control decimal"  v-model="capacity">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" v-model="name">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-round btn-primary" @click="save($event)">Salvar</button>
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
        props: ['sensorsprop', 'postsaveurl'],

        data() {
            return {
                capacity: null,
                name: null,
                sensor_id: null,
                sensors: JSON.parse(this.sensorsprop),
            }
        },

        methods: {

            save: async function(event) {
                event.preventDefault();

                if(!this.validate()) {
                    this.$swal.fire(
                        'Atenção',
                        'Informe o nome da camara fria',
                        'warning'
                    );
                    return false;
                }

                const data = {
                    capacity: this.capacity,
                    name: this.name,
                    sensor_id: this.sensor_id
                };

                const response = await http.post(this.postsaveurl, data).then(response => {
                    if(response.data.status) {
                        this.$swal('Sucesso!', response.data.message, 'success');

                        window.history.pushState({},"", response.data.route);
                        location.reload();

                        return true;
                    }
                }).catch(error => {
                    console.log(error);
                    this.$swal('Atenção!', error.data.message, 'error');
                    return false;
                });
            },

            validate: function() {
                if(this.name == '') {
                    return false;
                }

                return true;
            }
        }
    };
</script>
