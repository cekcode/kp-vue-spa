<template>
    <div>
        <header id="header-container" class="fullwidth">
            
            <template v-if="!currentUser">
                <!-- Header -->
                <div id="header">
                    <div class="container">
                        
                        <!-- Left Side Content -->
                        <div class="left-side">
                            
                            <!-- Logo -->
                            <div id="logo">
                                <a href="index.html"><img src="/frontend/images/logo.png" alt=""></a>
                            </div>

                            <!-- Main Navigation -->
                            <nav id="navigation">
                                <ul id="responsive">

                                    <li><a href="#"><router-link to="/">Home</router-link></a></li>
                                    <li><a href="#"><router-link to="/profile">Profile</router-link></a></li>

                                    <li><a href="#">Dokter</a>
                                        <ul class="dropdown-nav">
                                            <li><a href="#"><router-link to="/daftar-dokter">Daftar Dokter</router-link></a></li>
                                            <li><a href="#"><router-link to="/jadwal-dokter">Jadwal Dokter</router-link></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#"><router-link to="/layanan">Layanan</router-link></a></li>
                                    <li><a href="#"><router-link to="/informasi">Informasi</router-link></a></li>
                                    <li><a href="#"><router-link to="/buku-tamu">Buku Tamu</router-link></a></li>

                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                            <!-- Main Navigation / End -->
                            
                        </div>
                        <!-- Left Side Content / End -->

                        <!-- Right Side Content / End -->
                        <div class="right-side">

                            <!-- Mobile Navigation Button -->
                            <span class="mmenu-trigger">
                                <button class="hamburger hamburger--collapse" type="button">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </span>

                        </div>
                        <!-- Right Side Content / End -->

                    </div>
                </div>
                <!-- Header / End -->
            </template>

            <template v-else>
                <!-- Header -->
                <div id="header">
                    <div class="container">
                        
                        <!-- Left Side Content -->
                        <div class="left-side">
                            
                            <!-- Logo -->
                            <div id="logo">
                                <router-link to="/"><img src="/frontend/images/logo.png" alt=""></router-link>
                            </div>


                            <div class="clearfix"></div>
                            
                        </div>
                        <!-- Left Side Content / End -->


                        <!-- Right Side Content / End -->
                        <div class="right-side">

                            <div class="header-widget hide-on-mobile" >
                                <!-- Notifications -->
                                <div class="header-notifications">

                                    <!-- Trigger -->
                                    <div class="header-notifications-trigger">
                                        <a href="#"><i class="icon-feather-bell"></i><span>4</span></a>
                                    </div>

                                    <!-- Dropdown -->
                                    <div class="header-notifications-dropdown">
                                    
                                        <div class="header-notifications-headline">
                                            <h4>Notifications</h4>
                                            <button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
                                                <i class="icon-feather-check-square"></i>
                                            </button>
                                        </div>

                                        <div class="header-notifications-content">
                                            <div class="header-notifications-scroll" data-simplebar>
                                                <ul>
                                                    <!-- Notification -->
                                                    <li class="notifications-not-read">
                                                        <a href="dashboard-manage-candidates.html">
                                                            <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                                            <span class="notification-text">
                                                                Pesan
                                                            </span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <!-- User Menu -->
                            <div class="header-widget">

                                <!-- Messages -->
                                <div class="header-notifications user-menu">
                                    <div class="header-notifications-trigger">
                                        <a href="#"><div class="user-avatar status-online"><img src="/frontend/images/user-avatar-small-01.jpg" alt=""></div></a>
                                    </div>

                                    <!-- Dropdown -->
                                    <div class="header-notifications-dropdown">

                                        <!-- User Status -->
                                        <div class="user-status">

                                            <!-- User Name / Avatar -->
                                            <div class="user-details">
                                                <div class="user-avatar status-online"><img src="/frontend/images/user-avatar-small-01.jpg" alt=""></div>
                                                <div class="user-name">
                                                    {{ currentUser.name }} <span>Admin</span>
                                                </div>
                                            </div>
                                            
                                            <!-- User Status Switcher -->
                                            <div class="status-switch" id="snackbar-user-status">
                                                <label class="user-online current-status">Online</label>
                                                <label class="user-invisible">Invisible</label>
                                                <!-- Status Indicator -->
                                                <span class="status-indicator" aria-hidden="true"></span>
                                            </div>	
                                    </div>
                                    
                                    <ul class="user-menu-small-nav">
                                        <li><a href="dashboard.html"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                                        <li><a href="dashboard-settings.html"><i class="icon-material-outline-settings"></i> Settings</a></li>
                                        <li><a href="!#" @click.prevent="logout"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
                                    </ul>

                                    </div>
                                </div>

                            </div>
                            <!-- User Menu / End -->

                        </div>
                        <!-- Right Side Content / End -->

                    </div>
                </div>
                <!-- Header / End -->
            </template>


        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
    </div>
</template>

<script>

export default {
    name: 'app-header',
    methods: {
        logout() {
            this.$store.commit('logout');
            this.$router.push('/login');
        } 
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser
        }
    }
}
</script>