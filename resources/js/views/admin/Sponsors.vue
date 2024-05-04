<template>
    Sponsors

    <v-table>
        <thead>
        <tr>
            <th class="text-left">
                Link
            </th>
            <th class="text-left">
                Image
            </th>
            <th class="text-left">
                Edit
            </th>
            <th class="text-left">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in sponsors" :key="item.id">
            <td>{{ item.link }}</td>
            <td><img width="100" height="100" :src="'data:image/jpeg;base64,' + item.photo" alt="sponsor"/></td>
            <td>
                <v-btn @click="editItem(item)">Edit {{ item.id }}</v-btn>
            </td>
            <td>
                <v-btn @click="deleteSponsor(item.id)">Delete</v-btn>
            </td>
        </tr>
        </tbody>
    </v-table>


    <!-- Edit -->
    <v-dialog v-model="editModal" max-width="500">
        <template v-slot:activator="{ on }">
            <v-btn color="primary" dark v-on="on">Open Modal</v-btn>
        </template>
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

</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            sponsors: [],
            editModal: false,
            selectedItem: null
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
        editItem(item) {
            this.selectedItem = item; 
            this.editModal = true;
        },
        update() {
            axios.patch(`/api/sponsors/${this.selectedItem.id}`, {
                link: this.selectedItem.link,
                photo: this.selectedItem.photo
            }).then(response => {this.editModal = false;}).catch(error => { console.error('Error updating sponsor:', error);});
        },
        deleteSponsor(selectedID){
            axios.delete(`/api/sponsors/${selectedID}`).then(response => { this.sponsors = this.sponsors.filter(item => item.id !== selectedID); })
                .catch(error => {console.error('Error deleting sponsor:', error);});
        }
    }
};
</script>
