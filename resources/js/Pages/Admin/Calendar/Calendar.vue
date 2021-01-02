<template>
    <app-admin-layout>
        <b-container fluid>
            <alert-messages></alert-messages>
            <b-row>
                <b-col cols="3">
                    <create-update :schedule="schedule"></create-update>
                </b-col>
                <b-col cols="9">
                    <b-row>
                        <b-col cols="12">
                            <div class="iq-card mb-0" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0" id="menu">
                                <div id="menu-navi" class="iq-card-body d-flex align-items-center justify-content-between" @click="onClickNavi($event)">
                                    <button type="button" class="btn mr-1 btn-outline-primary" data-action="move-today">Today</button>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-link iq-bg-primary" data-action="move-prev">
                                            <i class="fa fa-chevron-left mr-0" data-action="move-prev" />
                                        </button>
                                        <h5 id="renderRange" class="render-range mt-1 mx-4">{{ dateRange }}</h5>
                                        <button type="button" class="btn btn-link iq-bg-primary" data-action="move-next">
                                            <i class="fa fa-chevron-right mr-0" data-action="move-prev" />
                                        </button>
                                    </div>
<!--                                    <div>
                                        <b-form-radio-group
                                            id="btn-radios-1"
                                            v-model="selectedView"
                                            :options="viewModeOptions"
                                            buttons
                                            button-variant="primary"
                                            name="radios-btn-default"
                                        ></b-form-radio-group>
                                    </div>-->
                                </div>
                            </div>
                        </b-col>
                        <b-col cols="12">
                            <calendar style="height: 800px" id="calender"
                                      ref="tuiCal"
                                      :useDetailPopup="useDetailPopup"
                                      :view="selectedView"
                                      :schedules="scheduleList"
                                      :template="template"
                                      :taskView="true"
                                      :scheduleView="true"
                                      :month="month"
                                      :week="week"
                                      :disableDblClick="disableDblClick"
                                      :isReadOnly="isReadOnly"
                                      :useCreationPopup="useCreationPopup"
                                      @clickSchedule="onClickSchedule"
                                      @clickDayname="onClickDayname"
                                      @beforeUpdateSchedule="onBeforeUpdateSchedule"
                                      @beforeDeleteSchedule="onBeforeDeleteSchedule"
                            />
                        </b-col>
                    </b-row>
                </b-col>
            </b-row>
        </b-container>
    </app-admin-layout>
