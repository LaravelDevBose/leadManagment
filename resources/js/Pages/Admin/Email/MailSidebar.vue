<template>
  <div class="col-lg-3">
        <div class="iq-card">
            <div class="iq-card-body">
            <div class="">
                <div class="iq-email-list">
                    <button class="btn btn-primary btn-lg btn-block mb-3 font-size-16 p-3" @click.prevent="newMail()"><i class="ri-send-plane-line mr-2"></i>New Message</button>
                    <div class="iq-email-ui nav flex-column nav-pills">
                        <li class="nav-link"
                            v-for="folder in folders"
                            :key="folder.name"
                            :class="current === folder.name ?'active': '' "
                        >
                            <inertia-link :href="route('admin.email.inbox', folder.name)">
                                <span>{{ folder.name }}</span>
                            </inertia-link>
                        </li>
                        <li class="nav-link"
                            :class="current === 'All Mail'?'active': '' "
                        >
                            <inertia-link :href="route('admin.email.inbox', 'All Mail')">
                                <span>All Mail</span>
                            </inertia-link>
                        </li>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MailSidebar',
    props:['folders', 'current'],
    methods:{
        newMail(){
            this.$emit('openCompose');
        }
    }
}
</script>

<style>

</style>