<template>
    <app-admin-layout>
        <div class="container-fluid relative">
            <div class="row">
               <mail-sidebar></mail-sidebar>
               <div class="col-lg-12 mail-box-detail">
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <div class="">
                                <div class="iq-email-to-list p-3">
                                    <div class="d-flex justify-content-between">
                                        <ul>
                                            <li>
                                                <button
                                                    type="button"
                                                    :class="{ 'opacity-25': deleteForm.processing }"
                                                    :disabled="deleteForm.ids.length<=0 || deleteForm.processing"
                                                    class="btn btn-danger btn-lg btn-block mb-0 font-size-16"
                                                    @click.prevent="deleteSelectedMail()"
                                                >
                                                    <i class="ri-delete-bin-2-line"></i>
                                                    Delete
                                                </button>
                                            </li>

                                            <li data-toggle="tooltip" data-placement="top" title="Compose New Mail">
                                                <button class="btn btn-primary btn-lg btn-block mb-0 font-size-16" @click.prevent="composeMail()"><i class="ri-send-plane-line mr-2"></i>New Message</button>
                                            </li>
                                        </ul>
                                        <div class="iq-email-search d-flex" @submit.prevent="search">
                                            <form class="mr-3 position-relative">
                                                <div class="form-group mb-0">
                                                    <input type="text" v-model="searchForm.search_key"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search">
                                                    <button type="submit" class="search-link"><i class="ri-search-line"></i></button>
                                                </div>
                                            </form>
                                            <!-- <ul>
                                                <li class="mr-3">
                                                    <a class="font-size-14" href="#">
                                                        {{ inboxes.from !== null ? inboxes.from : '0' }} - {{ inboxes.to !== null ? inboxes.to : '0' }} of {{ inboxes.total}}
                                                    </a>
                                                </li>
                                                <li data-toggle="tooltip" data-placement="top" title="Previous">
                                                    <inertia-link
                                                        :href="inboxes.prev_page_url !== null ? inboxes.prev_page_url : '#' "
                                                        class="iq-waves-effect"
                                                        :class="{ 'opacity-25': inboxes.prev_page_url===null }"
                                                    >
                                                        <i class="ri-arrow-left-s-line"></i>
                                                    </inertia-link>
                                                </li>
                                                <li data-toggle="tooltip" data-placement="top" title="Next">
                                                    <inertia-link
                                                        :href="inboxes.next_page_url !== null ? inboxes.next_page_url : '#'"
                                                        class="iq-waves-effect"
                                                        :class="{ 'opacity-25': inboxes.next_page_url===null }"
                                                    >
                                                        <i class="ri-arrow-right-s-line"></i>
                                                    </inertia-link>
                                                </li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="iq-email-listbox">
                                    <ul class="iq-email-sender-list" v-if="mesaages && mesaages.length > 0">
                                        <li class="iq-unread" v-for="(inbox, index) in mesaages" :key="index">
                                            <div class="d-flex align-self-center">
                                                <div class="iq-email-sender-info">
                                                    <div class="iq-checkbox-mail">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" v-model="deleteForm.ids" :value="inbox.id" :id="'inbox_'+inbox.id">
                                                            <label class="custom-control-label" :for="'inbox_'+inbox.id"></label>
                                                        </div>
                                                    </div>
                                                    <a href="javascript: void(0);"
                                                       class="px-1"
                                                       style="display: inline-block">
                                                        <span v-for="rec in inbox.mail_tos" class="mr-1 d-block">{{ rec }},</span>
                                                    </a>
                                                </div>
                                                <div class="iq-email-content">
                                                    <a href="javascript: void(0);" class="iq-email-subject">
                                                        {{ inbox.mail_subject }}&nbsp;–&nbsp;
                                                        <span>{{ inbox.mail_body }}</span>
                                                    </a>
                                                    <div class="iq-email-date">{{ inbox.send_at }}</div>
                                                </div>
                                                <ul class="iq-social-media">
                                                    <li><a href="#" @click.prevent="deleteItem(inbox.id)"><i class="ri-delete-bin-2-line"></i></a></li>
                                                    <li><a href="#" @click.prevent="showMailDetails(inbox)"><i class="ri-file-list-2-line"></i></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <compose-mail :open="open" @closeModal="open = $event"></compose-mail>
                <show :show-details="showDetails" :details="inboxDetails" @closeDetails="closeDetailModal($event)"></show>
            </div>
         </div>
    </app-admin-layout>
</template>

<script>
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import ComposeMail from "./ComposeMail";
import Show from "./Show";
import AlertMessages from "../../../Component/Include/AlertMessages";
import MailSidebar from './MailSidebar.vue';
export default {
    name: "Inbox",
    props:['messages', 'folders', 'inboxes'],
    components: {AlertMessages, Show, ComposeMail, AppAdminLayout, MailSidebar},
    data(){
        return{
            open: false,
            showDetails: false,
            inboxDetails: {},
            searchForm: this.$inertia.form({
                '_method': 'GET',
                search_key: '',
            }, {
                resetOnSuccess: false,
            }),
            deleteForm: this.$inertia.form({
                '_method': 'POST',
                ids: [],
            }, {
                bag: 'mailDeleteBag',
                resetOnSuccess: false,
            }),
        }
    },
    mounted(){
        console.log(this.messages);
        console.log(this.folders);
    },
    methods:{
        composeMail(){
            this.open = true;
        },
        deleteItem(id){
            this.deleteForm.ids.push(id);
            this.deleteSelectedMail();
        },
        deleteSelectedMail(){
            this.deleteForm.post(route('admin.email.destroy'), {
                preserveScroll: true
            });
        },
        search(){
            this.searchForm.post(route('admin.email.inbox'), {
                preserveScroll: true,
            });
        },
        showMailDetails(inboxData){
            this.inboxDetails = inboxData;
            console.log(this.inboxDetails);
            this.showDetails = true;
        },
        closeDetailModal(){
            this.inboxDetails = {};
            this.showDetails = false;
        }
    }
}
</script>

<style scoped>

</style>
