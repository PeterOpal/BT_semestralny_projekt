<template>
    <div class="testimonials-area image-bg">
        <div class="overlay">
            <div class="container">
                <div class="sub-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Povedali o nás</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="client-pagination clearfix" id="testimonial-pager">
                            <a v-for="(testimonial, index) in testimonials" :key="index"
                               @click="selectTestimonial(index)">
                                <img height="70" width="70" :src="'data:image/jpeg;base64,' + testimonial.photo"
                                     alt="client"/>
                            </a>
                        </div><!-- /.client-pagination -->
                    </div><!-- /.col -->
                    <div class="col-md-8">
                        <div id="testimonials">
                            <div class="single-testimonial" v-if="selectedTestimonial !== null">
                                <div class="row">
                                    <div class="mb30" style="margin-left: 20px;">
                                        <blockquote>{{ testimonials[selectedTestimonial].description }}</blockquote>
                                        <h4>{{ testimonials[selectedTestimonial].person }}</h4>
                                    </div>
                                    <div class="" style="margin-left: 400px; ">
                                        <div class="client-image primary-shadow">
                                            <img style="width: 300px; height: 350px;"
                                                 :src="'data:image/jpeg;base64,' + testimonials[selectedTestimonial].photo"
                                                 alt="client"/>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.single-testimonial -->
                        </div><!-- /#testimonials -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.overlay -->
    </div><!-- /.testimonials-area -->
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            testimonials: [],
            selectedTestimonial: null
        };
    },
    mounted() {
        axios.get('/api/testimonials')
            .then(response => {
                this.testimonials = response.data;
                this.selectedTestimonial = 0;
            })
            .catch(error => {
                console.error('Error fetching testimonials:', error);
            });
    },
    methods: {
        selectTestimonial(index) {
            this.selectedTestimonial = index;
        }
    }
};
</script>

