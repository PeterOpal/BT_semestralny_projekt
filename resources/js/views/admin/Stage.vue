<template>
   <v-app>
        <v-snackbar v-model="showSnackBar" :timeout="2000" color="blue-grey" rounded="pill" :top="true">
            {{ msg }}
        </v-snackbar>
   </v-app>
</template>
<script >
export default {
    data(){
        return{
            msg: "Hello World",
            showSnackBar: true
        }
    }
}
</script>
