<template>

    <SubPageHeader page_name="Partneri"></SubPageHeader>
    <div class="sponsors-area gray-bg page-section">
        <div class="container">
            <Partners></Partners>
        </div><!-- /.container -->
    </div><!-- /.sponsors-area -->
    <Footer></Footer>
</template>
<script>
import {defineComponent} from "vue";
import Partners from "../components/Partners.vue";
import Footer from "../components/Footer.vue";
import SubPageHeader from "../components/SubPageHeader.vue";

export default defineComponent({
    components: {SubPageHeader, Footer, Partners}
})
</script>
