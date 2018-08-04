<template>
    <div id="app" v-cloak>
        <Nav/>
        <router-view/>
    </div>
</template>

<script>
    import Nav from './layout/Nav'
    export default {
        name: "Start",
        components: { Nav }
    }
</script>

<style scoped>

</style>