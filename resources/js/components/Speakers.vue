<template>
    <div class="col-md-3 col-sm-6 mb30">
        <div class="single-speaker primary-shadow white-bg">
            <div class="speaker-cover">
                <img :src="'data:image/jpeg;base64,' + photo" alt="cover"/>
                <div class="sperker-cover-over">
                    <div class="speakers-thought">
                        <p>{{kratky_popis}}
                        </p>
                        <a href="" data-toggle="modal" :data-target="'#Speaker-'+id">Viac o mne</a>
                    </div>
                </div>
                <ul class="speaker-social">
                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                </ul>
                <h6><a href=""> {{ company_name }}</a></h6>
            </div>
            <div class="modal fade" :id="'Speaker-'+id" tabindex="-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="speaker-details white-bg primary-shadow">
                                <div class="row no-margin">
                                    <div class="col-sm-6 no-padding">
                                        <div class="speaker-images-slider">
                                            <img :src="'data:image/jpeg;base64,' + photo" alt="speaker"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 no-padding">
                                        <div class="speaker-details-texts">
                                            <div class="sdt-top">
                                                <h4>{{ speakerName }}</h4>
                                                <h6>{{ company_name }}</h6>
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="sdt-bottom">
                                                <p>{{dlhy_popis}}</p>
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
            <div class="speaker-name">
                <h5 :title="speakerName">{{speakerName}}</h5>
            </div>
        </div><!-- /.single-speaker -->
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
        company_name: {
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
