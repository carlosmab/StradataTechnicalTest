<template>
    <div class="">
        <router-view class="overflow-x-hidden" :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
    export default {
        name: "App",

        props: [
            'user'
        ],

        components: {

        },

        created() {
            this.title = this.$route.meta.title;
        },

        data: function () {
            return {
                title: '',
            }
        },

        watch: {
            $route(to, from) {
                this.title = to.meta.title;
            },

            title() {
                document.title = this.title + ' | Strdata'
            }
        }

    }
</script>

<style>

</style>
