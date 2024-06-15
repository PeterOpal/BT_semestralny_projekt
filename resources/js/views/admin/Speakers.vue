<template>
    <AdminHeader page_name="Speakers"></AdminHeader>

    <div v-if="loading">
        <Loading></Loading>
    </div>

    <div v-else>
        <v-table style="margin-top: 50px;">
            <thead>
            <tr>
                <th class="text-center">Obrazok*</th>
                <th class="text-center">Meno speakera*</th>
                <th class="text-center">Kratky popis*</th>
                <th class="text-center">Dlhy popis*</th>
                <th class="text-center">Spolocnost*</th>
                <th class="text-center">Link na spolocnost*</th>
                <th class="text-center">Headliner</th>
                <th class="text-center">Facebook link</th>
                <th class="text-center">Twitter link</th>
                <th class="text-center">Webova stranka speakera</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in speakers" :key="item.id">
                <td class="text-center"><img width="100" height="100" :src="'data:image/jpeg;base64,' + item.photo" alt="speaker"/></td>
                <td class="text-center">{{ item.meno }}</td>
                <td class="text-center">{{ item.kratky_popis }}</td>
                <td class="text-center">{{ item.dlhy_popis }}</td>
                <td class="text-center">{{ item.company_name }}</td>
                <td class="text-center">{{ item.company_link }}</td>
                <td class="text-center">{{ item.headliner === 0 ? 'Nie' : 'Ano' }}</td>
                <td class="text-center">{{ item.facebook_link }}</td>
                <td class="text-center">{{ item.twitter_link }}</td>
                <td class="text-center">{{ item.web_link }}</td>
                <td class="text-center"><v-btn @click="editSpeaker(item)"><span class="glyphicon glyphicon-pencil"></span></v-btn></td>
                <td class="text-center"><v-btn @click="deleteSpeaker(item.id)"><span class="glyphicon glyphicon-trash"></span></v-btn></td>
            </tr>
            </tbody>
        </v-table>

        <!-- Add -->
        <div class="text-center mt-16">
            <v-dialog v-model="addModal" max-width="500">
                <template v-slot:activator="{ on }">
                    <v-btn color="primary" dark v-on="on" @click="addModal=true">Pridat speakera</v-btn>
                </template>
                <v-card>
                    <v-card-title>Pridat speakera</v-card-title>
                    <v-card-text>
                        <v-text-field v-model="newSpeaker.meno" label="Meno speakera*"></v-text-field>
                        <v-textarea label="Kratky popis:*" rows="1" v-model="newSpeaker.kratky_popis" variant="underlined"></v-textarea>
                        <v-textarea label="Dlhy popis:*" rows="3" v-model="newSpeaker.dlhy_popis" variant="underlined"></v-textarea>
                        <v-text-field v-model="newSpeaker.spolocnost" label="Spolocnost*"></v-text-field>
                        <v-text-field v-model="newSpeaker.link_na_spolocnost" label="Link na spolocnost*"></v-text-field>
                        Headliner:
                        <v-radio-group v-model="newSpeaker.headliner" style="display: inline-flex;">
                            <v-radio label="Ano" :value="1"></v-radio>
                            <v-radio label="Nie" :value="0"></v-radio>
                        </v-radio-group>
                        <v-text-field v-model="newSpeaker.facebook_link" label="Facebook link"></v-text-field>
                        <v-text-field v-model="newSpeaker.twitter_link" label="Twitter link"></v-text-field>
                        <v-text-field v-model="newSpeaker.webova_stranka" label="Webova stranka speakera"></v-text-field>
                    </v-card-text>
                    <v-file-input
                        label="Obrazok speakera *max 65kB"
                        counter
                        show-size
                        style="width: 450px; margin-left: 20px;"
                        @change="nahratObrazok"
                    ></v-file-input>
                    <v-card-actions>
                        <v-btn color="primary" @click="addSpeaker">Pridat</v-btn>
                        <v-btn @click="addModal = false">Cancel</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </div>
    </div>

    <!-- Edit -->
    <v-dialog v-model="editModal" max-width="500">
        <v-card>
            <v-card-title>Edit speaker</v-card-title>
            <v-card-text>
                <v-text-field v-model="selectedItem.meno" label="Meno speakera*"></v-text-field>
                <v-textarea label="Kratky popis:*" rows="1" v-model="selectedItem.kratky_popis" variant="underlined"></v-textarea>
                <v-textarea label="Dlhy popis:*" rows="3" v-model="selectedItem.dlhy_popis" variant="underlined"></v-textarea>
                <v-text-field v-model="selectedItem.company_name" label="Spolocnost*"></v-text-field>
                <v-text-field v-model="selectedItem.company_link" label="Link na spolocnost*"></v-text-field>
                Headliner:
                <v-radio-group v-model="selectedItem.headliner" style="display: inline-flex;">
                    <v-radio label="Ano" :value="1"></v-radio>
                    <v-radio label="Nie" :value="0"></v-radio>
                </v-radio-group>
                <v-text-field v-model="selectedItem.facebook_link" label="Facebook link"></v-text-field>
                <v-text-field v-model="selectedItem.twitter_link" label="Twitter link"></v-text-field>
                <v-text-field v-model="selectedItem.web_link" label="Webova stranka speakera"></v-text-field>
                <img width="100" height="100" :src="'data:image/jpeg;base64,' + selectedItem.photo" alt="sponsor"/>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="update">Update</v-btn>
                <v-btn @click="editModal = false">Cancel</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-app>
        <v-snackbar v-model="showSnackBar" :timeout="2000" color="blue-grey" rounded="pill" :top="true">
            <div class="text-center" v-html="msg"></div>
        </v-snackbar>
    </v-app>
