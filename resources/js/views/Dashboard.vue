<template>
    <div v-if="user">
        Vitajte {{user.name}} {{user.last_name}}
        <br>
        <button @click.prevent="logout">Logout</button>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            user: null
        }
    },
    methods: {
        logout() {
            axios.post('api/logout').then(()=>{
                this.$router.push({name: "login"});
            })
        }
    },
    mounted() {
        axios.get('api/user').then((res) => {
            this.user = res.data;
            console.log(res.data);
        })
    }
}
</script>
