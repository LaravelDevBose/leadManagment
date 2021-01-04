<template>
    <div class="row" v-if="$page.flash.success || $page.flash.error">
        <div class="col-12">
            <jet-action-message :on="$page.flash.success && $page.flash.success != null">
                <div class="alert alert-success">
                    {{ $page.flash.success}}
                    <button type="button" class="close text-danger float-right" aria-label="Close" @click.prevent="closeAlertMsg">
                        <span aria-hidden="true" class="font-weight-bold">&times;</span>
                    </button>
                </div>
            </jet-action-message>
            <jet-action-message :on="$page.flash.error && $page.flash.error != null">
                <div class="alert alert-danger">
                    {{ $page.flash.error}}
                    <button type="button" class="close text-danger float-right" data-dismiss="modal" @click.prevent="closeAlertMsg">
                        <span class="font-weight-bold " aria-hidden="true">&times;</span>
                    </button>
                </div>
            </jet-action-message>
        </div>
    </div>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage';
export default {
    name: "AlertMessages",
    components:{JetActionMessage},
    methods:{
        closeAlertMsg: function () {
            this.$page.flash.success = null;
            this.$page.flash.error = null;
        }
    }
}
</script>

<style scoped>
.alert .close{
    margin-left: auto!important;
    font-size: 1.5rem;
}
</style>
