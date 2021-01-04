<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="iq-card">
                        <div class="iq-card-header bg-info d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title text-white font-weight-bold">Employee & Admin Form</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form-area @submitted="submitForm">
                                <template #form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <jet-label for="name" value="Full Name" />
                                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name"  :required="true" />
                                            <jet-input-error :message="form.error('name')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-6">
                                            <jet-label for="email" value="Email" />
                                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email"  :required="true" />
                                            <jet-input-error :message="form.error('email')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4" v-if="!isEdit">
                                            <jet-label for="password" value="Password" />
                                            <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password"  :required="true" />
                                            <jet-input-error :message="form.error('password')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4" v-if="!isEdit">
                                            <jet-label for="password_confirmation" value="Confirm Password" />
                                            <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation"  :required="true" />
                                            <jet-input-error :message="form.error('password_confirmation')" class="mt-2" />
                                        </div>
                                        <div class="col-sm-4">
                                            <jet-label for="role" value="User Role" />
                                            <select class="form-control mt-1 block w-full" v-model="form.role" id="role">
                                                <option v-for="(role, index) of roles" :value="index">{{ role }}</option>
                                            </select>
                                            <jet-input-error :message="form.error('role')" class="mt-2" />
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
    props:['userdata', 'roles'],
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
                name: '',
                email: '',
                role: '',
                password: '',
                password_confirmation:'',
            }, {
                bag: 'userFormBag',
                resetOnSuccess: false,
            }),
            isEdit: false,
        }
    },
    mounted() {
        if (this.userdata){
            this.isEdit = true;
            this.form.name = this.userdata.name;
            this.form.email = this.userdata.email;
            this.form.role = this.userdata.role;
        }
    },
    methods:{
        submitForm() {
            if (this.isEdit){
                this.form._method='PUT';
                this.form.post(route('admin.users.update', this.userdata.id), {
                    preserveScroll: true
                });
            }else{
                this.form.post(route('admin.users.store'), {
                    preserveScroll: true
                });
            }

        },
    }
}
</script>

<style scoped>

</style>
