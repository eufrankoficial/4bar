<template>
    <div>
        <a href="javascript:void(0);" class="btn btn-sm btn-default" data-toggle="modal" :data-target="target">
            <i class="fa fa-edit tex-white"></i> Editar
        </a>

        <div class="modal fade" :class="classModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            <i class="fa fa-desktop font-22 badge-warning"></i> {{ name }}
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
                                        <label>Sensor</label>
                                        <select class="form-control" v-model="sensor_id">
                                            <option value="">Selecione</option>
                                            <option :value="cold.sensor_id" v-if="cold.sensor !== null">{{ cold.sensor.name }}</option>
                                            <option v-else v-for="sensor in sensors">
                                                {{ sensor.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Capacidade</label>
                                        <input type="number" class="form-control decimal" v-model="capacity">
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
        props: ['sensorsprop', 'postsaveurl', 'coldchamber'],

        created() {
            this.target = '.modal-edit-cold-chamber-' + this.cold.slug,
            this.classModal = 'modal-edit-cold-chamber-' + this.cold.slug,
            this.sensor_id = this.cold.sensor_id;
            this.name = this.cold.name;
            this.capacity = this.cold.capacity;
        },


        data() {
            return {
                capacity: null,
                classModal: null,
                target: null,
                name: null,
                sensor_id: null,
                sensors: JSON.parse(this.sensorsprop),
                cold: JSON.parse(this.coldchamber)
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