</template>
<script>
import 'tui-time-picker/dist/tui-time-picker.css'
import 'tui-date-picker/dist/tui-date-picker.css'
import 'tui-calendar/dist/tui-calendar.css'
import { Calendar } from '@toast-ui/vue-calendar'
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import CreateUpdate from "./CreateUpdate";
import Event from './Event'
import AlertMessages from "../../../Component/Include/AlertMessages";
export default {
    name: 'Calendar',
    props:['schedules'],
    components: {
        AlertMessages,
        CreateUpdate,
        AppAdminLayout,
        calendar: Calendar
    },
    data () {
        return {
            viewModeOptions: [
                {
                    text: 'Monthly',
                    value: 'month'
                },
                {
                    text: 'Week',
                    value: 'week'
                },
                {
                    text: 'Day',
                    value: 'day'
                }
            ],
            dateRange: '',
            selectedView: 'month',
            calendarList: [],
            scheduleList: [],
            template: {
                milestone (schedule) {
                    return `<span style="color:#3F3F3F;background-color: ${schedule.bgColor};">${schedule.title}</span>`
                },
                milestoneTitle () {
                    return '<span class="tui-full-calendar-left-content">Milestone</span>'
                },
                allday (schedule) {
                    return `<i class="fa fa-users"></i> ${schedule.title}`
                },
                alldayTitle () {
                    return '<span class="tui-full-calendar-left-content">All Day</span>'
                }
            },
            month: {
                startDayOfWeek: 0
            },
            week: {
                showTimezoneCollapseButton: true,
                timezonesCollapsed: true
            },
            taskView: true,
            scheduleView: true,
            useDetailPopup: true,
            disableDblClick: true,
            useCreationPopup: false,
            isReadOnly: false,
            schedule: '',
            deleteEventForm: this.$inertia.form({
                '_method': 'DELETE',
            }, {
                bag: 'deleteEventForm',
                resetOnSuccess: false,
            }),
        }
    },
    watch: {
        selectedView (newValue) {
            this.$refs.tuiCal.invoke('changeView', newValue, true)
            this.setRenderRangeText()
        },
        checkSchedulesData:{
            handler(newValue, oldValue){
                if(oldValue !== newValue){
                    console.log('ererer');
                    this.updateScheduleList();
                }
            },
            deep:true,
        },
    },
    methods: {
        init () {
            this.setRenderRangeText()
        },
        setRenderRangeText () {
            console.log('setRenderRangeText');
            const { invoke } = this.$refs.tuiCal
            const view = invoke('getViewName')
            const calDate = invoke('getDate')
            const rangeStart = invoke('getDateRangeStart')
            const rangeEnd = invoke('getDateRangeEnd')
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
            let year = calDate.getFullYear()
            let month = calDate.getMonth();
            let date = calDate.getDate()
            let dateRangeText = ''
            let endMonth, endDate, start, end
            switch (view) {
                case 'month':
                    dateRangeText = `${months[month]} ${year}`
                    break
                case 'week':
                    year = rangeStart.getFullYear()
                    month = rangeStart.getMonth()+1
                    date = rangeStart.getDate()
                    endMonth = rangeEnd.getMonth()+1
                    endDate = rangeEnd.getDate()
                    start = `${months[month]} ${date}`
                    end = `${endDate} ${months[endMonth]}, ${year}`
                    dateRangeText = `${start} - ${end}`
                    break
                default:
                    dateRangeText = `${date} ${months[month]} ${year}`
            }
            this.dateRange = dateRangeText
        },
        onClickNavi (event) {
            console.log('onClick navi');
            if (event.target.tagName === 'BUTTON' || event.target.tagName === 'I') {
                const { target } = event
                let action = target.dataset ? target.dataset.action : target.getAttribute('data-action')
                action = action.replace('move-', '')
                this.$refs.tuiCal.invoke(action)
                this.setRenderRangeText()
            }
        },
        onClickSchedule (res) {
             console.group('onClickSchedule')
            console.log('MouseEvent : ', res.event)
            console.log('Calendar Info : ', res.calendar)
            console.log('Schedule Info : ', res.schedule)
            console.groupEnd()
        },
        onClickDayname (res) {
            console.log('onClickDayname');
            // view : week, day
            /* console.group('onClickDayname')
            console.log(res.date)
            console.groupEnd() */
        },
        onBeforeUpdateSchedule (res) {
           this.scheduleList.findIndex(item => {
                if (item.id === res.schedule.id){
                    this.schedule = item;
                }
            });
        },
        onBeforeDeleteSchedule (res) {
            console.log('onBeforeDeleteSchedule');
            const idx = this.scheduleList.findIndex(item => item.id === res.schedule.id)
            this.deleteEventForm.post(route('admin.schedule.destroy', this.scheduleList[idx].id),{
                preserveScroll: true,
                onSuccess: () => {
                    this.scheduleList.splice(idx, 1);
                },
                onError: (errors) => {
                    // Handle validation errors
                },
            })

        },
        updateScheduleList(){
            this.schedules.filter(value =>{
                const schedule = new Event(value);
                this.scheduleList.push(schedule);
            })
        }
    },
    computed:{
        checkSchedulesData(){
            return JSON.parse(JSON.stringify(this.schedules))
        }
    },
    mounted () {
        this.init()
        this.updateScheduleList();
    }
}
</script>
