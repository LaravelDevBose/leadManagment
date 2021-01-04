<template>
    <div v-if="open" id="compose-email-popup" class="compose-popup modal-sticky-bottom-right modal-sticky-lg">
        <div class="iq-card iq-border-radius-20 mb-0">
            <div class="iq-card-body">
                <template v-if="form.processing">
                    <div class="loadingio-spinner-spinner-j3spzkls1mg"><div class="ldio-efa0v7zha3">
                        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div>
                    </div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    </div></div>
                </template>
                <div class="row align-items-center">
                    <div class="col-md-12 mb-3">
                        <button type="button" @click.prevent="close" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="float-right close-popup" ><i class="ri-close-fill"></i></button>
                    </div>
                </div>
                <form class="email-form"  @submit.prevent="sendingMail" :class="{ 'opacity-25': form.processing }">
                    <div class="form-group row">
                        <label for="mail_to" class="col-sm-2 col-form-label">To:</label>
                        <div class="col-sm-10">
                            <multiselect
                                v-model="form.mail_tos"
                                tag-placeholder="Add this as to"
                                placeholder="Search or add a receiver"
                                :options="options"
                                :multiple="true"
                                :taggable="true"
                                @tag="addMailTo"
                                id="mail_to"
                            ></multiselect>
                            <jet-input-error :message="form.error('mail_tos')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mail_cc" class="col-sm-2 col-form-label">Cc:</label>
                        <div class="col-sm-10">
                            <multiselect
                                v-model="form.mail_ccs"
                                tag-placeholder="Add this as CC"
                                placeholder="Search or add a receiver"
                                :options="options"
                                :multiple="true"
                                :taggable="true"
                                @tag="addMailCC"
                                id="mail_cc"
                            ></multiselect>
                            <jet-input-error :message="form.error('mail_ccs')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mail_subject" class="col-sm-2 col-form-label">Subject:</label>
                        <div class="col-sm-10">
                            <jet-input id="mail_subject" type="text" class="mt-1 block w-full shadow-none" v-model="form.mail_subject" />
                            <jet-input-error :message="form.error('mail_subject')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mail_body" class="col-sm-2 col-form-label">Body:</label>
                        <div class="col-md-10">
                            <textarea id="mail_body" class="form-control mt-1 block w-full" v-model="form.mail_body"  rows="9" style="line-height: 22px;"> </textarea>
                            <jet-input-error :message="form.error('mail_body')" class="mt-2" />
                        </div>
                    </div>
                    <div class="form-group row align-items-center compose-bottom pt-4 m-0 pb-2">
                        <div class="d-flex flex-grow-1 align-items-center">
                            <div class="send-btn">
                                <button type="submit" class="btn btn-md btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Send Mail</button>
                            </div>
<!--                            <div class="send-panel">
                                <label class="ml-2 mb-0 iq-bg-primary rounded" for="file">
                                    <input type="file" id="file" style="display: none">
                                    <a><i class="ri-attachment-line"></i> </a>
                                </label>
                            </div>-->
                        </div>
                    </div>
                </form>
            </div>
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
import Multiselect from 'vue-multiselect'

