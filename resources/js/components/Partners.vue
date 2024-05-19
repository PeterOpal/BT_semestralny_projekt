<template>
    <div>
        <div v-if="loading">
            <div class="row">
                <div class="col-xs-12 text-center">
                    LOADING <br>
                    <img :src="'images/loading.gif'" alt="loading" height="100" width="100"/>
                </div>
            </div>
        </div>
        <div v-else>
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
        </div>
    </div>
</template>

<script>
import { useSponsorStore } from '@/stores/sponsorStore';

export default {
    data() {
        return {
            loading: true,
            sponsors: [],
        };
    },
    created() {
        this.fetchSponsors();
    },
    methods: {
        async fetchSponsors() {
            try {
                const sponsorsStore = useSponsorStore();
                if(sponsorsStore.sponsors.length === 0)  await sponsorsStore.fetchSponsors();
                this.sponsors = sponsorsStore.sponsors;
            } catch (error) { console.error('Error fetching sponsors:', error);} finally {this.loading = false;}
        },
    },
};
</script>



