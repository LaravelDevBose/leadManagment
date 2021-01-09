<template>
  <div class="media align-items-center">
        <div class="media-body">
            <h6
                class="mb-0 text-capitalize"
                :class="notification.read_at != null ? 'text-gray' : 'text-primary'"
            >
                {{ notification.data.first_name +' '+ notification.data.last_name}} Send New Message
            </h6>
            <small class="float-right font-size-12">{{ notification.created_at | diffForHumans }}</small>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
export default {
    name: 'NewContactMessageNotification',
    props:['notification'],
    created() {
        dayjs.extend(relativeTime);
    },
    
    filters: {
        diffForHumans: (date) => {
            if (!date){
                return null;
            }

            return dayjs(date).fromNow();
        }
    },
}
</script>

<style>

</style>