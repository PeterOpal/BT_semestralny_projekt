<template>
    <Navigation></Navigation>
    <div class="center-content" style="width: 100%">
        <v-sheet class="pa-12" style="background-color: #004953" rounded>
            <v-card class="mx-auto px-6 py-8 text-center" max-width="344" title="Prihlasenie">
                <v-form v-model="form" @submit.prevent="onSubmit">
                    <v-text-field
                        v-model="email"
                        :readonly="loading"
                        :rules="[required]"
                        class="mb-2"
                        label="Email"
                        clearable
                    ></v-text-field>

                    <v-text-field
                        v-model="password"
                        :readonly="loading"
                        :rules="[required]"
                        label="Password"
                        placeholder="Zadajte Vase heslo"
                        clearable
                        type="password"
                    ></v-text-field>

                    <br/>

                    <v-btn
                        :disabled="!form"
                        :loading="loading"
                        color="success"
                        size="large"
                        type="submit"
                        variant="elevated"
                        block
                    >
                        Sign in
                    </v-btn>
                    <div class="text-center pt-5" style="color: red;" v-if="this.failed_login">Nespravne
                        udaje!
                    </div>
                </v-form>
            </v-card>
        </v-sheet>
    </div>
</template>
<style>
.center-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<script>
import axios from 'axios';
import Navigation from '../components/Navigation.vue';
export default {
    components: {
        Navigation
    },
    data() {
        return {
            email: null,
            password: null,
            loading: false,
            failed_login: false
        };
    },
    methods: {
        onSubmit() {
            if (!this.email || !this.password) {
                console.log('Email and Password are required');
                return;
            }
            this.loading = true;
            this.loginUser();
        },
        loginUser() {
            axios.post('/api/login', {
                email: this.email,
                password: this.password
            }).then(() => {
                this.$router.push({name: "Dashboard"});
            }).catch((error) => {
                console.log("Login was not successful!");
                this.failed_login = true;
                console.log(error);
            }).finally(() => {
                this.loading = false;
            });
        }
    },
}
</script>
