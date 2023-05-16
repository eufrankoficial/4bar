<template>
    <div>
        <form>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control custom-select" v-model="type">
                            <option v-for="(type, index) in types_main" :value="index">{{ type }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6" v-if="type == 1">
                    <div class="form-group">
                        <label>Câmara Fria</label>
                        <select class="form-control custom-select" v-model="cold_chamber_id" @change="resetSelectFields('cold_chamber_id')">
                            <option value="">Selecione</option>
                            <option v-for="chamber in coldChambers" :value="chamber.id">{{ chamber.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6" v-else-if="type == 2">
                    <div class="form-group">
                        <label>Torneira</label>
                        <select class="form-control custom-select" v-model="tap_id" @change="resetSelectFields('tap_id')">
                            <option value="">Selecione</option>
                            <option v-for="tap in taps" :value="tap.id">{{ tap.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6" v-else>
                    <div class="form-group">
                        <label>Dispositivos</label>
                        <select class="form-control custom-select" v-model="device_id" @change="resetSelectFields('device_id')">
                            <option value="">Selecione</option>
                            <option v-for="device in devices" :value="device.id">{{ device.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" class="form-control" placeholder="Título" v-model="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" rows="5" cols="30" v-model="description"></textarea>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12 text-left">
                    <button class="btn btn-primary" @click="save($event)">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { http } from '../../config';

    export default {
        props: ['types', 'coldchambers', 'tapsprop', 'url', 'devicesprop'],

        created() {

        },

        data() {
            return {
                type: 1,
                name: null,
                urlPost: this.url,
                description: null,
                cold_chamber_id: null,
                tap_id: null,
                coldChambers: JSON.parse(this.coldchambers),
                types_main: JSON.parse(this.types),
                taps: JSON.parse(this.tapsprop),
                devices: JSON.parse(this.devicesprop),
                device_id: null
            }
        },

        methods: {
            save: async function(event) {
                event.preventDefault();

                if(!this.validation()) {
                    this.$swal('Atenção!', 'Preencha os campos corretamente', 'warning');
                    return false;
                }

                var data = {
                    name: this.name,
                    tap_id: this.tap_id,
                    cold_chamber_id: this.cold_chamber_id,
                    device_id: this.device_id,
                    description: this.description
                };

                const response = await http.post(this.urlPost, data);
                if(response.data.status) {
                    this.$swal('Sucesso', 'Dados Salvos com sucesso', 'success');
                    this.resetFields();
                    this.setFields(response.data.maintenance);

                    window.history.pushState({},"", response.data.route);
                    location.reload();
                }
            },

            setFields: function(maintenance) {
                this.name = maintenance.name;
                this.description = maintenance.description;
                if(maintenance.cold_chamber_id) {
                    this.cold_chamber_id = maintenance.cold_chamber_id;
                } else if(maintenance.tap_id) {
                    this.tap_id = maintenance.tap_id;
                } else {
                    this.device_id = maintenance.device_id;
                }
            },

            resetFields: function() {
                this.name = null;
                this.description = null;
                this.cold_chamber_id = null;
                this.tap_id = null;
            },

            resetSelectFields: function (field) {

                if(field == 'cold_chamber_id') {
                    this.tap_id = null;
                    this.device_id = null;
                } else if(field == 'tap_id') {
                    this.device_id = null;
                    this.cold_chamber_id = null;
                } else {
                    this.cold_chamber_id = null;
                    this.tap_id = null;
                }
            },

            validation: function() {
                if(!this.name) {
                    return false;
                }

                if(this.cold_chamber_id || this.tap_id || this.device_id) {
                    return true;
                }

                return false;
            }

        }
    };
</script>
