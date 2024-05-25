<template>
    <div>
        <div class="panel-group" :id="'accordion-' + id" role="tablist">
            <!-- ROW -->
            <div v-for="(schedule, index) in filteredScheduleItems" :key="index" class="single-schedule panel panel-default">
                <div class="panel-heading" role="tab">
                    <div class="panel-title single-schedule-title">
                        <a class="collapsed" data-toggle="collapse" :href="'#schedule-' + id + '-' + index" :data-parent="'#accordion-' + id">
                            <div class="row no-margin">
                                <div class="col-sm-3 no-padding">
                                    <h5>{{ schedule.cas }} </h5>
                                </div>
                                <div class="col-sm-9 no-padding">
                                    <h5>{{ schedule.nazov_prednasky }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- CONTENT -->
                <div :id="'schedule-' + id + '-' + index" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="row no-margin">
                            <div class="col-sm-3 no-padding">
                                <div class="schedule-img">
                                    <!--<img :src="'images/schedule/' + schedule.image" alt="schedule"/>-->
                                </div>
                            </div>
                            <div class="col-sm-9 no-padding">
                                <div class="schedule-info">
                                    <p>{{ schedule.popis }}</p>
                                    <h5><span>With</span> : {{ schedule.speaker.meno }} <small>Designer at <a href="">company</a></small></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.single-schedule -->
        </div><!-- /.panel-group -->
    </div>
</template>

<script>
import { useProgramStore } from '@/stores/programStore';
export default {
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    created() {
        this.fetchPrograms();
    },
    methods: {
        async fetchPrograms() {
            try {
                const programStore = useProgramStore();
                if(programStore.program.length === 0)  await programStore.fetchPrograms();
                this.programs = programStore.program;
            } catch (error) { console.error('Error fetching programs:', error);} finally {this.loading = false;}
        },
    },
    data() {
        return {
            programs: [],
            loading: true
        };
    },
    computed: {
        filteredScheduleItems() {
            return this.programs.filter(item => item.stage_id === this.id);
        }
    }
};
</script>
