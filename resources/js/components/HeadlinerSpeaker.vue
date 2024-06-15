<template>
    <div class="col-md-6">
        <div class="single-featured-speaker primary-shadow white-bg">
            <div class="row no-margin">
                <div class="col-sm-6 no-padding">
                    <div class="speaker-cover">
                        <img :src="'data:image/jpeg;base64,' + photo" alt="speaker"/>
                        <div class="speaker-over">
                            <ul> <!--DATA-->
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 no-padding">
                    <div class="about-speaker">
                        <!--<h6>AI&Data Stage</h6>-->
                        <h4>{{ speakerName }}</h4>
                        <p>{{kratky_popis }}</p>
                        <a href="" data-toggle="modal" :data-target="'#fSpeaker-' + id">Viac o mne</a> <!--v-for index-->
                    </div>
                </div>
                <div class="modal fade" :id="'fSpeaker-'+id" tabindex="-1"> <!--v-for index-->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="speaker-details white-bg primary-shadow">
                                    <div class="row no-margin">
                                        <div class="col-sm-5 no-padding">
                                            <div class="speaker-images-slider">
                                                <img :src="'data:image/jpeg;base64,' + photo" alt="speaker"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 no-padding">
                                            <div class="speaker-details-texts">
                                                <div class="sdt-top">
                                                    <h4>{{ speakerName }}</h4>
                                                    <!--<h6>Data-driven business</h6>-->
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="sdt-bottom">
                                                    <p>{{ dlhy_popis }}</p>
                                                    <a href="" class="button alt small" data-dismiss="modal">Zavrieť</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.speaker-details -->
                            </div>
                            <div class="col-md-2"></div>
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.modal -->
            </div>
        </div>
    </div><!-- /.col -->
</template>
<script>
export default {
    props: {
        photo: {
            type: String,
            required: true
        },
        speakerName: {
            type: String,
            required: true
        },
        kratky_popis: {
            type: String,
            required: true
        },
        dlhy_popis: {
            type: String,
            required: true
        },
        id: {
            type: Number,
            required: true
        },
        facebook: {
            type: String,
            required: false
        },
        twitter: {
            type: String,
            required: false
        },
        speaker_web: {
            type: String,
            required: false
        },
    }
}
</script>
