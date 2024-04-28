<template>
        <div class="center-content bg-deep-purple" style="width: 100%">
            <v-card class="mx-auto" max-width="344" title="Registracia">
                <v-container>
                    <v-text-field
                        v-model="first"
                        color="primary"
                        label="Meno"
                        variant="underlined"
                    ></v-text-field>

                    <v-text-field
                        v-model="last"
                        color="primary"
                        label="Priezvisko"
                        variant="underlined"
                    ></v-text-field>

                    <v-text-field
                        v-model="email"
                        color="primary"
                        label="E-mail"
                        variant="underlined"
                    ></v-text-field>

                    <v-text-field
                        v-model="password"
                        color="primary"
                        label="Heslo"
                        placeholder="Enter your password"
                        variant="underlined"
                        type="password"
                    ></v-text-field>
                </v-container>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <div v-if="failed_register">Registracia bola neuspesna!</div>
                    <v-btn color="success" @click="saveForm">
                        Register
                        <v-icon icon="mdi-chevron-right" end></v-icon>
                    </v-btn>

                </v-card-actions>
            </v-card>
        </div>
</template>
<style>
.center-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding-top:50px; padding-bottom: 50px;
}
</style>
<script>
import axios from 'axios';

export default {
    data: () => ({
        first: null,
        last: null,
        email: null,
        password: null,
        failed_register: false
    }),
    methods: {
        saveForm() {
            axios.post('/api/register', {
                name: this.first,
                last_name: this.last,
                email: this.email,
                password: this.password
            }).then(() => {
                console.log('Successfully registered!');
                alert("Uspesna registracia!");
                this.$router.push({name: "login"});
            }).catch((error) => {
                console.log("Registration was not successful!");
                this.failed_register=true;
            })
        }
    }
}
</script>
