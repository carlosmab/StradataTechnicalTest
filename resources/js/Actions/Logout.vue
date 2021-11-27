<template>

</template>

<script>
    export default {
        name: "Logout",

        created() {
            this.$localStorage.remove('token');
            window.location = '/login';
        }
    }
</script>

<style>

</style>
