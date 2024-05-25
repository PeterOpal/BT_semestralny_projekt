<template>
    <AdminHeader page_name="Časové okná"></AdminHeader>
    <div v-if="loading">
        <Loading></Loading>
    </div>

    <div v-else>
    <v-expansion-panels class="mb-6" style="margin-top: 50px;">
        <v-expansion-panel
            v-for="stage in stages"
            :key="stage.id"
        >
            <v-expansion-panel-title expand-icon="mdi-menu-down">
                <b>{{ stage.name }} - {{stage.datum}}</b>
            </v-expansion-panel-title>
            <v-expansion-panel-text>
                    <v-table>
                        <thead>
                        <tr>
                            <th class="text-center">Cas</th>
                            <th class="text-center">Nazov prednasky</th>
                            <th class="text-center">Popis</th>
                            <th class="text-center">Speaker</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="program in filterPrograms(stage.id)" :key="program.id">
                            <td class="text-center">{{ program.cas }}</td>
                            <td class="text-center">{{ program.nazov_prednasky }}</td>
                            <td class="text-center">{{ program.popis }}</td>
                            <td class="text-center">{{ program.speaker.meno }}</td>
                            <td class="text-center">
                                <v-btn @click="editItem(item)"><span class="glyphicon glyphicon-pencil"></span></v-btn>
                            </td>
                            <td class="text-center">
                                <v-btn @click="deleteItem(item.id)"><span class="glyphicon glyphicon-trash"></span></v-btn>
                            </td>
                        </tr>
                        </tbody>
                    </v-table>
               <!-- make a method which from all of the programs filters with id == actual.id -->
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>
    </div>
</template>

<script>
import AdminHeader from "../../components/AdminHeader.vue";
import axios from "axios";
import Loading from "../../components/Loading.vue";

export default {
    components: {
        Loading,
        AdminHeader
    },
    data() {
        return {
            loading: true,
            stages: [],
            programs: []
        };
    },
    mounted() {
        this.fetchStages();
        this.fetchPrograms();
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
        fetchPrograms(){
            axios.get('api/programs').then(response => {
                this.programs = response.data;
            }).catch(error => {
                console.error("Error fetching programs:", error)
            });
        },
        filterPrograms(stageID){
            return this.programs.filter(program => program.stage_id === stageID);
        }
    }
}
</script>
