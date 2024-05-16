<template>
    <v-container>
    <v-card class="mx-auto" color="grey-lighten-3" max-width="448">
        <v-layout>
            <v-app-bar
                color="teal-darken-4"
            >
                <template v-slot:image>
                    <v-img
                        gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
                    ></v-img>
                </template>

                <v-app-bar-title v-if="user">Vitajte {{ user.name }} {{ user.last_name }}</v-app-bar-title>
                <v-spacer></v-spacer>

                <v-btn icon>
                    <!--<v-icon>mdi-dots-vertical</v-icon>-->
                    <button @click.prevent="logout">Logout</button>
                </v-btn>
            </v-app-bar>
        </v-layout>
    </v-card>
    </v-container>

    <v-container style="padding-top: 50px">
    <v-row dense>
        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                color=""
                max-width="344"
                subtitle="CRUD operácie pre stage"
                title="Stage"
            >
                <template v-slot:actions>
                    <v-btn @click="$router.push({ name: 'Admin-stage' })" text="Stage"></v-btn>
                </template>
            </v-card>
        </v-col>

        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                color=""
                max-width="344"
                subtitle=" CRUD operácie pre časové okná v existujúcich stagoch"
                title="časové okná"
            >
                <template v-slot:actions>
                    <v-btn text="Button"></v-btn>
                </template>
            </v-card>
        </v-col>

        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                color=""
                max-width="344"
                subtitle="CRUD operácie pre profily speakerov - obrázok/krátky popis/dlhý popis/linky na sociálne siete"
                title="profily speakerov"
            >
                <template v-slot:actions>
                    <v-btn text="Button"></v-btn>
                </template>
            </v-card>
        </v-col>

        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                max-width="344"
                subtitle="CRUD operácie pre prednášky k jednotlivým speakrom - krátky popis/dlhý popis"
                title="prednášky k jednotlivým speakrom"
            >
                <template v-slot:actions>
                    <v-btn text="Button"></v-btn>
                </template>
            </v-card>
        </v-col>

        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                max-width="344"
                subtitle="vytvoriť sponzora"
                title="vytvoriť sponzora"
            >
                <template v-slot:actions>
                    <v-btn @click="$router.push({ name: 'Admin-sponsors' })" text="Sponzory"></v-btn>
                </template>
            </v-card>
        </v-col>

        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                max-width="344"
                subtitle="vedieť kto sa na danú konferenciu zaregistroval"
                title="Kto sa zaregistroval"
            >
                <template v-slot:actions>
                    <v-btn text="Button"></v-btn>
                </template>
            </v-card>
        </v-col>

        <v-col cols="3">
            <v-card
                class="mx-auto v-card--outlined"
                max-width="344"
                subtitle=" CRUD operácie nad sekciou Povedali o nás - foto, výrok"
                title="sekcia Povedali o nás"
            >
                <template v-slot:actions>
                    <v-btn @click="$router.push({ name: 'Admin-testimonials' })" text="Testimonials"></v-btn>
                </template>
            </v-card>
        </v-col>

    </v-row>
    </v-container>
</template>

<style>
.v-card--outlined {
    border: 1px solid black !important;
}
</style>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null
        }
    },
    methods: {
        logout() {
            axios.post('api/logout').then(() => {
                this.$router.push({name: "login"});
            })
        },
        async getData(){
            let cachedData = localStorage.getItem('cachedUserData');


          if (cachedData) {
              this.user = JSON.parse(cachedData);
              console.log('cache');
          } else {
            axios.get('api/user')
                .then((res) => {
                    this.user = res.data;
                    //console.log(res.data);
                    localStorage.setItem('cachedUserData', JSON.stringify(res.data));
                })
                .catch((error) => {
                    console.error('Error fetching user data:', error);
                });
        }
        }
    },
    mounted() {
        this.getData();
    }

}
</script>
