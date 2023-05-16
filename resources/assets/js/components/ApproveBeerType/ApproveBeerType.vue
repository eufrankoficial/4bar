<template>

    <button type="button" class="btn btn-danger mb-2" v-if="!warningEl">
        <span class="sr-only">{{ textEl }}</span>
        <i class="fa fa-heart"></i>
    </button>

    <button type="button" @click="approve($event)" class="btn btn-warning mb-2" v-else>
        <i class="fa fa-warning"></i>
        <span>{{ textEl }}</span>
    </button>
</template>

<script>

    import { http } from '../../config';

    export default {
        props: ['url', 'text', 'warning'],

        data() {
            return {
                warningEl: this.warning,
                textEl: this.text
            };
        },


        methods: {

            sendRequestApprove: async function() {
                await http.get(this.url);
            },

            approve: function (event) {

                this.$swal.fire({
                    title: 'Aprovar esse tipo de cerveja?',
                    text: '',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aprovar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        this.sendRequestApprove();

                        this.warningEl = false;

                        this.$swal.fire(
                            'Aprovado!',
                            'Aprovado com sucesso',
                            'success'
                        );

                    } else {
                        this.$swal.fire(
                            'Cancelado',
                            'A qualquer momento esse tipo pode ser aprovado',
                            'error'
                        )
                    }
                })
            }
        }

    };
</script>
