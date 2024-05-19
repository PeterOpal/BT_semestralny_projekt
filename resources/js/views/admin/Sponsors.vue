<template>
    <AdminHeader page_name="Sponsors"></AdminHeader>

    <div v-if="loading">
        <Loading></Loading>
    </div>

    <div v-else>
        <v-table style="margin-top: 50px;">
            <thead>
            <tr>
                <th class="text-center">Link</th>
                <th class="text-center">Image</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in sponsors" :key="item.id">
                <td class="text-center">{{ item.link }}</td>
                <td class="text-center"><img width="120" height="120" :src="'data:image/jpeg;base64,' + item.photo" alt="sponsor"/></td>
                <td class="text-center"><v-btn @click="editItem(item)"><span class="glyphicon glyphicon-pencil"></span></v-btn></td>
                <td class="text-center"><v-btn @click="deleteSponsor(item.id)"><span class="glyphicon glyphicon-trash"></span></v-btn></td>
            </tr>
            </tbody>
        </v-table>


        <!-- Edit -->
        <v-dialog v-model="editModal" max-width="500">
            <v-card>
                <v-card-title>Edit Sponsor</v-card-title>
                <v-card-text>
                    <v-text-field v-model="selectedItem.link" label="Link"></v-text-field>
                    <img width="200" height="200" :src="'data:image/jpeg;base64,' + selectedItem.photo" alt="sponsor"/>
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
    </div>

    <v-app>
        <v-snackbar v-model="showSnackBar" :timeout="2000" color="blue-grey" rounded="pill" :top="true">
            <div class="text-center">{{ msg }}</div>
        </v-snackbar>
    </v-app>
</template>

<script>
import axios from 'axios';
import AdminHeader from "../../components/AdminHeader.vue";
import Loading from "../../components/Loading.vue";

export default {
    components: {Loading, AdminHeader},
    data() {
        return {
            sponsors: [],
            loading: true,
            editModal: false,
            addModal: false,
            selectedItem: null,
            newSponsor: {
                link: '',
                photo: null
            },
            msg: '',
            showSnackBar: false
        };
    },
    mounted() {
        this.getData()
    },
    methods: {
        async getData() {
            try {
                const response = await axios.get('/api/sponsors');
                this.sponsors = response.data;
            } catch (error) {
                console.error('Error fetching sponsors:', error);
            } finally {
                this.loading = false;
            }
        },
        nahratObrazok(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => { const base64Data = e.target.result.split(',')[1];this.newSponsor.photo = base64Data; };
            reader.readAsDataURL(file);
            this.msg='Obrazok je nahraty!';this.showSnackBar=true;
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
            }).then(response => {
                this.msg = 'Updated: ' + response.data.link;
                this.showSnackBar = true;
            }).catch(error => {
                console.error('Error updating sponsor:', error);
            });
        },
        deleteSponsor(selectedID) {
            axios.delete(`/api/sponsors/${selectedID}`).then(response => {
                this.msg = 'Removed item!';
                this.showSnackBar = true;
                this.sponsors = this.sponsors.filter(item => item.id !== selectedID);
            })
                .catch(error => {
                    console.error('Error deleting sponsor:', error);
                });
        },
        addSponsor() {
            this.addModal = false;
            axios.post('api/sponsors', this.newSponsor).then(response => {
                this.msg = 'Succesfully added:' + response.data.link;
                this.showSnackBar = true;
                this.sponsors.push(response.data);
                this.newSponsor.link = '';
                this.newSponsor.photo = null;
            })
                .catch(error => {
                    console.error('Error while adding new sponsor:', error);
                });
        }
    }
};
</script>
