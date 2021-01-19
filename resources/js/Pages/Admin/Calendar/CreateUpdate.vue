<template>
    <div class="iq-card ">
        <div class="iq-card-header bg-primary d-flex justify-content-between rounded">
            <div class="iq-header-title">
                <h4 class="card-title text-white font-weight-bold">Schedule</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form-area @submitted="submitServiceForm">
                <template #form>
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title"  :required="true" :placeholder="'Schedule Title'" />
                            <jet-input-error :message="form.error('title')" class="mt-2" />
                        </div>
                        <div class="col-sm-12 mt-1">
                            <flat-pickr id="start" v-model="form.start" class="mt-1 block w-full form-input rounded-md shadow-sm"  :config="basicTimeConfig" placeholder="Select DateTime"></flat-pickr>
                            <jet-input-error :message="form.error('start')" class="mt-2" />
                        </div>
                        <div class="col-sm-12 mt-1">
                            <textarea id="mail_body" class="mt-1 block w-full form-input rounded-md shadow-sm" v-model="form.body" placeholder="Schedule Details" rows="3" style="line-height: 22px;"> </textarea>
                            <jet-input-error :message="form.error('body')" class="mt-2" />
                        </div>
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </jet-button>
                </template>
            </form-area>
        </div>
    </div>
</template>

<script>
import FormArea from "../../../Component/Form/FormArea";
import JetButton from '@/Jetstream/Button';
import JetFormSection from '@/Jetstream/FormSection';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import VueFlatPicker from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
export default {
    name: "CreateUpdate",
    props:['schedule'],
    components: {
        FormArea,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        'flat-pickr':VueFlatPicker
    },
    data(){
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                title: '',
                start: '',
                body: '',
            }, {
                bag: 'scheduleForm',
                resetOnSuccess: true,
            }),
            isEdit: false,
            basicTimeConfig: {
                dateFormat: 'Y-m-d'
            }
        }
    },
    methods:{
        submitServiceForm() {
            if (this.isEdit){
                this.form._method='PUT';
                this.form.post(route('admin.schedule.update', this.schedule.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                       // window.location.reload();
                    },
                    onError: (errors) => {
                        // Handle validation errors
                    },
                },
                );
            }else{
                this.form.post(route('admin.schedule.store'), {
                    preserveScroll: true,
                });
            }

        },
    },
    computed:{
        checkScheduleData(){
            return JSON.parse(JSON.stringify(this.schedule))
        }
    },
    watch:{
        checkScheduleData:{
            handler(newValue, oldValue){
                if(oldValue !== newValue){
                    console.log('update '+this.schedule);
                    this.isEdit = true;
                    this.form.title = this.schedule.title;
                    this.form.start = this.schedule.start;
                    this.form.body = this.schedule.body;
                }
            },
            deep:true,
        },
    }
}
</script>

<style scoped>

</style>
