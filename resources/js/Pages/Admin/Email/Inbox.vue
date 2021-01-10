<template>
    <app-admin-layout>
        <div class="container-fluid relative">
            <div class="row">
               <mail-sidebar :folders="folders" :current="folderName" @openCompose="composeMail()" @changeRoute="routeChange=true"></mail-sidebar>
               <div class="col-lg-9 mail-box-detail">
                    <div class="iq-card">
                        <div class="iq-card-body p-0">
                            <template v-if="routeChange">
                                <div class="loadingio-spinner-spinner-j3spzkls1mg"><div class="ldio-efa0v7zha3">
                                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div>
                                </div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                                </div></div>
                            </template>
                            <div class="" v-if="!routeChange">
                                <div class="iq-email-to-list p-3">
                                    <div class="d-flex justify-content-between">
                                        <ul>
                                        
                        
                                        </ul>
                                        <div class="iq-email-search d-flex" @submit.prevent="search">
                                            <form class="mr-3 position-relative">
                                                <div class="form-group mb-0">
                                                    <input type="text" v-model="searchForm.search_key"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search">
                                                    <button type="submit" class="search-link"><i class="ri-search-line"></i></button>
                                                </div>
                                            </form>
                                            <ul>
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
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="iq-email-listbox">
                                    <ul class="iq-email-sender-list" v-if="inboxes.data && inboxes.data.length > 0">
                                        <li class="iq-unread" v-for="(inbox, index) in inboxes.data" :key="index">
                                            <div class="d-flex align-self-center">
                                                <div class="iq-email-sender-info">
                                                    
                                                    <a href="javascript: void(0);"
                                                       class="px-1"
                                                       style="display: inline-block"
                                                       >
                                                       <span v-if="folderName === 'Sent'">
                                                           {{ inbox.to.indexOf("<") > 0 ? inbox.to.substring(0, inbox.to.indexOf("<")) : inbox.to }}
                                                       </span>
                                                        <span v-else>
                                                            {{ inbox.from.indexOf("<") > 0 ? inbox.from.substring(0, inbox.from.indexOf("<")) : inbox.from }}
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="iq-email-content">
                                                    <a href="javascript: void(0);" class="iq-email-subject">
                                                        {{ inbox.subject }}
                                                    </a>
                                                    <div class="iq-email-date">{{ inbox.date | diffForHumans }}</div>
                                                </div>
                                                <ul class="iq-social-media">
                                                    <li><a href="#" v-if="folderName === 'Trash'" @click.prevent="deleteMail(inbox.message_id)"><i class="ri-delete-bin-2-line"></i></a></li>
                                                    <li><a href="#" v-if="folderName !== 'Trash'" @click.prevent="deleteItem(inbox.message_id)"><i class="ri-delete-bin-2-line"></i></a></li>
                                                    <li><a href="#" @click.prevent="showMailDetails(inbox.message_id)"><i class="ri-file-list-2-line"></i></a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <compose-mail :open="open" @closeModal="open = $event"></compose-mail>
                <show :show-details="showDetails" :loadding="loadding" :details="inboxDetails" @closeDetails="closeDetailModal($event)"></show>
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
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
export default {
    name: "Inbox",
    props:['folders', 'inboxes', 'folderName'],
    components: {AlertMessages, Show, ComposeMail, AppAdminLayout, MailSidebar},
    data(){
        return{
            open: false,
            showDetails: false,
            inboxDetails: {},
            loadding: false,
            routeChange: true,
            searchForm: this.$inertia.form({
                '_method': 'GET',
                search_key: '',
            }, {
                resetOnSuccess: false,
            }),
            deleteForm: this.$inertia.form({
                '_method': 'GET',
                ids: [],
            }, {
                bag: 'mailDeleteBag',
                resetOnSuccess: false,
            }),
            deleteForeverForm: this.$inertia.form({
                '_method': 'GET',
                ids: [],
            }, {
                bag: 'mailDeleteBag',
                resetOnSuccess: false,
            }),
        }
    },
    filters: {
        diffForHumans: (date) => {
            if (!date){
                return null;
            }

            return dayjs(date).fromNow();
        }
    },
    created() {
        dayjs.extend(relativeTime);
    },
    mounted(){
        this.routeChange = false;
        console.log(this.messages);
        console.log(this.folders);
    },
    methods:{
        composeMail(){
            this.open = true;
        },
        deleteItem(id){
            this.deleteForm.post(route('admin.email.trash',{folder: this.folderName, id: id}), {
                preserveScroll: true
            });
        },
        deleteMail(id){
            this.deleteForeverForm.post(route('admin.email.destroy',{folder: this.folderName, id: id}), {
                preserveScroll: true
            });
        },
        search(){
            this.searchForm.post(route('admin.email.inbox'), {
                preserveScroll: true,
            });
        },
        showMailDetails(id){
            this.showDetails = true;
            this.loadding = true;
            axios.get(route('admin.email.show', {folder: this.folderName, id: id})).then(response => {
                if(response.status === 200){
                    this.inboxDetails = response.data.data;
                    console.log(this.inboxDetails);
                    this.loadding = false;
                }
            });
        },
        closeDetailModal(){
            this.inboxDetails = {};
            this.showDetails = false;
            this.loadding = false;
        }
    }
}
</script>

<style scoped>

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
