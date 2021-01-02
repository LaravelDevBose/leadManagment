<template>
    <app-layout class="bg-gray-50">
        <template v-slot:header>
            <div class="section-title contact_head pt-3">
                <h1>Apply For Service</h1>
            </div>
        </template>
        <div class="card" style="width: 100%">
            <form @submit.prevent="registerLead">
                <div class="card-body">
                    <div class="row" v-if="$page.flash.success || $page.flash.error">
                        <div class="col-12">
                            <jet-action-message :on="$page.flash.success">
                                <div class="alert alert-success">
                                    {{ $page.flash.success}}
                                    <button type="button" class="close" aria-label="Close" @click.prevent="closeAlertMsg">
                                        <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
                                    </button>
                                </div>
                            </jet-action-message>
                            <jet-action-message :on="$page.flash.error">
                                <div class="alert alert-danger">
                                    {{ $page.flash.error}}
                                    <button type="button" class="close" data-dismiss="modal" @click.prevent="closeAlertMsg">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </jet-action-message>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="name" value="Name" />
                                <jet-input id="name" type="text" class="mt-1 block w-full rounded-0" v-model="form.full_name" autocomplete="name" :required="true" />
                                <jet-input-error :message="form.error('full_name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="email" value="Email" />
                                <jet-input id="email" type="email" class="mt-1 block w-full rounded-0" v-model="form.email"  :required="true" />
                                <jet-input-error :message="form.error('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="phone" value="Phone No." />
                                <jet-input id="phone" type="text" class="mt-1 block w-full rounded-0" v-model="form.phone_no" :required="true" />
                                <jet-input-error :message="form.error('phone_no')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="address" value="Address" />
                                <jet-input id="address" type="text" class="mt-1 block w-full rounded-0" v-model="form.address"  :required="true" />
                                <jet-input-error :message="form.error('address')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <jet-label for="city" value="City" />
                                <jet-input id="city" type="text" class="mt-1 block w-full rounded-0" v-model="form.city" :required="true"  />
                                <jet-input-error :message="form.error('city')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <jet-label for="state" value="State" />
                                <jet-input id="state" type="text" class="mt-1 block w-full rounded-0" v-model="form.state" :required="true"  />
                                <jet-input-error :message="form.error('state')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <jet-label for="postal_code" value="Zip Code" />
                                <jet-input id="postal_code" type="text" class="mt-1 block w-full rounded-0" v-model="form.postal_code" :required="true"  />
                                <jet-input-error :message="form.error('postal_code')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Submit
                    </jet-button>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
export default {
    name: "CustomerRegister",
    components: {
        AppLayout,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },
    data() {
        return {
            form: this.$inertia.form({
                full_name: '',
                email: '',
                phone_no:'',
                address:'',
                city:'',
                state:'',
                postal_code:''
            }, {
                bag: 'registerLead',
                resetOnSuccess: false,
            }),
        }
    },

    methods: {
        registerLead() {
            this.form.post(route('lead.store'), {
                preserveScroll: true
            });
        },

    },
}
</script>

<style scoped>

</style>
