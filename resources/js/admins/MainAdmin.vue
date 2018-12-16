<template>
    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <Sidebar/>
        <router-view></router-view>
    </div>
    <!-- Dashboard Container / End -->
</template>

<script>

import Sidebar from './cores/Sidebar.vue';
    export default {
        name: 'dashboard-main',
        components: {Sidebar}
    }
</script>