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

<style scoped>
a { color: #000000; transition: 0.3s; }
a, button { outline: none !important; }
a:focus,
a:hover { text-decoration: none; color: #333;}
</style>
