<template>
    <AdminHeader page_name="Časové sloty"></AdminHeader>
    <div v-if="loading">
        <Loading></Loading>
    </div>

    <div v-else>
        <v-table style="margin-top: 50px;">
            <thead>
            <tr>
                <th class="text-center">Od</th>
                <th class="text-center">Do</th>
                <th class="text-center">Update</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in sloty" :key="item.id">
                <td class="text-center">{{ item.od.split(':')[0] }}:{{item.od.split(':')[1] }}</td>
                <td class="text-center">{{ item.do.split(':')[0] }}:{{item.do.split(':')[1]}}</td>
                <td class="text-center">
                    <v-btn @click="editItem(item)"><span class="glyphicon glyphicon-pencil"></span></v-btn>
                </td>
                <td class="text-center">
                    <v-btn @click="deleteItem(item.id)"><span class="glyphicon glyphicon-trash"></span></v-btn>
                </td>
            </tr>
            </tbody>
        </v-table>

        <!-- Add -->
        <div class="text-center mt-16">
            <v-dialog v-model="addModal" max-width="500">
                <template v-slot:activator="{ on }">
                    <v-btn color="primary" dark v-on="on" @click="addModal=true">Pridat casovy slot</v-btn>
                </template>
                <v-card>
                    <v-card-title>Pridat casovy slot</v-card-title>
                    <v-card-text>
                        <v-text-field label="OD" model-value="" type="time" v-model="newSlot.od"></v-text-field>
                        <v-text-field label="DO" model-value="" type="time" v-model="newSlot.do"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="addSlot">Pridat</v-btn>
                        <v-btn @click="addModal = false">Cancel</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>

        <!-- Edit -->
        <v-dialog v-model="editModal" max-width="500">
            <v-card>
                <v-card-text>
                    <v-text-field v-model="selectedItem.od" type="time" label="OD"></v-text-field>
                    <v-text-field v-model="selectedItem.do" type="time" label="DO"></v-text-field>
                </v-card-text>
                <v-card-actions>
                    <v-btn color="primary" @click="update">Update</v-btn>
                    <v-btn @click="editModal = false">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </div>
    <v-app>
        <v-snackbar v-model="showSnackBar" :timeout="2000" color="blue-grey" rounded="pill" :top="true">
            <div class="text-center">{{ msg }}</div>
        </v-snackbar>
    </v-app>
</template>
<script>
import Loading from "../../components/Loading.vue";
import AdminHeader from "../../components/AdminHeader.vue";
import axios from "axios";

export default{
    data(){
        return {
            loading: true,
            sloty: [],
            addModal: false,
            time: '',
            newSlot: {
                od: '',
                do: ''
            },
            msg: "",
            showSnackBar: false,
            editModal: false,
            selectedItem: null,
        }
    },
    mounted() {
        this.fetchSloty();
    },
    methods: {
      fetchSloty(){
          axios.get('api/sloty').then(response => {
              this.sloty = response.data;
              this.loading = false;
          }).catch(error => {
              console.error('Error fetching stages:', error)
          });
        },

        addSlot() {
            if(this.newSlot.od==='' || this.newSlot.do===''){
                this.msg = 'Nemate nastavene spravne policka, zaznam nebude ulozeny!';
                this.showSnackBar = true;
                return;
            }
            this.addModal = false;
            axios.post('api/sloty', this.newSlot).then(response => {
                this.msg = 'Succesfully added new time interval!';
                this.showSnackBar = true;
                this.sloty.push(response.data);
                this.sloty.od = '';
                this.sloty.do = '';
            })
                .catch(error => {
                    this.msg = 'Error while adding a new slot:' + error;
                    this.showSnackBar = true;
                });
        },
        deleteItem(id) {
            axios.delete(`/api/sloty/${id}`).then(response => { this.sloty = this.sloty.filter(item => item.id !== id); this.msg="Deleted time interval!"; this.showSnackBar=true;})
                .catch(error => {this.msg="Error while deleting: "+error; this.showSnackBar=true;});
        },
        editItem(item) {
            this.selectedItem = item;
            this.editModal = true;
        },
        update() {
            this.editModal = false;
            axios.patch(`/api/sloty/${this.selectedItem.id}`, {
                data: this.selectedItem
            }).then(response => {
                this.msg = 'Updated time slot';
                this.showSnackBar = true;
            }).catch(error => {
                this.msg = 'Error while updating: ' + error;
                this.showSnackBar = true;
            });
        },

    },
    components: {
        Loading, AdminHeader
    }
}
</script>
