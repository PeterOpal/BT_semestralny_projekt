<template>
    <AdminHeader page_name="Testimonials"></AdminHeader>
    <div v-if="loading">
        <Loading></Loading>
    </div>

    <div v-else>
    <v-table style="margin-top: 50px;">
        <thead>
        <tr>
            <th class="text-center">Photo</th>
            <th class="text-center">Person</th>
            <th class="text-center">Opinion</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in testimonials" :key="item.id">
            <td class="text-center">
                <img width="70" height="70" :src="'data:image/jpeg;base64,' + item.photo" alt="testimonial"/>
            </td>
            <td class="text-center">{{ item.person }}</td>
            <td class="text-center">{{ item.description }}</td>
            <td class="text-center">
                <v-btn @click="editItem(item)">
                    <span class="glyphicon glyphicon-pencil"></span>
                </v-btn>
            </td>
            <td class="text-center">
                <v-btn @click="deleteTestimonial(item.id)">
                    <span class="glyphicon glyphicon-trash"></span>
                </v-btn>
            </td>
        </tr>
        </tbody>
    </v-table>

    <v-dialog v-model="editModal" max-width="500">
        <v-card>
            <v-card-title>Edit Testimonial</v-card-title>
            <v-card-text>
                <v-text-field v-model="selectedItem.person" label="Link"></v-text-field>
                <v-textarea label="Opinion: " v-model="selectedItem.description" variant="underlined"></v-textarea>
                Obrazok: <br>
                <img width="70" height="70" :src="'data:image/jpeg;base64,' + selectedItem.photo" alt="testimonial"/>
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
                <v-btn color="primary" dark v-on="on" @click="addModal=true">Pridat testimonial</v-btn>
            </template>
            <v-card>
                <v-card-title>Pridat testimonial</v-card-title>
                <v-card-text>
                    <v-text-field v-model="newTestimonial.person" label="Person: "></v-text-field>
                </v-card-text>
                <v-card-text>
                <v-textarea label="Opinion: " v-model="newTestimonial.description" variant="underlined"></v-textarea>
                </v-card-text>
                <v-file-input
                    label="Obrazok *max 65kB"
                    counter
                    show-size
                    style="width: 450px; margin-left: 20px;"
                    @change="nahratObrazok"
                ></v-file-input>
                <v-card-actions>
                    <v-btn color="primary" @click="add">Pridat</v-btn>
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
            testimonials: [],
            loading: true,
            editModal: false,
            addModal: false,
            selectedItem: null,
            newTestimonial: {
                photo: null,
                person: '',
                description: ''
            },
            msg: '',
            showSnackBar: false
        };
    },
    mounted() {
        this.fetchTestimonials();
    },
    methods: {
        fetchTestimonials() {
            axios.get('api/testimonials').then(response => {
                    this.testimonials = response.data;
                    this.loading = false;
                }).catch(error => {console.error('Error fetching testimonials:', error)});
        },
        update() {
            this.editModal = false;
            axios.patch(`/api/testimonials/${this.selectedItem.id}`, {
                person: this.selectedItem.person,
                photo: this.selectedItem.photo,
                description: this.selectedItem.description
            }).then(response => { this.msg="Updated successfully: " + this.selectedItem.person; this.showSnackBar=true; }).catch(error => {  this.msg="Error while updating: "+error; this.showSnackBar=true;});
        },
        deleteTestimonial(id) {
            axios.delete(`/api/testimonials/${id}`).then(response => { this.testimonials = this.testimonials.filter(item => item.id !== id); this.msg="Deleted item!"; this.showSnackBar=true;})
                 .catch(error => {console.error('Error deleting testimonial:', error);});
        },
        editItem(item) {
            this.selectedItem = item;
            this.editModal = true;
        },
        nahratObrazok(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => { const base64Data = e.target.result.split(',')[1];this.newTestimonial.photo = base64Data; console.log(base64Data)};
            reader.readAsDataURL(file);
        },
        add() {
            this.addModal=false;
            axios.post('api/testimonials', this.newTestimonial).then(response => {this.testimonials.push(response.data); this.newTestimonial.person = ''; this.newTestimonial.description='';this.newTestimonial.photo = null;})
                .catch(error => {console.error('Error while adding new testimonial:', error);});
        }
    }
};
</script>
