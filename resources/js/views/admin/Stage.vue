<template>
    <AdminHeader page_name="Stage"></AdminHeader>
    <div v-if="loading">
        <Loading></Loading>
    </div>

    <div v-else>
        <v-table style="margin-top: 50px;">
            <thead>
            <tr>
                <th class="text-center">Nazov</th>
                <th class="text-center">Datum</th>
                <th class="text-center">Kapacita</th>
                <th class="text-center">Update</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in stages" :key="item.id">
                <td class="text-center">{{ item.name }}</td>
                <td class="text-center">{{ item.datum }}</td>
                <td class="text-center">{{ item.kapacita }}</td>
                <td class="text-center">
                    <v-btn @click="editItem(item)"><span class="glyphicon glyphicon-pencil"></span></v-btn>
                </td>
                <td class="text-center">
                    <v-btn @click="deleteItem(item.id)"><span class="glyphicon glyphicon-trash"></span></v-btn>
                </td>
            </tr>
            </tbody>
        </v-table>

        <!-- Edit -->
        <v-dialog v-model="editModal" max-width="500">
            <v-card>
                <v-card-title>Edit stage: {{selectedItem.name}}</v-card-title>
                <v-card-text>
                    <v-text-field v-model="selectedItem.name" label="Name"></v-text-field>
                    <v-text-field v-model="selectedItem.datum" label="Datum"></v-text-field>
                    <v-text-field v-model="selectedItem.kapacita" label="Kapacita" type="number"></v-text-field>
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
                    <v-btn color="primary" dark v-on="on" @click="addModal=true">Pridat stage</v-btn>
                </template>
                <v-card>
                    <v-card-title>Pridat stage</v-card-title>
                    <v-card-text>
                        <v-text-field v-model="newStage.name" label="Nazov"></v-text-field>
                        <v-text-field v-model="newStage.datum" label="Datum"></v-text-field>
                        <v-text-field v-model="newStage.kapacita" label="Kapacita" type="number"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="addStage">Pridat</v-btn>
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
import axios from "axios";
import Loading from "../../components/Loading.vue";
import AdminHeader from "../../components/AdminHeader.vue";

export default {
    components: {AdminHeader, Loading},
    data() {
        return {
            msg: "",
            showSnackBar: false,
            loading: true,
            stages: [],
            editModal: false,
            addModal: false,
            selectedItem: null,
            newStage: {
                name: '',
                datum: '',
                kapacita: ''
            },
        }
    },
    mounted() {
        this.fetchStages();
    },
    methods: {
        fetchStages() {
            axios.get('api/stages').then(response => {
                this.stages = response.data;
                this.loading = false;
            }).catch(error => {
                console.error('Error fetching stages:', error)
            });
        },
        editItem(item) {
            this.selectedItem = item;
            this.editModal = true;
        },
        update() {
            this.editModal = false;
            axios.patch(`/api/stages/${this.selectedItem.id}`, {
                name: this.selectedItem.name,
                datum: this.selectedItem.datum,
                kapacita: this.selectedItem.kapacita,
            }).then(response => {
                this.msg = 'Updated: ' + response.data.name;
                this.showSnackBar = true;
            }).catch(error => {
                this.msg = 'Error while updating: ' + error;
                this.showSnackBar = true;
            });
        },
        deleteItem(id) {
            axios.delete(`/api/stages/${id}`).then(response => { this.stages = this.stages.filter(item => item.id !== id); this.msg="Deleted item!"; this.showSnackBar=true;})
                .catch(error => {this.msg="Error while deleting: "+error; this.showSnackBar=true;});
        },
        addStage() {
            this.addModal = false;
            axios.post('api/stages', this.newStage).then(response => {
                this.msg = 'Succesfully added:' + response.data.name;
                this.showSnackBar = true;
                this.stages.push(response.data);
                this.newStage.name = '';
                this.newStage.kapacita = '';
                this.newStage.datum = '';
            })
                .catch(error => {
                    this.msg = 'Error while adding a new stage:' + error;
                    this.showSnackBar = true;
                });
        }
    }
}
</script>
