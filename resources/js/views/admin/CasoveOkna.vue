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
                            <td class="text-center">{{ getCas(program.cas) }}</td>
                            <td class="text-center">{{ program.nazov_prednasky }}</td>
                            <td class="text-center">{{ program.popis }}</td>
                            <td class="text-center">
                                <span v-if="program.speaker">{{ program.speaker.meno }}</span>
                                <span v-else v-html="'<i>Nie je priradeny</i>'"></span>
                            </td>
                            <td class="text-center">
                                <v-btn @click="editItem(program)"><span class="glyphicon glyphicon-pencil"></span></v-btn>
                            </td>
                            <td class="text-center">
                                <v-btn @click="deleteProgram(program.id)"><span class="glyphicon glyphicon-trash"></span></v-btn>
                            </td>
                        </tr>
                        </tbody>
                    </v-table>

                <!-- ADD -->
                <div class="text-center mt-16">
                    <v-dialog v-model="addModal" max-width="500">
                        <template v-slot:activator="{ on }">
                            <v-btn color="primary" dark v-on="on" @click="addModal=true">Pridat prednasku na {{ stage.name }}</v-btn>
                        </template>
                        <v-card>
                            <v-card-title>Pridat prednasku</v-card-title>
                            <v-card-text>
                                <v-text-field disabled label="">{{stage.name}}</v-text-field>
                                <v-select v-model="newProgram.cas" v-if="cas" :items="cas" :item-title="item => `${item.od.split(':')[0]}:${item.od.split(':')[1]} - ${item.do.split(':')[0]}:${item.do.split(':')[1]}`" :item-value="'id'" label="Casovy interval"></v-select>
                                <v-text-field v-model="newProgram.nazov_prednasky" label="Názov predášky"></v-text-field>
                                <v-textarea v-model="newProgram.popis" label="Popis: " ></v-textarea>
                                <v-select v-model="newProgram.speaker_id" v-if="speakers" :items="speakers" :item-title="'meno'" :item-value="'id'" label="Speaker"></v-select>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn color="primary" @click="addProgram(stage.id)">Pridat</v-btn>
                                <v-btn @click="addModal = false">Cancel</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>

                <!-- Edit -->
                <v-dialog v-model="editModal" max-width="500">
                    <v-card>
                        <v-card-title>Edit Sponsor</v-card-title>
                        <v-card-text>
                            <v-text-field disabled label="">{{stage.name}}</v-text-field>
                            <v-select v-if="cas" v-model="selectedItem.cas" :items="cas" :item-title="item => `${item.od.split(':')[0]}:${item.od.split(':')[1]} - ${item.do.split(':')[0]}:${item.do.split(':')[1]}`" :item-value="'id'" label="Casovy interval"></v-select>
                            <v-text-field v-model="selectedItem.nazov_prednasky" label="Názov predášky"></v-text-field>
                            <v-textarea v-model="selectedItem.popis" label="Popis: " ></v-textarea>
                            <v-select v-if="speakers" v-model="selectedItem.speaker_id" :items="speakers" :item-title="item => item.meno || 'Nie je priradeny speaker'"  :item-value="'id'" label="Speaker"></v-select>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="primary" @click="update">Update</v-btn>
                            <v-btn @click="editModal = false">Cancel</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-expansion-panel-text>
        </v-expansion-panel>
    </v-expansion-panels>
    </div>

    <v-app>
        <v-snackbar v-model="showSnackBar" :timeout="2000" color="blue-grey" rounded="pill" :top="true">
            <div class="text-center">{{ msg }}</div>
        </v-snackbar>
    </v-app>
</template>

<script>
import AdminHeader from "../../components/AdminHeader.vue";
import axios from "axios";
import Loading from "../../components/Loading.vue";
import speaker from "../../components/Speaker.vue";

export default {
    computed: {
        speaker() {
            return speaker
        }
    },
    components: {
        Loading,
        AdminHeader
    },
    data() {
        return {
            loading: true,
            editModal: false,
            selectedItem: null,
            stages: [],
            msg: '',
            showSnackBar: false,
            programs: [],
            speakers: [],
            cas: [],
            addModal: false,
            newProgram: {
                stage_id: null,
                cas: null,
                nazov_prednasky: '',
                popis: '',
                speaker_id: null
            }
        };
    },
    mounted() {
        this.fetchStages();
        this.fetchPrograms();
        this.fetchSpeakers();
        this.fetchCas();
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
        fetchCas(){
            axios.get('api/sloty').then(response => {
                this.cas=response.data;
            }).catch(error=>{
               console.error("Error fetching sloty:", error);
            });
        },
        fetchPrograms(){
            axios.get('api/programs').then(response => {
                this.programs = response.data;
            }).catch(error => {
                console.error("Error fetching programs:", error)
            });
        },
        fetchSpeakers(){
            axios.get('api/speakers').then(response => {
                this.speakers = response.data;
            }).catch(error => {
                console.error("Error fetching speakers:", error)
            });
        },
        addProgram(id) {
            this.newProgram.stage_id=id;
            axios.post('api/programs', this.newProgram)
                .then(response => {
                    this.programs.push(response.data);
                    this.addModal = false;
                    this.newProgram = {stage_id: null, stageName: '', cas: null, nazov_prednasky: '', popis: '', speaker_id: null};
                })
                .catch(error => {
                    console.error("Error adding program:", error);
                });
        },
        deleteProgram(selectedID) {
            axios.delete(`api/programs/${selectedID}`).then(response => {
                /*this.msg = 'Removed item!';
                this.showSnackBar = true;*/
                this.programs = this.programs.filter(item => item.id !== selectedID);
            }).catch(error => {console.error('Error deleting program:', error);});
        },
        editItem(item) {
            this.selectedItem = item;
            this.editModal = true;
        },
        filterPrograms(stageID){
            return this.programs.filter(program => program.stage_id === stageID);
        },
        getCas(id){
            const item = this.cas.find(item => item.id === id);
            return `${item.od.split(':')[0]}:${item.od.split(':')[1]} - ${item.do.split(':')[0]}:${item.do.split(':')[1]}`;
        },
        update() {
            this.editModal = false;
            axios.patch(`/api/programs/${this.selectedItem.id}`, {
                data: this.selectedItem
            }).then(response => {
                this.msg = 'Updated: ' + response.data.nazov_prednasky;
                this.selectedItem.speaker.meno=response.data.speaker;
                console.table(response.data);
                this.showSnackBar = true;
            }).catch(error => {
                console.error('Error updating program:', error);
            });
        },
    }
}
</script>
