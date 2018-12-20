<template>
    <!-- Dashboard Sidebar
    ================================================== -->
    <div class="dashboard-sidebar">
        <div class="dashboard-sidebar-inner" data-simplebar>
            <div class="dashboard-nav-container">

                <!-- Responsive Navigation Trigger -->
                <a href="#" class="dashboard-responsive-nav-trigger">
                    <span class="hamburger hamburger--collapse" >
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </span>
                    <span class="trigger-title">Dashboard Navigation</span>
                </a>
                
                <!-- Navigation -->
                <div class="dashboard-nav">
                    <div class="dashboard-nav-inner">

                        <ul data-submenu-title="Primary">
                            <router-link to="/admin"><li><a href=""><i class="icon-material-outline-dashboard"></i>Dashboard</a></li></router-link>
                            <router-link to="/admin/profile"><li><a href=""><i class="icon-material-outline-business"></i> Profile</a></li></router-link>
                            <li><a href="#"><i class="icon-material-outline-supervisor-account"></i> Dokter</a>
                                <ul>
                                    <li><a href="dashboard-manage-jobs.html">Daftar Dokter <span class="nav-tag">3</span></a></li>
                                    <li><a href="dashboard-manage-candidates.html">Jadwal Dokter</a></li>
                                </ul>	
                            </li>
                            <li><a href="#"><i class="icon-material-outline-speaker-notes"></i> Informasi</a>
                                <ul>
                                    <li><router-link to="/admin/peran-dan-kategori"><a>Peran & Kategori</a></router-link></li>
                                    <li><a href="dashboard-manage-candidates.html">Post</a></li>
                                </ul>	
                            </li>
                            <li><a href="#"><i class="icon-material-outline-business-center"></i> Karir</a>
                                <ul>
                                    <li><a href="dashboard-manage-jobs.html">Kategori <span class="nav-tag">3</span></a></li>
                                    <li><a href="dashboard-manage-candidates.html">Informasi</a></li>
                                </ul>	
                            </li>
                            <router-link to="/admin"><li><a href=""><i class="icon-material-baseline-mail-outline"></i>Buku Tamu</a></li></router-link>
                        </ul>
                           

                        <ul data-submenu-title="Support">
                            <li><a href="dashboard-settings.html"><i class="icon-material-outline-settings"></i> Pengaturan</a></li>
                            <li><a href="index-logged-out.html"><i class="icon-material-outline-power-settings-new"></i> Keluar</a></li>
                        </ul>
                        
                    </div>
                </div>
                <!-- Navigation / End -->

            </div>
        </div>
    </div>
    <!-- Dashboard Sidebar / End -->
</template>

<style scoped>
a { color: #000000; transition: 0.3s; }
a, button { outline: none !important; }
a:focus,
a:hover { text-decoration: none; color: #333;}
</style>

