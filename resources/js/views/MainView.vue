<template>
    <Navigation></Navigation>
    <div class="header-area" id="home-header">
            <MainHeader></MainHeader>
    </div>

    <div class="about-area gray-bg" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb30">
                    <div class="video-intro primary-shadow">
                        <img :src="'images/about/about-logo.jpg'" alt="video-intro"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-text">
                        <h4>Pár slov o konferencii nConnect</h4>
                        <p>Po mnohých rokoch premýšľania a plánovania sme vytvorili nConnect, jedinečnú udalosť v Nitre,
                            ktorá spája študentov IT a popredné firmy z tohto dynamického odvetvia. Konferencia nConnect
                            nadväzuje na dlhoročnú tradíciu formátu "IT v praxi" Fakulty prírodných vied a informatiky
                            UKF v Nitre. Táto iniciatíva je mostom medzi novou generáciou talentov a skúsenými
                            profesionálmi, ktorý poskytuje fórum pre vzájomnú výmenu myšlienok a inšpirácií. Naše
                            poslanie bolo jasné: vyplniť medzeru v regionálnej komunikácii a spolupráci v IT a nConnect
                            je hrdým výsledkom tejto vízie.</p>
                    </div>
                    <div class="row">
                        <div>
                            <div v-for="(item, index) in sekcia" :key="index" class="col-sm-6">
                                <div class="single-about primary-shadow white-bg">
                                    <h5>{{ item.question }}</h5>
                                    <p>{{ item.answer }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.about-area -->

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
                <Speakers v-for="speaker in getRandomSpeakers()"
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

    <div class="schedule-area gray-bg">
        <div class="container">
            <div class="sub-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h4>PROGRAM</h4>
                    </div>
                </div>
            </div>
    <Program></Program>
        </div>
    </div><!-- /.schedule-area -->

    <Testimonials></Testimonials>
    <div class="sponsors-area gray-bg">
        <div class="container">
            <div class="sub-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Naši Partneri</h4>
                    </div>
                </div>
            </div>
            <Partners></Partners>
        </div><!-- /.container -->
    </div><!-- /.sponsors-area -->

    <ContactArea></ContactArea>
    <Footer></Footer>

</template>

<script>
import MainHeader from "../components/MainHeader.vue";
import Speakers from "../components/Speakers.vue";
import Program from "../components/Program.vue";
import Navigation from "../components/Navigation.vue"
import Footer from "../components/Footer.vue"
import Partners from "../components/Partners.vue";
import Testimonials from "../components/Testimonials.vue";
import ContactArea from "../components/ContactArea.vue";
import { useSpeakerStore } from '@/stores/speakersStore';
export default {
    components: {
        ContactArea,
        Testimonials,
        Partners,
        Program,
        Speakers,
        MainHeader,
        Footer,
        Navigation
    },
    data() {
        return {
            loading: true,
            speakers: [],
            sekcia: [
                {
                    question: 'Kto sme ?',
                    answer: 'Sme skupina nadšencov pre IT z akademického a súkromného sektora.'
                },
                {
                    question: 'Čo chceme dosiahnuť ?',
                    answer: 'Vytvoriť udalosť, ktorá bude na pravidelnej báze spájať IT komunitu v Nitre.'
                }
            ]
        }
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
        shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        },
        getRandomSpeakers() {
            this.speakers = this.shuffleArray(this.speakers);
            return this.speakers.slice(0, 4);
        }
    },
}
</script>
