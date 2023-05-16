<template>
    <div class="col-lg-5 col-md-5">
        <div class="form-group">
            <label>CNPJ</label>
            <input type="text" v-model="cpf_cnpj" class="form-control cnpj_cpf" :class="errorField ? 'parsley-error' : ''" placeholder="CPF/CNPJ" name="cpf_cnpj">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['value', 'error'],

        data() {
            return {
                cpf_cnpj: this.value !== 'false' ? this.value : null,
                errorField: this.error
            }
        }
    };
</script>
