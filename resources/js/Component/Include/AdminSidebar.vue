<template>
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a :href="route('admin.dashboard')">
                <img src="/logo.jpg" class="img-fluid" alt="">
<!--                <span>On Call</span>-->
            </a>
            <div class="iq-menu-bt-sidebar">
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li :class="route().current('admin.dashboard')?'active': '' ">
                        <inertia-link :href="route('admin.dashboard')"  class="iq-waves-effect">
                            <i class="ri-home-3-line"></i><span>Dashboard</span>
                        </inertia-link>
                    </li>
                    <li>
                        <a href="#menu-design" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="ri-menu-3-line"></i>
                            <span>Clients</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="menu-design" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li :class="route().current('admin.lead.create')?'active': '' ">
                                <inertia-link :href="route('admin.lead.create')">
                                    <i class="ri-add-box-line"></i><span>New Client</span>
                                </inertia-link>
                            </li>
                            <li :class="route().current('admin.lead.index')?'active': '' ">
                                <inertia-link :href="route('admin.lead.index')">
                                    <i class="ri-keyboard-line"></i><span>Clients Board</span>
                                </inertia-link>
                            </li>
                            <li :class="route().current('admin.lead.table')?'active': '' ">
                                <inertia-link :href="route('admin.lead.table')">
                                    <i class="ri-table-line"></i><span>Clients Table</span>
                                </inertia-link>
                            </li>
                        </ul>
                    </li>
                    <!-- <li :class="route().current('admin.email.inbox', 'INBOX')?'active': '' ">
                        <inertia-link :href="route('admin.email.inbox', 'INBOX')"  class="iq-waves-effect">
                            <i class="ri-mail-line"></i><span>Mail</span>
                        </inertia-link>
                    </li> -->
                    <li :class="route().current('admin.calender.index')?'active': '' ">
                        <inertia-link :href="route('admin.calender.index')"  class="iq-waves-effect">
                            <i class="ri-calendar-todo-fill"></i><span>Calendar</span>
                        </inertia-link>
                    </li>

                    <li v-if="$page.user.role == 1" :class="route().current('admin.users.index')?'active': '' ">
                        <inertia-link :href="route('admin.users.index')"  class="iq-waves-effect">
                            <i class="ri-user-line"></i><span>Employee & Admin</span>
                        </inertia-link>
                    </li>
                    <li :class="route().current('admin.contact_us.message.index')?'active': '' ">
                        <inertia-link :href="route('admin.contact_us.message.index')"  class="iq-waves-effect">
                            <i class="ri-discuss-fill"></i><span> Contact Form Leads</span>
                        </inertia-link>
                    </li>
                    <li v-if="$page.user.role == 1">
                        <a href="#setting-menu" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="ri-settings-5-fill"></i>
                            <span>Setting</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="setting-menu" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li :class="route().current('admin.services.index')?'active': '' ">
                                <inertia-link :href="route('admin.services.index')">
                                    <i class="ri-list-settings-fill"></i><span>Add Services</span>
                                </inertia-link>
                            </li>
                            <li :class="route().current('admin.testimonials.index')?'active': '' ">
                                <inertia-link :href="route('admin.testimonials.index')">
                                    <i class="ri-double-quotes-l"></i><span>Add Testimonials</span>
                                </inertia-link>
                            </li>
                            <li :class="route().current('admin.about_us.page')?'active': '' ">
                                <inertia-link :href="route('admin.about_us.page')">
                                    <i class="ri-file-text-line"></i><span>About Us</span>
                                </inertia-link>
                            </li>
                            <li :class="route().current('admin.contact_us.page')?'active': '' ">
                                <inertia-link :href="route('admin.contact_us.page')">
                                    <i class="ri-contacts-book-line"></i><span>Contact Us</span>
                                </inertia-link>
                            </li>
                            <li :class="route().current('admin.zoom_meeting.page')?'active': '' ">
                                <inertia-link :href="route('admin.zoom_meeting.page')">
                                    <i class="ri-file-text-line"></i><span>Zoom</span>
                                </inertia-link>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdminSidebar",
    props:['user']
}
</script>

<style scoped>

</style>
