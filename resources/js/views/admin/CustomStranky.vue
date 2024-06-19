<template>
    <AdminHeader style="margin-bottom: 50px" page_name="Custom stranky"></AdminHeader>

    <div v-if="loading">
        <Loading></Loading>
    </div>
    <div v-else>
    <v-table>
        <thead>
        <tr>
            <th class="text-center">Nazov stranky</th>
            <th class="text-center">Update</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="stranka in stranky" :key="stranka.id">
            <td class="text-center">{{stranka.nazov_stranky}}</td>
            <td class="text-center">
                <v-btn @click="strankaEdit(stranka.id, stranka.nazov_stranky, stranka.html_kod)"><span class="glyphicon glyphicon-pencil"></span></v-btn>
            </td>
            <td class="text-center">
                <v-btn @click="deleteStranku(stranka.id)"><span class="glyphicon glyphicon-trash"></span></v-btn>
            </td>
        </tr>
        </tbody>
    </v-table>

        <div class="text-center mt-16">
            <v-dialog max-width="500">
                <template v-slot:activator="{ on }">
                    <v-btn color="primary" @click="pridatNovuStranku" dark v-on="on">Pridat novu stranku</v-btn>
                </template>
            </v-dialog>
        </div>
    </div>
</template>
<script>
import AdminHeader from "../../components/AdminHeader.vue";
import Loading from "../../components/Loading.vue";
import axios from "axios";
import router from "../../router";

export default {
    data(){
        return{
            loading: true,
            stranky: [],
        }
    },
    components: {
        Loading,
        AdminHeader,
    },
    mounted(){
        this.fetchStranky();
    },
    methods: {
        fetchStranky() {
            axios.get('api/stranky').then(response => {
                this.stranky = response.data;
                this.loading = false;
            }).catch(error => {
                console.error('Error fetching stranky:', error)
            });
        },
        pridatNovuStranku(){
            router.push({
                name: 'Admin-editor-add',
            });
        },
        strankaEdit(id, stranka, kod){
            router.push({
                name: 'Admin-editor',
                params: {
                    editstranku: true,
                    html_kod: kod,
                    stranka_id: id,
                    nazov_stranky: stranka
                }
            });
        },
        deleteStranku(selectedID) {
            axios.delete(`/api/stranky/${selectedID}`).then(response => {
                this.stranky = this.stranky.filter(item => item.id !== selectedID);
            })
                .catch(error => {
                    console.error('Error deleting webpage:', error);
                });
        },
    }
}
</script>
