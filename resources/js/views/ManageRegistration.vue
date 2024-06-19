<template>
    <div class="text-center">
        <div>
            <img :src="'images/nconnect-logo.png'" height="100" width="150" alt="logo"/>
            <h2>Managovat registraciu</h2>
            <div v-if="student.was_activated===0">
                <span style="font-weight: bolder; font-size: 20px; color: green;">Uspesne si aktivoval svoje miesto na nConnect!</span><br>
                <span style="color: red">{{student.increment_msg}}</span>
            </div>
            <v-container>
            <v-btn class="mt-2 mx-auto" @click="zrusitRegistraciu" block color="red" style="min-width: 20% !important;">Zrusit registraciu!</v-btn></v-container>
        </div>
        <div v-if="loading[0]==true || loading[1]==true">
            <Loading></Loading>
        </div>
        <div v-else>
        <v-sheet class="mx-auto" width="400" style="padding-top: 20px; padding-bottom: 50px">
            <v-form>
                <v-text-field
                    label="Meno"
                    v-model="student.student.meno"
                    disabled
                ></v-text-field>
                <v-text-field
                    label="Priezvisko"
                    v-model="student.student.priezvisko"
                    disabled
                ></v-text-field>
                <v-text-field
                    label="E-mail"
                    v-model="student.student.mail"
                    disabled
                ></v-text-field>
                <template>
                    <v-text-field
                        label="Skola"
                        disabled
                    ></v-text-field>
                </template>
                <v-container v-if="selectedProgram">
                    <v-row v-for="(programGroup, _id) in groupedPrograms" :key="_id" class="my-4">
                        <v-col cols="12">
                            <label>Prednaska {{ programGroup[0].sloty.od.split(":")[0] }}:{{ programGroup[0].sloty.od.split(":")[1] }}-{{ programGroup[0].sloty.do.split(":")[0] }}:{{ programGroup[0].sloty.do.split(":")[1] }} </label>
                            <v-select
                                :items="[{'nazov_prednasky':'žiadna', 'id': -1}, ...programGroup]"
                                item-title="nazov_prednasky"
                                item-value="id"
                                :value="needToSelect(programGroup)"
                                outlined
                                disabled
                            ></v-select>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-sheet>
        </div>
    </div>
</template>
<script>
import {useProgramStore} from "../stores/programStore";
import axios from "axios";
import Loading from "../components/Loading.vue";

export default {
    components: {Loading},
    data(){
        return{
            programs: [],
            student: [],
            selectedProgram: [],
            selectedProgramsModel: -1,
            loading: [true, true],
            token: ''
        }
    },
    created() {
        this.fetchPrograms();
        const token = this.$route.query.token;
        this.token=token;

        if (token) {
            this.fetchStudentData(token);
        } else {
           alert('Token is missing from the URL.');
        }
    },
    methods: {
        async fetchPrograms() {
            try {
                const programStore = useProgramStore();
                if (programStore.program.length === 0) await programStore.fetchPrograms();
                this.programs = programStore.program;
            } catch (error) {
                console.error('Error fetching programs:', error);
            } finally {
                this.loading[0] = false;
            }
        },
        async fetchStudentData(token){
            axios.get('api/student-data/'+token).then(response => {
                this.student = response.data;
                this.fillSelectedPrograms();
                this.loading[1]= false;
            }).catch(error => {
                alert(error.response.data.msg);
                console.error('Error fetching student data:', error);
            });
        },
        zrusitRegistraciu(){
            axios.post('api/student-data/'+this.token).then(response => {
                alert(response.data.msg);
            }).catch(error => {
                alert("Skuste neskor, nevedeli sme zrusit registraciu!");
            });
        },
        fillSelectedPrograms(){
            if (this.student.programy) {
                this.selectedProgram = this.student.programy.map(program => program.prednaska_id);
            }
        },
        needToSelect(programGroup){
            for(let i=0;i<this.selectedProgram.length;i++){
                for(let j=0;j<programGroup.length;j++){
                    if(programGroup[j].id===this.selectedProgram[i]){
                        return programGroup[j].nazov_prednasky;
                    }
                }
            }
            return "žiadna";
        }

    },
    computed: {
        groupedPrograms() {
            const groups = {};
            this.programs.forEach(program => {
                const casId = program.cas;
                if (program.speaker !== null) {
                    if (!groups[casId]) {
                        groups[casId] = [];
                    }
                    groups[casId].push(program);
                }
            });
            return Object.values(groups);
        }
    }
}
</script>
