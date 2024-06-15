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
                                    <h5>{{ schedule.sloty.od.split(":")[0] }}:{{ schedule.sloty.od.split(":")[1] }}-{{ schedule.sloty.do.split(":")[0] }}:{{ schedule.sloty.do.split(":")[1] }} </h5>
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
                                    <template v-if="schedule.speaker">
                                        <img :src="'data:image/jpeg;base64,' + schedule.speaker.photo" alt="schedule"/>
                                    </template>
                                    <template v-else>
                                        <img :src="'images/speakers/nconnect.jpg'" alt="nconnect"/>
                                    </template>
                                </div>
                            </div>
                            <div class="col-sm-9 no-padding">
                                <div class="schedule-info">
                                    <p>{{ schedule.popis }}</p>
                                    <h5>{{ schedule.speaker ? "Speaker: "+schedule.speaker.meno : "" }}
                                        <template v-if="schedule.speaker">
                                            <a target="_blank" style="padding-left: 60px" :href="schedule.speaker.company_link">{{schedule.speaker.company_name}}</a>
                                        </template>
                                    </h5>
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
