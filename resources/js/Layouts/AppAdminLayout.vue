<template>
    <div class="wrapper">
        <!-- Sidebar  -->
        <admin-sidebar></admin-sidebar>
        <!-- TOP Nav Bar -->
        <admin-navbar></admin-navbar>
        <!-- TOP Nav Bar END -->
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            <slot></slot>
        </div>
    </div>
</template>

<script>


    import AdminSidebar from "../Component/Include/AdminSidebar";
    import AdminNavbar from "../Component/Include/AdminNavbar";
    export default {
        components: {
            AdminNavbar,
            AdminSidebar

        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>
