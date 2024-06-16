<template>
    <AdminHeader style="margin-bottom: 50px" page_name="Custom editor"></AdminHeader>
    <div style="padding-left: 20px; padding-right: 20px">
        <QuillEditor ref="quillEditor" theme="snow" toolbar="full"/>
    </div>

    <button @click="savePage">Save Page</button>
    <br><br><br><div v-html="html_code"></div>

</template>
<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import AdminHeader from "../../components/AdminHeader.vue";

export default {
    data(){
        return{
            html_code: ''
        }
    },
    components: {
        AdminHeader,
        QuillEditor
    },
    methods: {
        savePage() {
            console.log("saving");
            const htmlContent = this.$refs.quillEditor.getHTML();
            console.log(htmlContent);
            this.html_code=htmlContent;
        },
    }
}
</script>
