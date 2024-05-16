<template>
    <Navigation></Navigation>
    <div class="page-heading">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Domov</a></li>
                            <li class="active">Partneri</li>
                        </ul>
                        <h2>Partneri</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.header-area -->
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
import Navigation from "../components/Navigation.vue"

export default defineComponent({
    components: {Footer, Partners, Navigation}
})
</script>
