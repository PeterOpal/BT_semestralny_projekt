<template>
    <v-container>
        <v-card class="mx-auto" color="grey-lighten-3" max-width="448">
            <v-layout>
                <v-app-bar
                    color="teal-darken-4"
                    image="https://picsum.photos/1920/1080?random"
                >
                    <template v-slot:image>
                        <v-img
                            gradient="to top right, rgba(19,84,122,.8), rgba(128,208,199,.8)"
                        ></v-img>
                    </template>

                    <v-btn elevated @click="$router.go(-1)">naspat</v-btn>
                    <v-app-bar-title>Stage</v-app-bar-title>
                </v-app-bar>
            </v-layout>
        </v-card>
    </v-container>
</template>
<script>
</script>