</template>
<script>
import axios from "axios";
import Loading from "../../components/Loading.vue";
import AdminHeader from "../../components/AdminHeader.vue";

export default {
    components: {Loading, AdminHeader},
    data() {
        return {
            speakers: [],
            loading: true,
            editModal: false,
            addModal: false,
            selectedItem: null,
            newSpeaker: {
                meno: '',
                kratky_popis: '',
                dlhy_popis: '',
                spolocnost: '',
                link_na_spolocnost: '',
                headliner: 0,
                facebook_link: '',
                twitter_link: '',
                webova_stranka: '',
                photo: null
            },
            msg: '',
            showSnackBar: false
        };
    },
    mounted() {
        this.getData()
    },
    methods: {
        async getData() {
            axios.get('api/speakers').then(response => {
                this.speakers = response.data;
                this.loading = false;
            }).catch(error => {
                console.error('Error fetching speakers:', error)
            });
        },
        editSpeaker(item) {
            this.selectedItem = item;
            this.editModal = true;
        },
        update() {
            this.editModal = false;
            axios.patch(`/api/speakers/${this.selectedItem.id}`, {
                data: this.selectedItem
            }).then(response => {
                this.msg = 'Updated: ' + response.data.meno;
                this.showSnackBar = true;
            }).catch(error => {
                this.msg = 'Error while updating!';
                this.showSnackBar = true;
                console.error('Error updating speaker:', error);
            });
        },
        deleteSpeaker(selectedID){
            axios.delete(`/api/speakers/${selectedID}`).then(response => {
                this.msg = 'Removed speaker with his program!';
                this.showSnackBar = true;
                this.speakers = this.speakers.filter(item => item.id !== selectedID);
            }).catch(error => {
                    this.msg = 'Error while deleting speaker!';
                    this.showSnackBar = true;
                    console.error('Error deleting speaker:', error);
            });
        },
        nahratObrazok(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => { const base64Data = e.target.result.split(',')[1];this.newSpeaker.photo = base64Data; };
            reader.readAsDataURL(file);
            this.msg='Obrazok bol nahrate!';this.showSnackBar=true;
        },
        validacia(){
            let vsetko_je_vyplnene=true;
            let error_msg='';
            /*for (const key in this.newSpeaker) {
                if (this.newSpeaker[key] === '' || this.newSpeaker[key] === null) {
                    error_msg+=key+", ";
                    vsetko_je_vyplnene = false;
                }
            }*/
            if(this.newSpeaker.meno==='') { vsetko_je_vyplnene=false; error_msg='meno, '; }
            if(this.newSpeaker.kratky_popis==='') { vsetko_je_vyplnene=false; error_msg+='kratky popis, '; }
            if(this.newSpeaker.dlhy_popis==='') { vsetko_je_vyplnene=false; error_msg+='dlhy popis, '; }
            if(this.newSpeaker.spolocnost==='') { vsetko_je_vyplnene=false; error_msg+='spolocnost, '; }
            if(this.newSpeaker.link_na_spolocnost==='') { vsetko_je_vyplnene=false; error_msg+='link na spolocnost, '; }
            if(this.newSpeaker.photo==null) { vsetko_je_vyplnene=false; error_msg+='obrazok'; }

            if(!vsetko_je_vyplnene){
                this.msg = `Pole: <span style="color: red;"><b>${error_msg}</b></span> nie je vyplnene!`;
                this.showSnackBar = true;
            }
            return vsetko_je_vyplnene;
        },
        addSpeaker() {
            if(!this.validacia()){
                return;
            } else {
                this.addModal = false;
                axios.post('api/speakers', this.newSpeaker).then(response => {
                    this.msg = 'Speaker bol pridany:' + response.data.meno;
                    this.showSnackBar = true;
                    this.speakers.push(response.data);

                    this.newSpeaker.meno = '';
                    this.newSpeaker.kratky_popis='';
                    this.newSpeaker.dlhy_popis='';
                    this.newSpeaker.spolocnost='';
                    this.newSpeaker.link_na_spolocnost='';
                    this.newSpeaker.headliner=0;
                    this.newSpeaker.facebook_link='';
                    this.newSpeaker.twitter_link='';
                    this.newSpeaker.webova_stranka='';
                    this.newSpeaker.photo=null;
                })
                    .catch(error => {
                        console.error('Error while adding new speaker:', error);
                        this.msg = 'Nevedel som pridat speaker. Nastal chyba!';
                        this.showSnackBar = true;
                    });
            }
        }
    }
}
</script>
