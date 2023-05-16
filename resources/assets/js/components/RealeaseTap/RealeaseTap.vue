<template>
    <div class="card">

        <div class="body">
            <a href="javascript:void(0);" @click="realeaseTap($event)">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-warning text-white rounded-circle">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <div class="ml-4">
                        <span>Liberar torneira</span>
                    </div>
                </div>
            </a>
        </div>


    </div>

</template>

<script>
    import { http } from '../../config';

    export default {
        props: ['urlreleasetap'],

        data () {
            return {

            }
        },

        methods: {
            realeaseTap: function(event) {
                event.preventDefault();

                this.$swal.fire({
                    title: 'Atenção',
                    text: "Você deseja realmente liberar torneira?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, eu quero!'
                }).then(async (result) => {
                    if (result.value) {

                        const data = {
                            keg_id: null
                        };

                        const response = await http.post(this.urlreleasetap, data);
                        if(!response.data.status) {
                            this.$swal('Atenção!', response.data.message, 'warning');
                            return false;
                        }

                        this.taps = response.data.taps;
                        this.$swal('Sucesso!', response.data.message, 'success');

                        window.history.pushState({},"", response.data.route);
                        location.reload();
                    }
                })
            }
        }
    };
</script>
