<template>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <a :href="route('admin.dashboard')" class="logo">
                        <img src="/logo.jpg" class="img-fluid" alt="">
<!--                        <span>On Call</span>-->
                    </a>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="navbar-left">
                    <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
                        <li class="nav-item">
                            <inertia-link
                                :href="route('admin.dashboard')"
                                class="nav-link"
                                data-toggle="tooltip" data-placement="top"
                                title="Dashboard" data-original-title="Dashboard"
                                :class="route().current('admin.dashboard')?'font-weight-bold search-box-toggle': '' ">
                                <i class="ri-home-4-line"></i>
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link
                                :href="route('admin.lead.table')"
                                class="nav-link"
                                data-toggle="tooltip" data-placement="top"
                                title="Lead Table" data-original-title="Lead Table"
                                :class="route().current('admin.lead.table')?'font-weight-bold search-box-toggle': '' ">
                                <i class="ri-file-list-line"></i>
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link
                                :href="route('admin.lead.index')"
                                class="nav-link"
                                data-toggle="tooltip" data-placement="top"
                                title="Lead Board" data-original-title="Lead Board"
                                :class="route().current('admin.lead.index')?'font-weight-bold search-box-toggle': '' ">
                                <i class="ri-stack-fill"></i>
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link
                                :href="route('admin.calender.index')"
                                class="nav-link"
                                data-toggle="tooltip" data-placement="top"
                                title="Lead Board" data-original-title="Lead Board"
                                :class="route().current('admin.calender.index')?'font-weight-bold search-box-toggle': '' ">
                                <i class="ri-calendar-todo-fill"></i>
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link
                                :href="route('admin.email.inbox')"
                                class="nav-link"
                                data-toggle="tooltip" data-placement="top"
                                title="Lead Board" data-original-title="Lead Board"
                                :class="route().current('admin.email.inbox')?'font-weight-bold search-box-toggle': '' ">
                                <i class="ri-mail-line"></i>
                            </inertia-link>
                        </li>
                    </ul>
                    <div class="iq-search-bar">
                        <form :action="route('admin.lead.table')"  method="get" class="searchbox">
                            <input type="text" name="search_key" :value="searchKey" class="text search-input" placeholder="Type here to search...">
                            <button type="submit" class="search-link"><i class="ri-search-line"></i></button>
                        </form>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                            <a href="#" class="search-toggle iq-waves-effect">
                                <i class="fas fa-bell"></i>
                                <span class="bg-danger dots"></span>
                            </a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">{{ unRead }}</small></h5>
                                        </div>
                                        <div style="max-height: 50vh; overflow-y: scroll;">
                                            <inertia-link
                                                v-if="notifications"
                                                v-for="notification in notifications"
                                                :key="notification.id"
                                                :href="route('admin.read.notification', notification.id)"
                                                class="iq-sub-card"
                                                :class="{'bg-gray-50': notification.read_at != null}"
                                            >
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <h6
                                                            class="mb-0 text-capitalize"
                                                            :class="notification.read_at != null ? 'text-gray' : 'text-primary'"
                                                        >
                                                            {{ notification.data.first_name +' '+ notification.data.last_name}} Complete Registration
                                                        </h6>
                                                        <small class="float-right font-size-12">{{ notification.created_at | diffForHumans }}</small>
                                                    </div>
                                                </div>
                                            </inertia-link>
                                        </div>
                                        <div class="border-top text-center py-2" style="border-radius: 0">
                                            <a :href="route('admin.read.all.notifications')" class="font-size-14"> Read All</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                            <img :src="$page.user.profile_photo_url" :alt="$page.user.name" class="img-fluid rounded mr-3" >
                            <div class="caption">
                                <h6 class="mb-0 line-height text-white">{{ $page.user.name }}</h6>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height">{{ $page.user.name }}</h5>
                                    </div>
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <form @submit.prevent="logout">
                                        <button type="submit" class="bg-primary iq-sign-btn">Sign out<i class="ri-login-box-line ml-2"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</template>

<script>
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

export default {
    name: "AdminNavbar",
    props:['searchKey'],
    data(){
        return{
            notifications: [],
            unRead: 0,
            intervalId: '',
        }
    },
    created() {
        dayjs.extend(relativeTime);
    },
    mounted() {
        this.notificationRequest();
        this.getNotifications();
    },
    methods:{
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/login';
            })
        },
        getNotifications(){
            this.intervalId = setInterval(() =>{
                this.notificationRequest();
            }, 100000);
        },
        notificationRequest(){
            axios.get(route('admin.notifications').url())
                .then(response => {
                    console.log(response.data.data.notification);
                    if (response.status === 200){
                        this.notifications = response.data.data.notification;
                        this.unRead = response.data.data.unread;
                    }
                });
        }
    },
    beforeDestroy() {
        clearInterval(this.intervalId);
    },

    filters: {
        diffForHumans: (date) => {
            if (!date){
                return null;
            }

            return dayjs(date).fromNow();
        }
    },
}
</script>

<style scoped>

</style>
