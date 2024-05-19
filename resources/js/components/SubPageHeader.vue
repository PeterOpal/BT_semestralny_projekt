<template>
    <Navigation></Navigation>
    <div class="page-heading">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="/">Domov</a></li>
                            <li class="active">{{page_name}}</li>
                        </ul>
                        <h2>{{ page_name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.header-area -->
</template>
<script>
import { defineComponent } from "vue";
import Navigation from "../components/Navigation.vue";

export default defineComponent({
    components: { Navigation },
    props: {
        page_name: {
            type: String,
            required: true
        }
    }
});
</script>
