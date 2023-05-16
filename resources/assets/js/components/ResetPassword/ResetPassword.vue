<template>
    <div class="ResetPassword">
        <div class="card">
            <div class="body">
                <p class="lead mb-3"><strong>Recuperar</strong><br> Senha</p>
                <p>Digite sua nova senha</p>
                <form class="form-auth-small">
                    <div class="form-group">
                        <input type="password" class="form-control round" id="password" placeholder="Nova senha" v-model="password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control round" id="repeat-password" placeholder="Repita a senha" v-model="password2">
                    </div>
                    <button type="submit" :disabled="disabled" class="btn btn-round btn-primary btn-lg btn-block" @click="resetPassword($event)">
                        {{ buttonName }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { http } from '../../config';

    export default {
        props: [
            'action',
            'token',
            'login',
            'emailprop'
        ],

        data () {
            return {
                password: null,
                password2: null,
                disabled: false,
                buttonName: 'Definir nova senha'
            }
        },

        methods: {
            resetPassword: async function(event) {
                event.preventDefault();
                this.disabled = true;
                this.buttonName = 'Aguarde..';

                const data = {
                    password: this.password,
                    password_confirmation: this.password2,
                    token: this.token,
                    email: this.emailprop
                };

                try {
                    if(this.comparePassword(this.password, this.password2)) {

                        await http.post(this.action, data).then(response => {
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

                        return true;
                    }

                    this.disabled = false;
                    this.buttonName = 'Definir nova senha';

                    this.$swal('Atenção!', 'Senhas não conferem', 'error');
                } catch (e) {
                    this.$swal('Atenção!', 'Senha deve ter no mínimo 3 caracters. Confira e tente novamente', 'warning');
                }

            },

            comparePassword: function(password, password2) {
                if(password === '' || password2 === '') {
                    return false
                }

                if(password.trim() === password2.trim()) {
                    return true;
                }

                return false;
            }
        }
    };
</script>
