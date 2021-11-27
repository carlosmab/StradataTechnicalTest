<template>
    <div class="h-screen bg-white">
        <div class="flex">
            <div class="pl-6 bg-gray-200 w-64 h-screen border-r-2 border-gray-300">
                <nav class="pt-4">
                    <router-link to="/">
                        <p class="text-green-500 uppercase font-bold text-lg mt-4">StrData</p>
                    </router-link>

                    <p class="pt-12 text-gray-500 uppercase font-bold text-">menú</p>

                    <a @click="searchMatchNames = true" class="flex items-center py-2 hover:text-green-600 text-sm">
                        <svg viewBox="0 0 24 24" class=" fill-current w-5 h-5 mt-2 text-green-600">
                            <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
                        </svg>
                        <div class="tracking-wide pl-3">Buscar Coincidencias</div>
                    </a>

                    <a @click="searchMatchNames = false" class="flex items-center py-2 hover:text-green-600 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current text-green-600 w-5 h-5"><path class="st0" d="M20 2h-1V1c0-.6-.4-1-1-1s-1 .4-1 1v1h-4V1c0-.6-.4-1-1-1s-1 .4-1 1v1H7V1c0-.6-.4-1-1-1S5 .4 5 1v1H4C1.8 2 0 3.8 0 6v14c0 2.2 1.8 4 4 4h16c2.2 0 4-1.8 4-4V6c0-2.2-1.8-4-4-4zM4 4h1v1c0 .6.4 1 1 1s1-.4 1-1V4h4v1c0 .6.4 1 1 1s1-.4 1-1V4h4v1c0 .6.4 1 1 1s1-.4 1-1V4h1c1.1 0 2 .9 2 2v2H2V6c0-1.1.9-2 2-2zm16 18H4c-1.1 0-2-.9-2-2V10h20v10c0 1.1-.9 2-2 2zM8 14c0 .6-.4 1-1 1H5c-.6 0-1-.4-1-1s.4-1 1-1h2c.6 0 1 .4 1 1zm6 0c0 .6-.4 1-1 1h-2c-.6 0-1-.4-1-1s.4-1 1-1h2c.6 0 1 .4 1 1zm6 0c0 .6-.4 1-1 1h-2c-.6 0-1-.4-1-1s.4-1 1-1h2c.6 0 1 .4 1 1zM8 18c0 .6-.4 1-1 1H5c-.6 0-1-.4-1-1s.4-1 1-1h2c.6 0 1 .4 1 1zm6 0c0 .6-.4 1-1 1h-2c-.6 0-1-.4-1-1s.4-1 1-1h2c.6 0 1 .4 1 1zm6 0c0 .6-.4 1-1 1h-2c-.6 0-1-.4-1-1s.4-1 1-1h2c.6 0 1 .4 1 1z"/></svg>
                        <div class="tracking-wide pl-3">Historial de búsquedas</div>
                    </a>

                    <p class="pt-12 text-gray-500 uppercase font-bold text-xs"></p>
                    <router-link to="/logout" class="flex items-center py-2 hover:text-green-600 text-sm">
                        <svg viewBox="0 0 24 24" class="fill-current text-green-600 w-5 h-5"><path d="M21 3h-3.8c-.7 0-1.3-.6-1.3-1.3S16.5.4 17.2.4h5.1c.7 0 1.3.6 1.3 1.3v20.5c0 .7-.6 1.3-1.3 1.3h-5.1c-.7 0-1.3-.6-1.3-1.3 0-.7.6-1.3 1.3-1.3H21V3zm-6.9 7.7L8.6 5.2c-.5-.5-.6-1.3-.1-1.8s1.3-.5 1.8 0l7.7 7.7c.8.8.2 2.2-.9 2.2H1.8c-.7 0-1.3-.6-1.3-1.3 0-.7.6-1.3 1.3-1.3h12.3zm-1.6 4.8c.5-.5 1.3-.4 1.8.1s.4 1.3-.1 1.8l-3.8 3.2c-.5.5-1.3.4-1.8-.1-.6-.5-.5-1.3 0-1.7l3.9-3.3z"/></svg>
                        <div class="tracking-wide pl-3">Cerrar Sesión</div>
                    </router-link>

                </nav>
            </div>
            <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
                <div class="h-16 px-6 border-b border-gray-400 flex items-center justify-between">
                    <div>
                        {{ title }}
                    </div>
                    <div class="flex items-center">

                    </div>

                </div>
                <div class="flex flex-col overflow-y-hidden flex-1">
                    <Search :searchMatchNames="searchMatchNames" />
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import Search from "../components/Search.vue"

    export default {
        name: "App",

        components: {
            Search
        },

        beforeCreate() {
            if (! this.$localStorage.get('token')) {
                this.$router.push('/login');
            }
        },

        created() {
            this.title = this.$route.meta.title;
        },

        data: function () {
            return {
                title: '',
                searchMatchNames: true,
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
