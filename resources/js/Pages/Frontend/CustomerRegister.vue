<template>
    <app-layout class="bg-gray-50">
        <template v-slot:header>
            <div class="section-title contact_head pt-3">
                <h1 style="font-size: 2rem;font-weight: bold">{{ lang.title}}</h1>
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
                        <div class="col-sm-12">
                            <div class="float-right">
                                <button
                                    type="button"
                                    class="btn mb-3"
                                    :class="selectedLang ==='spanish'? 'btn-my': 'btn-outline-my'"
                                    @click.prevent="selectLang('spanish')"
                                >Spanish</button>
                                <button
                                    type="button"
                                    class="btn mb-3"
                                    :class="selectedLang ==='english'? 'btn-my': 'btn-outline-my'"
                                    @click.prevent="selectLang('english')"
                                >English</button>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="first_name" :value="lang.first_name" />
                                <jet-input id="first_name" type="text" class="mt-1 block w-full rounded-0" v-model="form.first_name" autocomplete="first_name" :required="true" />
                                <jet-input-error :message="form.error('first_name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="last_name" :value="lang.last_name" />
                                <jet-input id="last_name" type="text" class="mt-1 block w-full rounded-0" v-model="form.last_name" autocomplete="last_name" :required="true" />
                                <jet-input-error :message="form.error('last_name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="email" :value="lang.email" />
                                <jet-input id="email" type="email" class="mt-1 block w-full rounded-0" v-model="form.email"  :required="false" />
                                <jet-input-error :message="form.error('email')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <jet-label for="phone" :value="lang.phone" />
                                <jet-input id="phone" type="text" class="mt-1 block w-full rounded-0" v-model="form.phone_no" :required="true" />
                                <jet-input-error :message="form.error('phone_no')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <jet-label for="address" :value="lang.address" />
                                <jet-input id="address" type="text" class="mt-1 block w-full rounded-0" v-model="form.address"  :required="true" />
                                <jet-input-error :message="form.error('address')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <jet-label for="city" :value="lang.city" />
                                <jet-input id="city" type="text" class="mt-1 block w-full rounded-0" v-model="form.city" :required="true"  />
                                <jet-input-error :message="form.error('city')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <jet-label for="state" :value="lang.state" />
                                <jet-input id="state" type="text" class="mt-1 block w-full rounded-0" v-model="form.state" :required="true"  />
                                <jet-input-error :message="form.error('state')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <jet-label for="postal_code" :value="lang.zip" />
                                <jet-input id="postal_code" type="text" class="mt-1 block w-full rounded-0" v-model="form.postal_code" :required="true"  />
                                <jet-input-error :message="form.error('postal_code')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-right">
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        {{ lang.submit }}
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
                first_name: '',
                last_name:'',
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
            english:{
                title: 'Registration',
                first_name: 'First Name',
                last_name: 'Last Name',
                email: 'Email',
                phone: 'Phone No',
                address: 'Address',
                city: 'City',
                state: 'State',
                zip: 'Zip Code',
                submit: 'Submit'
            },
            spanish:{
                title: 'Registro',
                first_name: 'Primer nombre',
                last_name: 'Apellido',
                email: 'Email',
                phone: 'Telefono no',
                address: 'Habla a',
                city: 'Ciudad',
                state: 'Estado',
                zip: 'Código postal',
                submit: 'Enviar'
            },
            lang: {},
            selectedLang: 'english'
        }
    },
    created() {
        this.lang = this.english;
    },
    methods: {
        registerLead() {
            this.form.post(route('lead.store'), {
                preserveScroll: true
            });
        },
        selectLang(lang){
            this.selectedLang = lang;
            if (lang === 'spanish'){
                this.lang = this.spanish;
            }else{
                this.lang = this.english;
            }
        }
    },
}
</script>

<style scoped>
    .btn-my{
        background-color: #f89635;
        color: #FFFFFF;
        border-color: #f89635;
    }
    .btn-outline-my{
        color: #f89635;
        border-color: #f89635;
    }
    .btn-outline-my:hover{
        color: #ffffff;
    }
</style>
