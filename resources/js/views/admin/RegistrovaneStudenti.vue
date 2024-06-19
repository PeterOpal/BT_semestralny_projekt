<template>
    <AdminHeader page_name="Registrované študenti"></AdminHeader>

    <div v-if="loading">
        <Loading></Loading>
    </div>
    <div v-else>
        <v-expansion-panels style="margin-top: 50px;">
            <v-expansion-panel
                title="Aktivovane studenti">
                <template v-slot:text>
                    <v-table>
                        <thead>
                        <tr>
                            <th class="text-center">Meno</th>
                            <th class="text-center">Priezvisko</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Datum, cas registracie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="student in activatedStudents" :key="student.id">
                            <td class="text-center">{{ student.meno }}</td>
                            <td class="text-center">{{ student.priezvisko }}</td>
                            <td class="text-center">{{ student.mail }}</td>
                            <td class="text-center">{{ student.created_at }}</td>
                        </tr>
                        </tbody>
                    </v-table>
                </template>
            </v-expansion-panel>
        </v-expansion-panels>
        <v-expansion-panels style="margin-top: 5px;">
            <v-expansion-panel
                title="NEaktivovane studenti"
            >
                <template v-slot:text>
                    <v-table>
                        <thead>
                        <tr>
                            <th class="text-center">Meno</th>
                            <th class="text-center">Priezvisko</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Datum, cas registracie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="student in NONactivatedStudents" :key="student.id">
                            <td class="text-center">{{ student.meno }}</td>
                            <td class="text-center">{{ student.priezvisko }}</td>
                            <td class="text-center">{{ student.mail }}</td>
                            <td class="text-center">{{ student.created_at }}</td>
                        </tr>
                        </tbody>
                    </v-table>
                </template>
            </v-expansion-panel>
        </v-expansion-panels>
    </div>
</template>
<script>
import Loading from "../../components/Loading.vue";
import AdminHeader from "../../components/AdminHeader.vue";
import axios from "axios";

export default {
    components:{
        Loading, AdminHeader
    },
    data(){
        return{
            loading: false,
            students: []
        }
    },
    mounted(){
        this.getData()
    },
    methods:{
        async getData() {
            axios.get('api/students').then(response => {
                this.students = response.data;
                this.loading = false;
                console.table(this.students);
            }).catch(error => {
                console.error('Error fetching students:', error);
            });
        },
    },
    computed:{
        activatedStudents() {
            return this.students.filter(student => student.actived === 1);
        },
        NONactivatedStudents() {
            return this.students.filter(student => student.actived === 0);
        }
    }
}
</script>
