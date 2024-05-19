<template>
    <Slider v-for="(slide, index) in slides" :key="index"
            :slide_number="index + 1"
            :datum="slide.datum"
            :main_title="slide.main_title"
            :links="slide.links"/>
</template>

<script>
import Slider from "../components/Slider.vue";

export default {
    components: {
        Slider
    },

    data() {
        return {
            slides: [
                //first slide
                {
                    datum: '14 marec 2024',
                    main_title: '<small>Tech konferencia pre študentov v Nitre</small><span style="text-transform: lowercase;">n</span>Connect24',
                    links: [
                        {
                            name: 'Program konferencie',
                            url: 'schedule.php'
                        },
                        {
                            name: 'Speakers',
                            url: 'speakers.php'
                        },
                        {
                            name: 'Registrácia',
                            url: 'https://jhbq6cjtw5n.formlets.com/forms/udzi7MdglP32QjfE/',
                            target: '_blank'
                        }
                    ]
                },
                //second slide
                {
                    datum: '14 marec 2024',
                    main_title: '<small>Študentské centrum UKF</small>Vidíme sa tam',
                    links: [
                        {
                            name: 'Sponzori',
                            url: 'sponsors.php'
                        },
                        {
                            name: 'Kontaktujte nás',
                            url: 'contact.php'
                        }
                    ]
                }
            ]
        }
    }
}
</script>
