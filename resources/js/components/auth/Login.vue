<template>
    <div>

        <!-- Spacer -->
        <div class="margin-top-90"></div>
        <!-- Spacer / End-->

        <!-- Page Content
        ================================================== -->
        <div class="container">
            <div class="row">
                <div class="col-xl-5 offset-xl-3">


                    <div class="login-register-page">
                        <!-- Welcome Text -->
                        <div class="welcome-text">
                            <h3>Halaman Login Administrator</h3>
                        </div>
                            
                        <!-- Form -->
                        <form @submit.prevent="authenticate">
                            <div class="input-with-icon-left">
                                <i class="icon-material-baseline-mail-outline"></i>
                                <input type="text" class="input-text with-border" v-model="form.email" placeholder="Email Address" required/>
                            </div>

                            <div class="input-with-icon-left">
                                <i class="icon-material-outline-lock"></i>
                                <input type="password" class="input-text with-border" v-model="form.password" placeholder="Password" required/>
                            </div>

                            <!-- Button -->
                            <input class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" value="Login" />

                            <div class="form-group row" v-if="authError">
                                <p class="error">
                                    {{ authError }}
                                </p>
                            </div>
                        
                        </form>
                         
                    </div>

                </div>
            </div>
        </div>


        <!-- Spacer -->
        <div class="margin-top-70"></div>
        <!-- Spacer / End-->
    </div>
</template>


<script>
    import {login} from '../../helpers/auth';
    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');
                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style scoped>
.error {
    text-align: center;
    color: red;
}
</style>