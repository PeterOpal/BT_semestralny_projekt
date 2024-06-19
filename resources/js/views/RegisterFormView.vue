<template>
    <SubPageHeader page_name="REGISTRÁCIA"></SubPageHeader>

    <h2 class="text-center" style="padding-top: 50px;">Registračný formulár na nConnect</h2>
    <v-sheet class="mx-auto" width="400" style="padding-top: 20px; padding-bottom: 200px;">
        <v-form @submit.prevent="odoslat">
            <v-text-field
                v-model="data_na_odaslanie.meno"
                :rules="nameRules"
                label="Meno"
                required
            ></v-text-field>
            <v-text-field
                v-model="data_na_odaslanie.priezvisko"
                :rules="nameRules"
                label="Priezvisko"
                required
            ></v-text-field>
            <v-text-field
                v-model="data_na_odaslanie.mail"
                :rules="mailRules"
                label="E-mail"
            ></v-text-field>
            <v-radio-group v-model="skola">
                <v-radio label="Student" :value="1"></v-radio>
                <v-radio label="Zamestnanec" :value="0"></v-radio>
            </v-radio-group>
            <template v-if="skola===1">
                <v-text-field
                    v-model="data_na_odaslanie.nazov_skoly"
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
                            @update:modelValue="(prednaskaID) => zvolena_prednaska(prednaskaID, _id+1)"
                            outlined
                        ></v-select>
                    </v-col>
                </v-row>
            </v-container>
            <div class="text-center" style="color:red; font-weight: bolder">{{errorMSG}}</div>
            <v-btn class="mt-2" type="submit" block color="green">Odoslat</v-btn>
        </v-form>
    </v-sheet>
    <Footer></Footer>
</template>
<script>
import SubPageHeader from "../components/SubPageHeader.vue";
import Footer from "../components/Footer.vue";
import { useProgramStore } from '@/stores/programStore';
import axios from "axios";
import router from "../router";

export default {
    data(){
        return{
            errorMSG: '',
            programs: [],
            skola: -1,
            loading: true,
            data_na_odaslanie: {
                mail: '',
                meno: '',
                priezvisko: '',
                nazov_skoly: '',
                selected_programs: []
            },
            nameRules: [
                value => {
                    if (value?.length > 1) return true
                    return 'Nemate vyplenene spravne pole!'
                },
            ],
            mailRules: [
                value => {
                    const pattern = /^[a-z0-9.-]+@[a-z.-]+\.[a-z]+$/i;
                    if (pattern.test(value)) return true;
                    return 'Musí to byť platný e-mail.';
                }
            ],
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
            this.data_na_odaslanie.selected_programs[_id]=selectedPrednaska;
            console.log(this.data_na_odaslanie);
        },
        odoslat() {
            if (this.data_na_odaslanie.meno.length>1 && this.data_na_odaslanie.priezvisko.length>1 && this.data_na_odaslanie.mail.length>4) {
                console.log("Odoslany formular!");
                //alert("Odoslali sme e-mail, potvrdte svoje ucast. Dakujeme za registraciu!");
                axios.post('api/ulozit-registraciu', this.data_na_odaslanie).then(response => {
                    console.log("odoslal aj email");
                    alert("Dostal si email od nas! Potvrd prosim to!");
                    this.$router.push({ name: 'home' });
                })
                    .catch(error => {
                        alert('NASTAL CHYBA: '+error.response.data.msg);
                        console.error('Error, email si nedostal');
                    });
            }
            else{
                this.errorMSG="Chybaju udaje";
                console.error("Formular nebude odoslany!");
            }
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
