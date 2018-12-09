<template>
<div>
    <Header/>
        <router-view></router-view>
    <Footer/>
</div>
</template>

<script>
    import Header from './cores/Header.vue';
    import Footer from './cores/Footer.vue';
    export default {
        name: 'main-app',
        components: {Header,Footer}
    }
</script>