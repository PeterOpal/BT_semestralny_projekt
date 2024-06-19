<template>
    <AdminHeader style="margin-bottom: 50px" page_name="Editor"></AdminHeader>

    <div v-if="EDITSTRANKU" style="padding-left: 20px; padding-right: 20px">
        <v-text-field v-model="NAZOV_STRANKY" label="Nazov stranky" required></v-text-field>
        <QuillEditor ref="quillEditorUPDATE" theme="snow" toolbar="full" style="height: 200px"/>
        <div class="text-center">
            <v-btn class="mt-8" color="primary" @click="updateStranku" dark v-on="on">Aktualizovat stranku</v-btn>
        </div>
    </div>
    <div v-else style="padding-left: 20px; padding-right: 20px">
        <v-text-field v-model="data_na_odoslanie.nazov_stranky" label="Nazov stranky" required></v-text-field>
        <QuillEditor ref="quillEditor" theme="snow" toolbar="full" style="height: 200px"/>
        <div class="text-center">
            <v-btn class="mt-8" color="primary" @click="savePage" dark v-on="on">Pridat novu stranku</v-btn>
        </div>
    </div>

</template>
<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import AdminHeader from "../../components/AdminHeader.vue";
import axios from "axios";
import router from "../../router";

export default {
    data(){
        return{
            data_na_odoslanie: {
                nazov_stranky: '',
                html_kod: ''
            },
            ID: -1,
            NAZOV_STRANKY: "",
            HTML_KOD: "",
            EDITSTRANKU: false
        }
    },
    props:{
        editstranku: {
            type: Boolean,
            required: true
        },
        stranka_id: {
            type: Number,
            required: false
        },
        nazov_stranky: {
            type: String,
            required: false
        },
        html_kod: {
            type: String,
            required: false
        }
    },
    components: {
        AdminHeader,
        QuillEditor
    },
    methods: {
        savePage() {
            this.data_na_odoslanie.html_kod=this.$refs.quillEditor.getHTML();
            this.addStranku();
        },
        addStranku() {
            axios.post('api/stranky', this.data_na_odoslanie)
                .then(response => {
                    alert('Pridal si novu stranku!');
                    router.push({name: 'Admin-stranky'});
                })
                .catch(error => {
                    alert("Error while adding new page: "+error);
                });
        },
        updateStranku(){
            axios.patch(`/api/stranky/${this.stranka_id}`, {
                nazov_stranky: this.NAZOV_STRANKY,
                html_kod: this.$refs.quillEditorUPDATE.getHTML()
            }).then(response => {
                router.go(-1);
            }).catch(error => {
                console.error('Error updating website:', error);
            });
        },
        nastavitKontent(){
            this.$nextTick(() => {
                this.$refs.quillEditorUPDATE.setHTML(this.HTML_KOD);
            });
        }
    },
    mounted() {
        this.EDITSTRANKU=this.editstranku;
        if(this.editstranku){
            this.NAZOV_STRANKY=this.nazov_stranky;
            this.HTML_KOD=this.html_kod;
            this.nastavitKontent();
        }
    }
}
</script>
