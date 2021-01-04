<template>
    <div class="email-app-details" v-if="showDetails" :class="{'show': showDetails}">
        <div class="iq-card">
            <div class="iq-card-body p-0">
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
                        <h5 class="mt-0 mb-2">{{ details.mail_subject }}</h5>
                        <div class="iq-inbox-subject-info">
                            <div class="iq-subject-info">
                                <img :src="details.user.profile_photo_url" class="img-fluid rounded-circle" alt="#">
                                <div class="iq-subject-status align-self-center">
                                    <h6 class="mb-0">{{ details.user.name }}<a href="#"> <{{ details.user.email }}></a></h6>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            to <<span v-for="rec in details.mail_tos" class="mr-1">{{ rec }},</span>>
                                        </a>
                                        <div class="dropdown-menu font-size-12" aria-labelledby="dropdownMenuButton">
                                            <table class="iq-inbox-details">
                                                <tbody>
                                                <tr>
                                                    <td>from:</td>
                                                    <td>On Call Service</td>
                                                </tr>
                                                <tr>
                                                    <td>reply-to:</td>
                                                    <td>support@oncalltitleservices.com</td>
                                                </tr>
                                                <tr>
                                                    <td>to:</td>
                                                    <td>
                                                        <span v-for="rec in details.mail_tos" class="mr-1">{{ rec }},</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>date:</td>
                                                    <td>{{ details.send_at }}</td>
                                                </tr>
                                                <tr>
                                                    <td>subject:</td>
                                                    <td>{{ details.mail_subject }}</td>
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
                                <span class="float-right align-self-center">{{ details.send_at }}</span>
                            </div>
                            <div class="iq-inbox-body mt-5">
                                <p>{{ details.mail_body }}</p>
                                <p class="mt-5 mb-0">Regards,<span class="d-inline-block w-100">On Call Service</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",
    props:{
        showDetails: {
            type: Boolean,
            default: false,
        },
        details:{
            type: Object
        }
    },
    methods:{
        close(){
            this.$emit('closeDetails', false);
        }
    }
}
</script>

<style scoped>

</style>
