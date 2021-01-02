<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header bg-info d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title text-white font-weight-bold">Testimonial Form</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form-area @submitted="submitServiceForm">
                                <template #form>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <jet-label for="client_name" value="Client Name" />
                                            <jet-input id="client_name" type="text" class="mt-1 block w-full" v-model="form.client_name"  :required="true" />
                                            <jet-input-error :message="form.error('client_name')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-12">
                                            <jet-label for="testimonial_details" value="Details" />
                                            <textarea id="testimonial_details" class="form-control mt-1 block w-full" v-model="form.testimonial_details"  rows="5" style="line-height: 22px;"> </textarea>
                                            <jet-input-error :message="form.error('testimonial_details')" class="mt-2" />
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
    props:['testimonial'],
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
                client_name: '',
                testimonial_details: '',
            }, {
                bag: 'testimonialForm',
                resetOnSuccess: false,
            }),
            isEdit: false,
        }
    },
    mounted() {
        if (this.testimonial){
            this.isEdit = true;
            this.form.client_name = this.testimonial.client_name;
            this.form.testimonial_details = this.testimonial.testimonial_details;
        }
    },
    methods:{
        submitServiceForm() {
            if (this.isEdit){
                this.form._method='PUT';
                this.form.post(route('admin.testimonials.update', this.testimonial.id), {
                    preserveScroll: true
                });
            }else{
                this.form.post(route('admin.testimonials.store'), {
                    preserveScroll: true
                });
            }

        },
    }
}
</script>

<style scoped>

</style>
