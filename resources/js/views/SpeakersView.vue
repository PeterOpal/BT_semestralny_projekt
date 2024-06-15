<template>
    <SubPageHeader page_name="Speakers"></SubPageHeader>

    <div class="featured-speakers-area mb-30">
        <div class="container">
            <div class="sub-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Headlineri</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <HeadlinerSpeaker v-for="speaker in headlinerSpeakers"
                                  :dlhy_popis="speaker.dlhy_popis"
                                  :kratky_popis="speaker.kratky_popis"
                                  :id="speaker.id"
                                  :photo="speaker.photo"
                                  :speaker-name="speaker.meno"
                                  :key="speaker.id"
                ></HeadlinerSpeaker>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.featured-speakers-area -->

    <div class="speakers-area grey-bg">
        <div class="container">
            <div class="sub-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Speakers</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <Speakers v-for="speaker in otherSpeakers"
                          :id="speaker.id"
                          :dlhy_popis="speaker.dlhy_popis"
                          :company_name="speaker.company_name"
                          :kratky_popis="speaker.kratky_popis"
                          :speaker-name="speaker.meno"
                          :photo="speaker.photo">
                </Speakers>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.speakers-area -->

    <Footer></Footer>
</template>
<script>
import SubPageHeader from "../components/SubPageHeader.vue";
import { useSpeakerStore } from '@/stores/speakersStore';
import HeadlinerSpeaker from "../components/HeadlinerSpeaker.vue";
import Footer from "../components/Footer.vue";
import Speakers from "../components/Speakers.vue";

export default {
    data() {
        return {
            loading: true,
            speakers: [],
        };
    },
    components: {
        Speakers,
        Footer,
        HeadlinerSpeaker,
      SubPageHeader
    },
    created() {
        this.fetchSpeakers();
    },
    methods: {
        async fetchSpeakers() {
            try {
                const speakerStore = useSpeakerStore();
                if(speakerStore.speakers.length === 0)  await speakerStore.fetchSpeakers();
                this.speakers = speakerStore.speakers;
            } catch (error) { console.error('Error fetching speakers:', error);} finally {this.loading = false;}
        },
    },
    computed: {
        headlinerSpeakers() {
            return this.speakers.filter(speaker => speaker.headliner === 1);
        },
        otherSpeakers(){
            return this.speakers.filter(speaker => speaker.headliner === 0);
        }
    }
};
</script>
