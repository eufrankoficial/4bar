]<template>
    <div class="ForgotPassword">
        <div class="card forgot-pass">
            <div class="body">
                <p class="lead mb-3"><strong>Oops</strong>,<br> esqueceu a senha?</p>
                <p>Informe seu email para recuperá-la.</p>
                <form class="form-auth-small">
                    <div class="form-group">
                        <input type="email" class="form-control round" id="email" placeholder="Email" v-model="email">
                    </div>
                    <button type="submit" :disabled="disabled" class="btn btn-round btn-primary btn-lg btn-block" @click="recoverLink($event)">
                        {{ buttonName }}
                    </button>
                    <div class="bottom">
                        <span class="helper-text"><a :href="login"> Lembrei minha senha</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import { http } from '../../config';

    export default {
        props: [
            'login',
            'action'
        ],

        data () {
            return {
                disabled: false,
                email: null,
                buttonName: 'Recuperar'
            }
        },

        methods: {
            recoverLink: async function (event) {
                event.preventDefault();

                this.buttonName = 'Aguarde...';
                this.disabled = true;

                if(this.email == null) {
                    this.buttonName = 'Recuperar';
                    this.disabled = false;
                    this.$swal('Atenção!', 'Informe seu email', 'warning');
                    return false;
                }

                const data = {
                    email: this.email
                };

                try {

                    const response = await http.post(this.action, data).then(response => {
                        if(response.data.status) {
                            this.disabled = false;
                            this.$swal('Sucesso!', response.data.message, 'success');

                            return true;
                        }

                    }).catch(error => {
                        this.$swal('Atenção!', 'Usuário bloqueado, entre em contato com seu administrador', 'error');
                    });

                    this.buttonName = 'Recuperar';
                    this.email = '';
                    this.disabled = false;

                } catch (e) {
                    this.disabled = false;
                    this.buttonName = 'Recuperar';
                    this.$swal('Atenção!', 'E-mail inválido, tente novamente.', 'error');
                }
            }
        }
    };
</script>
