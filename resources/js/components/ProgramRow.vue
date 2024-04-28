<template>
    <div class="single-schedule panel panel-default">
        <div class="panel-heading" role="tab">
            <div class="panel-title single-schedule-title">
                <a class="collapsed" data-toggle="collapse"
                   data-parent="#accordion-2" href="#schedule-2-1"><!--class collapsed 2-2 2-3-->
                    <div class="row no-margin">
                        <div class="col-sm-3 no-padding">
                            <h5>09:00 Am - 02:00PM</h5>
                        </div>
                        <div class="col-sm-9 no-padding">
                            <h5>Introduceing Material Design</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div id="schedule-2-1" class="panel-collapse collapse in" role="tabpanel"> <!--schedule 2-2 -->
            <div class="panel-body">
                <div class="row no-margin">
                    <div class="col-sm-3 no-padding">
                        <div class="schedule-img">
                            <img :src="'images/schedule/1.jpg'" alt="schedule"/> <!--imagee-->
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
</template>

<script>

</script>
