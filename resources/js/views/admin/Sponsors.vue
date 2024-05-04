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
                    <v-btn elevated @click="$router.go(-1)">naspat</v-btn>|
                    <v-app-bar-title>Sponsors</v-app-bar-title>
                </v-app-bar>
            </v-layout>
        </v-card>
    </v-container>

    <v-table>
        <thead>
        <tr>
            <th class="text-center">
                Link
            </th>
            <th class="text-center">
                Image
            </th>
            <th class="text-center">
                Edit
            </th>
            <th class="text-center">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in sponsors" :key="item.id">
            <td class="text-center">{{ item.link }}</td>
            <td class="text-center"><img width="100" height="100" :src="'data:image/jpeg;base64,' + item.photo" alt="sponsor"/></td>
            <td class="text-center"><v-btn @click="editItem(item)">Edit {{ item.id }}</v-btn></td>
            <td class="text-center"><v-btn @click="deleteSponsor(item.id)">Delete</v-btn></td>
        </tr>
        </tbody>
    </v-table>


    <!-- Edit -->
    <v-dialog v-model="editModal" max-width="500">
        <v-card>
            <v-card-title>Edit Sponsor</v-card-title>
            <v-card-text>
                <v-text-field v-model="selectedItem.link" label="Link"></v-text-field>
                <img width="100" height="100" :src="'data:image/jpeg;base64,' + selectedItem.photo" alt="sponsor"/>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="update">Update</v-btn>
                <v-btn @click="editModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!-- Add -->
    <div class="text-center mt-16">
    <v-dialog v-model="addModal" max-width="500">
        <template v-slot:activator="{ on }">
            <v-btn color="primary" dark v-on="on" @click="addModal=true">Pridat sponzora</v-btn>
        </template>
        <v-card>
            <v-card-title>Pridat sponzora</v-card-title>
            <v-card-text>
                <v-text-field v-model="newSponsor.link" label="Link na website"></v-text-field>
            </v-card-text>
            <v-file-input
                label="Obrazok sponzora *max 65kB"
                counter
                show-size
                style="width: 450px; margin-left: 20px;"
                @change="nahratObrazok"
            ></v-file-input>
            <v-card-actions>
                <v-btn color="primary" @click="addSponsor">Pridat</v-btn>
                <v-btn @click="addModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            sponsors: [],
            editModal: false,
            addModal: false,
            selectedItem: null,
            newSponsor: {
                link: '',
                photo: null
            }
        };
    },
    mounted() {
        axios.get('/api/sponsors')
            .then(response => {
                this.sponsors = response.data;
            })
            .catch(error => {
                console.error('Error fetching sponsors:', error);
            });
    },
    methods: {
        nahratObrazok(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => { const base64Data = e.target.result.split(',')[1];this.newSponsor.photo = base64Data;};
            reader.readAsDataURL(file);
        },
        editItem(item) {
            this.selectedItem = item;
            this.editModal = true;
        },
        update() {
            this.editModal = false;
            axios.patch(`/api/sponsors/${this.selectedItem.id}`, {
                link: this.selectedItem.link,
                photo: this.selectedItem.photo,
            }).then(response => {}).catch(error => { console.error('Error updating sponsor:', error);});
        },
        deleteSponsor(selectedID){
            axios.delete(`/api/sponsors/${selectedID}`).then(response => { this.sponsors = this.sponsors.filter(item => item.id !== selectedID); })
                .catch(error => {console.error('Error deleting sponsor:', error);});
        },
        addSponsor() {
            this.addModal=false;
            axios.post('api/sponsors', this.newSponsor).then(response => {this.sponsors.push(response.data); this.newSponsor.link = ''; this.newSponsor.photo = null;})
                 .catch(error => {console.error('Error while adding new sponsor:', error);});
        }
    }
};
</script>