export default {
    name: "ComposeMail",
    props:{
        open: {
            type: Boolean,
            default: false,
        }
    },
    components: {
        FormArea,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        Multiselect
    },
    data(){
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                mail_tos: [],
                mail_ccs: [],
                mail_subject:'',
                mail_body:'',
            }, {
                bag: 'sendMailBag',
                resetOnSuccess: true,
            }),
            options:[]
        }
    },
    methods:{
        sendingMail() {
            this.form.post(route('admin.email.send'), {
                preserveScroll: true,
                onSuccess: () =>{
                    this.close();
                    this.form.reset();
                }
            });
        },
        addMailTo(newTo){
            this.form.mail_tos.push(newTo);
        },
        addMailCC(newCC){
            this.form.mail_ccs.push(newCC);
        },
        close(){
            this.$emit('closeModal', false);
        }
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

/*.ion-loading.custom-loading .loading-wrapper {
    background: transparent;
    box-shadow: none;
}*/

@keyframes ldio-efa0v7zha3 {
    0% {
        opacity: 1
    }
    100% {
        opacity: 0
    }
}
.menu-content-open{
    pointer-events: auto!important;
}
.ldio-efa0v7zha3 div {
    left: 94px;
    top: 48px;
    position: absolute;
    animation: ldio-efa0v7zha3 linear 1s infinite;
    background: #4658ac;
    width: 12px;
    height: 24px;
    border-radius: 4.5600000000000005px / 4.5600000000000005px;
    transform-origin: 6px 52px;
}

.ldio-efa0v7zha3 div:nth-child(1) {
    transform: rotate(0deg);
    animation-delay: -0.9333333333333333s;
    background: #4658ac;
}

.ldio-efa0v7zha3 div:nth-child(2) {
    transform: rotate(24deg);
    animation-delay: -0.8666666666666667s;
    background: #e7008a;
}

.ldio-efa0v7zha3 div:nth-child(3) {
    transform: rotate(48deg);
    animation-delay: -0.8s;
    background: #ff003a;
}

.ldio-efa0v7zha3 div:nth-child(4) {
    transform: rotate(72deg);
    animation-delay: -0.7333333333333333s;
    background: #ff6d00;
}

.ldio-efa0v7zha3 div:nth-child(5) {
    transform: rotate(96deg);
    animation-delay: -0.6666666666666666s;
    background: #ffc53f;
}

.ldio-efa0v7zha3 div:nth-child(6) {
    transform: rotate(120deg);
    animation-delay: -0.6s;
    background: #4658ac;
}

.ldio-efa0v7zha3 div:nth-child(7) {
    transform: rotate(144deg);
    animation-delay: -0.5333333333333333s;
    background: #e7008a;
}

.ldio-efa0v7zha3 div:nth-child(8) {
    transform: rotate(168deg);
    animation-delay: -0.4666666666666667s;
    background: #ff003a;
}

.ldio-efa0v7zha3 div:nth-child(9) {
    transform: rotate(192deg);
    animation-delay: -0.4s;
    background: #ff6d00;
}

.ldio-efa0v7zha3 div:nth-child(10) {
    transform: rotate(216deg);
    animation-delay: -0.3333333333333333s;
    background: #ffc53f;
}

.ldio-efa0v7zha3 div:nth-child(11) {
    transform: rotate(240deg);
    animation-delay: -0.26666666666666666s;
    background: #4658ac;
}

.ldio-efa0v7zha3 div:nth-child(12) {
    transform: rotate(264deg);
    animation-delay: -0.2s;
    background: #e7008a;
}

.ldio-efa0v7zha3 div:nth-child(13) {
    transform: rotate(288deg);
    animation-delay: -0.13333333333333333s;
    background: #ff003a;
}

.ldio-efa0v7zha3 div:nth-child(14) {
    transform: rotate(312deg);
    animation-delay: -0.06666666666666667s;
    background: #ff6d00;
}

.ldio-efa0v7zha3 div:nth-child(15) {
    transform: rotate(336deg);
    animation-delay: 0s;
    background: #ffc53f;
}

.loadingio-spinner-spinner-j3spzkls1mg {
    width: 200px;
    height: 200px;
    display: inline-block;
    overflow: hidden;
    background: none;
    position: absolute;
    top: 25%;
    left: 40%;
    z-index: 999;
}

.ldio-efa0v7zha3 {
    width: 100%;
    height: 100%;
    position: relative;
    transform: translateZ(0) scale(1);
    backface-visibility: hidden;
    transform-origin: 0 0; /* see note above */
}

.ldio-efa0v7zha3 div {
    box-sizing: content-box;
}

</style>
