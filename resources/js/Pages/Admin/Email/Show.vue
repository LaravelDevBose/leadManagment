<template>
    <div class="email-app-details" v-if="showDetails" :class="{'show': showDetails}">
        <div class="iq-card">
            <div class="iq-card-body p-0">
                <template v-if="loadding">
                    <div class="loadingio-spinner-spinner-j3spzkls1mg"><div class="ldio-efa0v7zha3">
                        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div>
                    </div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    </div></div>
                </template>
                <template v-else>
                    <div class="">
                    <div class="iq-email-to-list pl-3 pt-1">
                        <div class="d-flex justify-content-between">
                            <ul>
                                <li class="mr-3">
                                    <a href="#" @click.prevent="close">
                                        <h4 class="m-0"><i class="ri-arrow-left-line"></i></h4>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="iq-inbox-subject pt-2 pr-5 pb-5 pl-4">
                        <h5 class="mt-0 mb-2">Subject: {{ details.subject }}</h5>
                        <hr>
                        <div class="iq-inbox-subject-info">
                            <div class="iq-subject-info">
                                <div class="iq-subject-status align-self-center">
                                    <h6 class="mb-0" >{{ details.from }}</h6>
                                    
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            to {{ details.to }}
                                        </a>
                                        <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                            <table class="iq-inbox-details">
                                                <tbody>
                                                <tr>
                                                    <td>from:</td>
                                                    <td>{{ details.from }}</td>
                                                </tr>
                                                <tr>
                                                    <td>to:</td>
                                                    <td>
                                                        {{ details.to }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>date:</td>
                                                    <td>{{ details.date | diffForHumans }}</td>
                                                </tr>
                                                <tr>
                                                    <td>subject:</td>
                                                    <td>{{ details.subject }}</td>
                                                </tr>
                                                <tr>
                                                    <td>security:</td>
                                                    <td>Standard encryption</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <span class="float-right align-self-center">{{ details.date | diffForHumans }}</span>
                            </div>
                            <div class="iq-inbox-body mt-5">
                                <p v-if="details.html_body" v-html="details.html_body"></p>
                                <p v-html="htmlBody"></p>
                            </div>
                        </div>
                    </div>
                </div>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
export default {
    name: "Show",
    props:{
        showDetails: {
            type: Boolean,
            default: false,
        },
        details:{
            type: Object
        },
        loadding:{
            type: Boolean
        }
    },
    computed: {
        htmlBody(){
            
            if(this.details.text_body){
                return this.details.text_body.substring(this.details.text_body.indexOf("<meta"), this.details.text_body.length);
            }else{
                 return this.details.text_body;
            }
            
        }
    },
    methods:{
        close(){
            this.$emit('closeDetails', false);
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
}
</script>

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
