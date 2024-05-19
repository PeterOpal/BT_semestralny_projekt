<template>

<div :class="['header-slide', 'header-slide-' + (slide_number + 1)]">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ datum }} , <span>Nitra</span></h3>
                    <h1 v-html="main_title"></h1>
                    <ul class="buttons">
                        <li v-for="(link, index) in links" :key="index">
                            <a :href="link.url" :target="link.target" class="line-button">{{ link.name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "Slider",
    props: {
        slide_number:{
          type: Number,
          required: true
        },
        datum: {
            type: String,
            required: true
        },
        main_title: {
            type: String,
            reuired: true
        },
        links: {
            type: Array,
            required: true
        }
    }
}
</script>

