<template>
            <div class="schedules">
                <div class="row no-margin">
                    <div class="col-md-3 no-padding">
                        <div class="schedule-title">
                            <h5>STAGE</h5>
                        </div>
                        <div class="schedule-date">
                            <ul class="nav nav-tabs" role="tablist">
                                <li v-if="stages" v-for="(stage, index) in stages" :key="index" :class="{ active: index === 0 }">
                                    <a :href="'#stage-' + stage.id" data-toggle="tab">
                                        <h4>{{ stage.name }}</h4>
                                        <h5>{{ stage.datum }}</h5>
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
                                <div v-for="stage in stages" :key="stage.id" :id="'stage-' + stage.id" class="tab-pane" role="tabpanel">
                                    <div class="panel-group" :id="'accordion-' + (stage.id + 1)" role="tablist">
                                        <ProgramRow :id="Number(stage.id)"></ProgramRow>
                                    </div><!-- /.panel-group -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.schedule-details -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.schedules -->

</template>

<script>
import { useStageStore } from '@/stores/stageStore';
import ProgramRow from "./ProgramRow.vue";

export default {
    components: {ProgramRow},
    data() {
        return {
            loading: true,
            stages: [],
        };
    },
    created() {
        this.fetchStages();
    },
    methods: {
        async fetchStages() {
            try {
                const stageStore = useStageStore();
                if(stageStore.stages.length === 0)  await stageStore.fetchStages();
                this.stages = stageStore.stages;
            } catch (error) { console.error('Error fetching stages:', error);} finally {this.loading = false;}
        },
    },
};
</script>
