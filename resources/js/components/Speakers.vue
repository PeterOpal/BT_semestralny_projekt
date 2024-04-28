<template>
    <div class="speakers-area white-bg">
        <div class="container">
            <div class="sub-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Speakers</h4>
                    </div>
                </div>
            </div>
                <Speaker v-for="speaker in speakersData" :key="speaker.id"
                    :img_path="speaker.img_path"
                    :description="speaker.description"
                    :facebook="speaker.facebook"
                    :twitter="speaker.twitter"
                    :firma="speaker.firma"
                    :speaker_name="speaker.speaker_name"
                    :more_description="speaker.more_description"
                    :id="speaker.id"
                />
        </div><!-- /.container -->
    </div><!-- /.speakers-area -->
</template>
<script setup>
import Speaker from "./Speaker.vue";

const speakersData = [
    {
        img_path: "images/speakers/Gymbeam.jpg",
        description: "Zakladateľ a CEO GymBeam, od roku 2014 transformoval trh so športovou výživou na e-commerce platformu pôsobiacu v 16 krajinách s ročnými tržbami presahujúcimi 100 miliónov Eur.",
        facebook: "https://www.facebook.com/",
        twitter: "https://www.twitter.com/",
        firma: "GymBeam",
        speaker_name: "DALIBOR CICMAN",
        more_description: "Ako nositeľ ocenení Forbes \"30 pod 30\" a YT Podnikateľ roka 2024, Dalibor presadzuje význam dátovo riadeného prístupu, inovačnej kultúry a tímovej spolupráce pri budovaní značky.",
        id: 1,
    },
    {
        img_path: "images/speakers/muziker.jpg",
        description: "Short description of speaker 1",
        facebook: "https://www.facebook.com/speaker1",
        twitter: "https://www.twitter.com/speaker1",
        firma: "Company Name 1",
        speaker_name: "Speaker Name 1",
        more_description: "More detailed description of speaker 1",
        id: 2,
    },
    {
        img_path: "images/speakers/PPS.jpg",
        description: "Short description of speaker 1",
        facebook: "https://www.facebook.com/speaker1",
        twitter: "https://www.twitter.com/speaker1",
        firma: "Company Name 1",
        speaker_name: "Speaker Name 1",
        more_description: "More detailed description of speaker 1",
        id: 3,
    },
    {
        img_path: "images/speakers/uniqua.jpg",
        description: "Short description of speaker 1",
        facebook: "https://www.facebook.com/speaker1",
        twitter: "https://www.twitter.com/speaker1",
        firma: "Company Name 1",
        speaker_name: "Speaker Name 1",
        more_description: "More detailed description of speaker 1",
        id: 4,
    },
];
</script>
