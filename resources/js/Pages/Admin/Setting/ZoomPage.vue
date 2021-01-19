<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header bg-info d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title text-white font-weight-bold">Zoom Meeting Url</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <alert-messages></alert-messages>
                            <form-area @submitted="submitForm">
                                <template #form>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <jet-label for="details" value="Zoom meeting Url" />
                                            <textarea id="details" class="form-control mt-1 block w-full" v-model="form.zoom_url"  rows="2" style="line-height: 22px;"> </textarea>
                                            <jet-input-error :message="form.error('zoom_url')" class="mt-2" />
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
                </div>
            </div>
        </div>
    </app-admin-layout>
</template>

<script>
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import FormArea from "../../../Component/Form/FormArea";
import JetButton from '@/Jetstream/Button';
import JetFormSection from '@/Jetstream/FormSection';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import AlertMessages from "../../../Component/Include/AlertMessages";

export default {
    name: "AboutUsPage",
    props:['setting'],
    components: {
        AlertMessages,
        AppAdminLayout,
        FormArea,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    data(){
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                zoom_url: '',
            }, {
                bag: 'aboutUsForm',
                resetOnSuccess: false,
            }),
            isEdit: false,
        }
    },
    mounted() {
        if (this.setting){
            this.form.zoom_url = this.setting.data.zoom_url;
        }
    },
    methods:{
        submitForm() {
            this.form.post(route('admin.zoom_meeting.update'), {
                preserveScroll: true
            });
        },
    }
}
</script>

<style scoped>

</style>
