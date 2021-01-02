<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header bg-info d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title text-white font-weight-bold">Service Form</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form-area @submitted="submitServiceForm">
                                <template #form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <jet-label for="service_title" value="Service Title" />
                                            <jet-input id="service_title" type="text" class="mt-1 block w-full" v-model="form.service_title"  :required="true" />
                                            <jet-input-error :message="form.error('service_title')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="service_icon" value="Service Icon" />
                                            <jet-input id="service_icon" type="text" class="mt-1 block w-full" v-model="form.service_icon"  :required="true" :placeholder="'far fa-cag'" />
                                            <a href="https://fontawesome.com/icons?d=gallery" target="_blank" class="text-blue-800">Find Icon: https://fontawesome.com/icons?d=gallery</a>
                                            <jet-input-error :message="form.error('service_icon')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-12">
                                            <jet-label for="service_details" value="Details" />
                                            <textarea id="service_details" class="form-control mt-1 block w-full" v-model="form.service_details"  rows="5" style="line-height: 22px;"> </textarea>
                                            <jet-input-error :message="form.error('service_details')" class="mt-2" />
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
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
export default {
    name: "CreateUpdate",
    props:['service'],
    components: {
        AppAdminLayout,
        FormArea,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    data(){
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                service_title: '',
                service_icon: '',
                service_details:'',
            }, {
                bag: 'serviceForm',
                resetOnSuccess: false,
            }),
            isEdit: false,
        }
    },
    mounted() {
        if (this.service){
            this.isEdit = true;
            this.form.service_title = this.service.service_title;
            this.form.service_icon = this.service.service_icon;
            this.form.service_details = this.service.service_details;
        }
    },
    methods:{
        submitServiceForm() {
            if (this.isEdit){
                this.form._method='PUT';
                this.form.post(route('admin.services.update', this.service.id), {
                    preserveScroll: true
                });
            }else{
                this.form.post(route('admin.services.store'), {
                    preserveScroll: true
                });
            }

        },
    }
}
</script>

<style scoped>

</style>
