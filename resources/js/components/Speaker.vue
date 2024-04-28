<template>
    <div class="col-md-3 col-sm-6 mb30">
        <div class="single-speaker primary-shadow white-bg">
            <div class="speaker-cover">
                <img :src="img_path" alt="cover"/>
                <div class="sperker-cover-over">
                    <div class="speakers-thought">
                        <p>{{ description }}</p> <a href="" data-toggle="modal" :data-target="`#Speaker-` + id">Viac o mne</a>
                    </div>
                </div>
                <ul class="speaker-social">
                    <li><a href="{{facebook}}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{twitter}}"><i class="fa fa-twitter"></i></a></li>
                    <li><a href=""><i class="fa fa-dribbble"></i></a></li>
                </ul>
                <h6><a href="">{{ firma }}</a></h6>
            </div>
            <div class="modal fade" :id="'Speaker-' + id"  tabindex="-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="speaker-details white-bg primary-shadow">
                                <div class="row no-margin">
                                    <div class="col-sm-6 no-padding">
                                        <div class="speaker-images-slider">
                                            <img :src="img_path" alt="speaker"/></div>
                                    </div>
                                    <div class="col-sm-6 no-padding">
                                        <div class="speaker-details-texts">
                                            <div class="sdt-top">
                                                <h4>{{ speaker_name }}</h4>
                                                <h6>{{ firma }}</h6>
                                                <ul>
                                                    <li><a href="{{ facebook }}"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="{{ twitter }}"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="sdt-bottom">
                                                <p>{{ description }}</p>
                                                <p>{{ more_description }}</p>
                                                <a href="" class="button alt small" data-dismiss="modal">Zavrieť</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
            <div class="speaker-name">
                <h5>{{ speaker_name }}</h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Speaker",
    props: {
        img_path: {
            type: String,
            required: true
        },
        description: {
            type: String,
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
        firma: {
            type: String,
            required: true
        },
        speaker_name: {
            type: String,
            required: true
        },
        more_description: {
            type: String,
            required: false
        },
        id: {
            type: Number,
            required: true
        }
    }
}
</script>
