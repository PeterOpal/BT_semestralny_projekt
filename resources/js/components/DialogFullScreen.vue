<template>
    <div class="text-center">
        <v-dialog v-model="dialog" transition="dialog-bottom-transition" fullscreen>
            <template v-slot:activator="{ props: activatorProps }">
                <h4 v-bind="activatorProps" style="text-transform: none; cursor: alias;">{{ nazov_stranky }}</h4>
            </template>

            <v-card>
                <v-toolbar>
                    <v-btn icon="mdi-close" @click="dialog = false"></v-btn>

                    <div >
                    <v-toolbar-title class="mx-auto">{{ nazov_stranky }}</v-toolbar-title>
                    </div>

                    <v-spacer></v-spacer>
                </v-toolbar>

                <QuillEditor ref="quillEditorr" read-only/>
                <v-list lines="two" subheader> </v-list>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>

import {QuillEditor} from "@vueup/vue-quill";
import '@vueup/vue-quill/dist/vue-quill.snow.css';
export default {
    components: {QuillEditor},
    data() {
        return {
            dialog: false,
            notifications: false,
            sound: true,
            widgets: false,
        }
    },
    props:{
        nazov_stranky:{
            type: String,
            required: true
        },
        html_kod:{
            type: String,
            required: true
        }
    },
    updated() {
        this.$nextTick(() => {
            if (this.$refs.quillEditorr) {
                this.$refs.quillEditorr.setHTML(this.html_kod);
            }
        });
    },

}
</script>

<style scoped>
h4:hover{
    color: #0cf67a;
}
::v-deep .ql-toolbar.ql-snow {
    display: none !important;
}
</style>
