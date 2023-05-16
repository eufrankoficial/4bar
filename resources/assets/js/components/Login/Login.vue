<template>
    <div class="Login">
        <div class="card">
            <div class="body">
                <p class="lead">Entrar na sua conta</p>
                <form class="form-auth-small m-t-20">
                    <div class="form-group">
                        <label for="signin-email" class="control-label sr-only">Email</label>
                        <input type="email" class="form-control round" id="signin-email" v-model="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <label for="signin-password" class="control-label sr-only">Senha</label>
                        <input type="password" class="form-control round" id="signin-password" v-model="password" placeholder="Senha">
                    </div>
                    <div class="form-group clearfix">
                        <label class="fancy-checkbox element-left">
                            <input type="checkbox" v-model="remember">
                            <span>Lembrar-me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block" @click="login($event)">{{ buttonName }}</button>

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
            'linkforgot'
        ],

        data () {
            return {
                email: null,
                password: null,
                remember: true,
                buttonName: 'Entrar'
            }
        },

        methods: {
            login: async function(event) {
                event.preventDefault();

                this.buttonName = 'Aguarde...';

                const credentials = {
                    email: this.email,
                    password: this.password,
                    remember: this.remember
                };

                try {

                    const response = await http.post(this.action, credentials);

                    location.reload();

                } catch (e) {
                    this.buttonName = 'Entrar';
                    this.$swal('Atenção!', 'Credenciais inválidas', 'error');
                }

            }
        }
    };
</script>
