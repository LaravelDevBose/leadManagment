<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header bg-info d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title text-white font-weight-bold">Contact Us Details</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <alert-messages></alert-messages>
                            <form-area @submitted="submitForm">
                                <template #form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <jet-label for="address" value="Address" />
                                            <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address"  :required="true" :placeholder="'Enter full address'" />
                                            <jet-input-error :message="form.error('address')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="email" value="Email" />
                                            <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email"  :required="true" :placeholder="'Enter email address'" />
                                            <jet-input-error :message="form.error('email')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="phone_no" value="Phone no." />
                                            <jet-input id="phone_no" type="text" class="mt-1 block w-full" v-model="form.phone_no"  :required="true" :placeholder="'Enter phone no'"/>
                                            <jet-input-error :message="form.error('phone_no')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="fax_no" value="Fax no." />
                                            <jet-input id="fax_no" type="text" class="mt-1 block w-full" v-model="form.fax_no"  :required="true" :placeholder="'Enter fax no'" />
                                            <jet-input-error :message="form.error('fax_no')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="open_date" value="Open day period" />
                                            <jet-input id="open_date" type="text" class="mt-1 block w-full" v-model="form.open_date"  :required="true" :placeholder="'Tuesday - Friday'" />
                                            <jet-input-error :message="form.error('open_date')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="open_time" value="Open time period" />
                                            <jet-input id="open_time" type="text" class="mt-1 block w-full" v-model="form.open_time"  :required="true" :placeholder="'10 AM - 5 PM EST'" />
                                            <jet-input-error :message="form.error('open_time')" class="mt-2" />
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
import AlertMessages from "../../../Component/Include/AlertMessages";

export default {
    name: "ContactUsPage",
    props:['setting'],
    components: {
        AlertMessages,
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
                address: '',
                email: '',
                phone_no:'',
                fax_no:'',
                open_date:'Tuesday - Friday',
                open_time: '10 AM - 5 PM EST',
            }, {
                bag: 'contactUsForm',
                resetOnSuccess: false,
            }),
        }
    },
    mounted() {
        if (this.setting){
            this.form.address = this.setting.data.address;
            this.form.email = this.setting.data.email;
            this.form.phone_no = this.setting.data.phone_no;
            this.form.fax_no = this.setting.data.fax_no;
            this.form.open_date = this.setting.data.open_date;
            this.form.open_time = this.setting.data.open_time;
        }
    },
    methods:{
        submitForm() {
            this.form.post(route('admin.contact_us.update'), {
                preserveScroll: true
            });
        },
    }
}
</script>

<style scoped>

</style>
