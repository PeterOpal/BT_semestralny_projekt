<template>
    <SubPageHeader page_name="REGISTRÁCIA"></SubPageHeader>

    <h2 class="text-center">Registračný formulár na nConnect</h2>
    <v-sheet class="mx-auto" width="400" style="padding-top: 20px; padding-bottom: 200px;">
        <v-form @submit.prevent>
            <v-text-field
                v-model="firstName"
                :rules="rules"
                label="Meno"
            ></v-text-field>
            <v-text-field
                v-model="firstName"
                :rules="rules"
                label="Priezvisko"
            ></v-text-field>
            <v-text-field
                v-model="firstName"
                :rules="rules"
                label="E-mail"
            ></v-text-field>
            <v-radio-group v-model="skola" style="display: block;">
                <v-radio label="Student" :value="1"></v-radio>
                <v-radio label="Zamestnanec" :value="0"></v-radio>
            </v-radio-group>
            <template v-if="skola===1">
                <v-text-field
                    v-model="firstName"
                    :rules="rules"
                    label="Skola"
                ></v-text-field>
            </template>
            Vyber si prednasky (ked este ma volne miesto):
            <v-container>
                <v-row v-for="(programGroup, _id) in groupedPrograms" :key="_id" class="my-4">
                    <v-col cols="12">
                        <label>Prednaska {{ programGroup[0].sloty.od.split(":")[0] }}:{{ programGroup[0].sloty.od.split(":")[1] }}-{{ programGroup[0].sloty.do.split(":")[0] }}:{{ programGroup[0].sloty.do.split(":")[1] }} </label>
                        <v-select
                            :items="[{'nazov_prednasky':'žiadna', 'id': -1}, ...programGroup]"
                            item-title="nazov_prednasky"
                            item-value="id"
                            label="Zvolte prednasku"
                            @update:modelValue="(prednaskaID) => zvolena_prednaska(prednaskaID, _id)"
                            outlined
                        ></v-select>
                    </v-col>
                </v-row>
            </v-container>
            <v-btn class="mt-2" type="submit" block color="green">Odoslat</v-btn>
        </v-form>
    </v-sheet>

    <Footer></Footer>
</template>
<script>
import SubPageHeader from "../components/SubPageHeader.vue";
import Footer from "../components/Footer.vue";
import { useProgramStore } from '@/stores/programStore';

export default {
    data(){
        return{
            skola: -1,
            programs: [],
            loading: true,
            selected_programs: [],
        }
    },
    components: {
        SubPageHeader, Footer
    },
    created() {
        this.fetchPrograms();
    },
    methods: {
        async fetchPrograms() {
            try {
                const programStore = useProgramStore();
                if(programStore.program.length === 0)  await programStore.fetchPrograms();
                this.programs = programStore.program;
            } catch (error) { console.error('Error fetching programs:', error);} finally {this.loading = false;}
        },
        zvolena_prednaska(selectedPrednaska, _id) {
            this.selected_programs[_id]=selectedPrednaska;
            console.log(this.selected_programs);
        },
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
