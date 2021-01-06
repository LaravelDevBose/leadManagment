<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header bg-info d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title text-white font-weight-bold">Create Client</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form-area @submitted="submit">
                                <template #form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <jet-label for="first_name" value="First Name" />
                                            <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="personalInfoForm.first_name" autocomplete="name" :required="true" />
                                            <jet-input-error :message="personalInfoForm.error('first_name')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="last_name" value="Last Name" />
                                            <jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="personalInfoForm.last_name" autocomplete="name" :required="true" />
                                            <jet-input-error :message="personalInfoForm.error('last_name')" class="mt-2" />
                                        </div>
                                        <!-- Email -->
                                        <div class="col-sm-6">
                                            <jet-label for="email" value="Email" />
                                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="personalInfoForm.email"  :required="true" />
                                            <jet-input-error :message="personalInfoForm.error('email')" class="mt-2" />
                                        </div>

                                        <div class="col-sm-6">
                                            <jet-label for="phone" value="Phone No." />
                                            <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="personalInfoForm.phone_no" :required="true" />
                                            <jet-input-error :message="personalInfoForm.error('phone_no')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-12">
                                            <jet-label for="address" value="Address" />
                                            <jet-input id="address" type="text" class="mt-1 block w-full" v-model="personalInfoForm.address"  :required="true" />
                                            <jet-input-error :message="personalInfoForm.error('address')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4">
                                            <jet-label for="city" value="City" />
                                            <jet-input id="city" type="text" class="mt-1 block w-full" v-model="personalInfoForm.city" :required="true"  />
                                            <jet-input-error :message="personalInfoForm.error('city')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4">
                                            <jet-label for="state" value="State" />
                                            <jet-input id="state" type="text" class="mt-1 block w-full" v-model="personalInfoForm.state" :required="true"  />
                                            <jet-input-error :message="personalInfoForm.error('state')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4">
                                            <jet-label for="postal_code" value="Zip Code" />
                                            <jet-input id="postal_code" type="text" class="mt-1 block w-full" v-model="personalInfoForm.postal_code" :required="true"  />
                                            <jet-input-error :message="personalInfoForm.error('postal_code')" class="mt-2" />
                                        </div>
                                    </div>
                                </template>

                                <template #actions>
                                    <jet-action-message :on="personalInfoForm.recentlySuccessful" class="mr-3">
                                        Saved.
                                    </jet-action-message>

                                    <jet-button :class="{ 'opacity-25': personalInfoForm.processing }" :disabled="personalInfoForm.processing">
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
    name: "Create",
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
            personalInfoForm: this.$inertia.form({
                first_name: '',
                last_name: '',
                email: '',
                phone_no:'',
                address:'',
                city:'',
                state:'',
                postal_code:''
            }, {
                bag: 'leadForm',
                resetOnSuccess: false,
            }),
        }
    },
    methods:{
        submit() {
            this.personalInfoForm.post(route('admin.lead.store'), {
                preserveScroll: true
            });
        },
    }
}
</script>

<style scoped>

</style>
