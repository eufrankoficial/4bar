<template>

    <div class="card">
        <div class="body">
            <a href="javascript:void(0);" data-toggle="modal" data-target=".modal-out-keg">
                <div class="d-flex align-items-center">
                    <div class="icon-in-bg bg-danger text-white rounded-circle">

                        <i class="fa fa-sign-out"></i>
                    </div>
                    <div class="ml-4">
                        <span>Coleta rápida</span>
                        <h4 class="mb-0 font-weight-medium">{{ currentkeg.volume_available }}L</h4>
                    </div>
                </div>
            </a>
        </div>

        <out-keg-register :currentkeg="currentkeg" :url="url"></out-keg-register>
    </div>

</template>

<script>

    import OutKegRegister from "../OutKegRegister/OutKegRegister.vue";

    export default {
        props: ['keg', 'url'],

        components: {
            OutKegRegister,
        },
        data () {
            return {
                open: false,
                currentkeg: JSON.parse(this.keg)
            }
        }
    };
</script>
