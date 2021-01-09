<template>
  <div class="modal fade" :class="{'open':showEvent}" id="DetaileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" @click="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card iq-mb-3">
                    <div class="card-body p-0">
                        <h4 class="card-title mb-1 text-capitalize">{{ event.title }}</h4>
                        <p class="card-text"><i class="ri-calendar-todo-fill text-size-20 text-primary"></i>: <small class="text-muted">{{ event.start | formated('DD-MMM-YYYY hh:mm A') }}</small></p>
                        <p class="card-text"><i class="ri-briefcase-4-fill text-size-20 text-primary"></i>: {{ event.body }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" @click="editItem" class="btn btn-sm btn-info">Edit</button>
                <button type="button" @click="deleteItem" class="btn btn-sm btn-danger">Delete</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

export default {
    name: 'Show',
    props:{
        event: {
            type: Object,
            default: function(){}
        },
        showEvent: {
            type: Boolean,
            default: false,
        }
    },
    created() {
        dayjs.extend(relativeTime);
    },
    filters: {

        formated: (date, format) => {
            if (!date){
                return null;
            }

            return dayjs(date).format(format);
        }
    },
    mounted(){
        console.log(this.event);
    },
    methods:{
        editItem(){
            this.$emit('editEvent', this.event.id);
        },
        deleteItem(){
            this.$emit('deleteEvent', this.event.id);
        },
        close(){
            this.$emit('closeModal', false);
        }
    },
    computed:{
        checkEventData(){
            return JSON.parse(JSON.stringify(this.event))
        }
    }

}
</script>

<style>

</style>