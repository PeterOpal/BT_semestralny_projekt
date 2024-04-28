<template>
    <div class="schedule-area gray-bg">
        <div class="container">
            <div class="sub-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h4>PROGRAM</h4>
                    </div>
                </div>
            </div>
            <div class="schedules">
                <div class="row no-margin">
                    <div class="col-md-3 no-padding">
                        <div class="schedule-title">
                            <h5>STAGE</h5>
                        </div>
                        <div class="schedule-date">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active">
                                    <a href="#date-1" data-toggle="tab">
                                        <h4>stage name</h4>
                                        <h5>datum</h5>
                                    </a>
                                </li>
                                <li>
                                    <a href="#date-2" data-toggle="tab">
                                        <h4>stage name 2</h4>
                                        <h5>datum</h5>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 no-padding">
                        <div class="schedule-details">
                            <div class="schedule-title">
                                <div class="row no-margin">
                                    <div class="col-sm-3 no-padding">
                                        <h5>ČAS</h5>
                                    </div>
                                    <div class="col-sm-9 no-padding">
                                        <h5>PREDNÁŠKA</h5>
                                    </div>
                                </div>
                            </div>

                            <!--content-->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane" id="date-2">
                                    <div class="panel-group" id="accordion-2" role="tablist">
                                        <ProgramRow></ProgramRow>
                                        <div class="single-schedule panel panel-default">
                                            <div class="panel-heading" role="tab">
                                                <div class="panel-title single-schedule-title">
                                                    <a class="" data-toggle="collapse" data-parent="#accordion-2"
                                                       href="#schedule-2-2">
                                                        <div class="row no-margin">
                                                            <div class="col-sm-3 no-padding">
                                                                <h5>02:00 Pm - 05:00PM</h5>
                                                            </div>
                                                            <div class="col-sm-9 no-padding">
                                                                <h5>Where to start with material Design</h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div id="schedule-2-2" class="panel-collapse collapse" role="tabpanel">
                                                <div class="panel-body">
                                                    <div class="row no-margin">
                                                        <div class="col-sm-3 no-padding">
                                                            <div class="schedule-img">
                                                                <img :src="'images/schedule/1.jpg'" alt="schedule"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9 no-padding">
                                                            <div class="schedule-info">
                                                                <p>Material Design is a new Design language Invented by
                                                                    google & its going to rules design industry for few
                                                                    next years. So I think Every Designer Should have
                                                                    some or at least a little bot of knowledge about
                                                                    material design.</p>
                                                                <h5><span>With</span> : Zarina Kame <small>Designer at
                                                                    <a href="">Google</a></small></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.single-schedule -->
                                    </div><!-- /.panel-group -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.schedule-details -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.schedules -->
        </div>
    </div><!-- /.schedule-area -->
</template>


<script>
import ProgramRow from "../components/ProgramRow.vue";

export default {
    components: {
        ProgramRow
    },
}
</script>
