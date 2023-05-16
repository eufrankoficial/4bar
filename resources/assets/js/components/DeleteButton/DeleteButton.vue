<template>
    <a href="javascript:void(0)" class="btn btn-sm btn-default" data-type="confirm" @click="deleteRecord($event)">
        <i class="fa fa-trash text-white"></i> Delete
    </a>
</template>

<script>

    import { http } from '../../config';

    export default {
        props: ['url'],

        data() {
            return {};
        },


        methods: {

            deleteAction: async function() {
                await http.get(this.url);
            },


            deleteRecord: function (event) {

                this.$swal.fire({
                    title: 'Tem certeza?',
                    text: 'Essa ação não poderá ser desfeita.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        this.deleteAction();

                        this.$swal.fire(
                            'Excluído!',
                            'Excluído com sucesso',
                            'success'
                        );
                        event.target.parentElement.parentElement.remove();
                        return true;

                    } else {
                        this.$swal.fire(
                            'Cancelado',
                            'Seu registro está a salvo',
                            'error'
                        );

                        return false;
                    }
                })
            }
        }

    };
</script>
