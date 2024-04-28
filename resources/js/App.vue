<template>
    <Navigation></Navigation>
    <MainView></MainView>
</template>
<script>
import Navigation from "./components/Navigation.vue";
import MainView from "./views/MainView.vue";

export default {
    components: {
        MainView,
        Navigation
    }
}

console.log("Open admin: ");
</script>
