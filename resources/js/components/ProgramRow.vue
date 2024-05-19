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
                                    <h5>{{ schedule.time }}</h5>
                                </div>
                                <div class="col-sm-9 no-padding">
                                    <h5>{{ schedule.title }}</h5>
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
                                    <img :src="'images/schedule/' + schedule.image" alt="schedule"/>
                                </div>
                            </div>
                            <div class="col-sm-9 no-padding">
                                <div class="schedule-info">
                                    <p>{{ schedule.description }}</p>
                                    <h5><span>With</span> : {{ schedule.presenter }} <small>Designer at <a href="">{{ schedule.company }}</a></small></h5>
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
export default {
    props: {
        id: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            scheduleItems: [
                {
                    id: 1,
                    time: '09:00 AM - 02:00 PM',
                    title: 'Introducing Material Design',
                    image: '1.jpg',
                    description: 'some description',
                    presenter: 'Zarina Kame',
                    company: 'Google'
                },
                {
                    id: 6,
                    time: '02:00 PM - 05:00 PM',
                    title: 'Where to Start with Material Design',
                    image: '1.jpg',
                    description: 'Material Design is a new Design language Invented by Google & its going to rule design industry for the next few years. So I think Every Designer Should have some or at least a little bot of knowledge about material design.',
                    presenter: 'Peter Kame',
                    company: 'Google'
                },
                {
                    id: 6,
                    time: '02:00 PM - 05:00 PM',
                    title: 'Kdawdwa',
                    image: '1.jpg',
                    description: 'So I think Every Designer Should have some or at least a little bot of knowledge about material design.',
                    presenter: 'Jan Kame',
                    company: 'Google'
                }
            ]
        };
    },
    computed: {
        filteredScheduleItems() {
            return this.scheduleItems.filter(item => item.id === this.id);
        }
    }
};
</script>
