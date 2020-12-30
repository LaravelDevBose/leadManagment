<template>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <a href="index.html" class="logo">
                        <img src="images/logo.gif" class="img-fluid" alt="">
                        <span>vito</span>
                    </a>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="navbar-left">
                    <ul id="topbar-data-icon" class="d-flex p-0 topbar-menu-icon">
                        <li class="nav-item">
                            <a :href="route('admin.dashboard')" class="nav-link font-weight-bold search-box-toggle"><i class="ri-home-4-line"></i></a>
                        </li>
                        <li><a href="chat.html" class="nav-link"><i class="ri-message-line"></i></a></li>
                        <li><a href="e-commerce-product-list.html" class="nav-link"><i class="ri-file-list-line"></i></a></li>
                        <li><a href="profile.html" class="nav-link"><i class="ri-question-answer-line"></i></a></li>
                        <li><a href="todo.html" class="nav-link router-link-exact-active router-link-active"><i class="ri-chat-check-line"></i></a></li>
                        <li><a href="app/index.html" class="nav-link"><i class="ri-inbox-line"></i></a></li>
                    </ul>
                    <div class="iq-search-bar">
                        <form action="#" class="searchbox">
                            <input type="text" class="text search-input" placeholder="Type here to search...">
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
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
export default {
    name: "AdminNavbar",
    methods:{
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    }
}
</script>

<style scoped>

</style>
