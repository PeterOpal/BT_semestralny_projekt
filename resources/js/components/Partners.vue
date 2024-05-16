<template>


            <div class="tab-content sponsors-contents text-center">
                <div role="tabpanel" class="tab-pane active" id="SilverSponsors">
                    <div class="row">
                        <div v-for="sponsor in sponsors" :key="sponsor.id">
                            <div class="col-md-3 col-sm-6 mb30">
                                <div class="single-sponsor primary-shadow white-bg">
                                    <a target="_blank" :href="sponsor.link">
                                        <img :src="'data:image/jpeg;base64,' + sponsor.photo" alt="sponsor"/></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tabpanel -->
            </div><!-- /.tab-content -->

</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            sponsors: []
        };
    },
    mounted() {
        axios.get('/api/sponsors')
            .then(response => {
                this.sponsors = response.data;
            })
            .catch(error => {
                console.error('Error fetching sponsors:', error);
            });
    },
};
</script>
