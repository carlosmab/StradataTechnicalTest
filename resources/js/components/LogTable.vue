<template>
    <div v-if="logsPerPage.length > 0" class="ml-10 mr-10 mt-15" >
        <div class="flex justify-end mt-10">
            <button @click="previousPage()" :disabled="prevPageDisabled" class="p-2 bg-green-500 text-white w-32 rounded hover:bg-green-600">Anterior</button>
            <button @click="nextPage()" :disabled="nextPageDisabled" class="ml-5 p-2 bg-green-500 text-white w-32 rounded hover:bg-green-600">Siguiente</button>
        </div>
        <table class="w-full mt-10">
            <thead class="bg-green-500 text-white">
                <th>Nombre buscado</th>
                <th>% Buscado</th>
                <th>Estado de Ejecución</th>
            </thead>
            <tbody>
                <tr v-for="(log, index) in logsPerPage" :key="index" :class="{'bg-green-100' : index % 2 == 0}" >
                    <td> {{ log.searched_name }} </td>
                    <td> {{ log.match_rate }} </td>
                    <td> {{ log.execution_status }} </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div v-else-if="!firstSearch" class="ml-10 mr-10 mt-10">
        <p>No se encontraron resultados</p>
    </div>
</template>

<script>
    export default {
        name: "logTable",

        props: [
            'logs', 'firstSearch'
        ],

        data: function () {
            return {
                logsPerPage: [],
                page: 0,
                num_pages: 0,
                rows_per_page: 10,
                prevPageDisabled: false,
                nextPageDisabled: false,
            }
        },

        methods: {
            previousPage: function () {
                this.page = this.page - 1;
                if (this.page < 0) {
                    this.page = 0;
                    this.prevPageDisabled = true;
                } else {
                    this.prevPageDisabled = false;
                    this.nextPageDisabled = false;
                }

                this.logsPerPage = this.logs.slice(this.rows_per_page * this.page, this.rows_per_page  * (this.page + 1));
            },

            nextPage: function () {
                this.page = this.page + 1;
                if (this.page > this.num_pages ) {
                    this.page = this.num_pages;
                    this.nextPageDisabled = true;
                } else {
                    this.nextPageDisabled = false;
                    this.prevPageDisabled = false;
                }

                this.logsPerPage = this.logs.slice(this.rows_per_page * this.page, this.rows_per_page  * (this.page + 1));
            }
        },

        watch: {
            logs: function (newlogs) {
                this.num_pages = Math.ceil(newlogs.length / this.rows_per_page) - 1;
                this.logsPerPage = newlogs.slice(0, this.rows_per_page);
            }
        }

    }
</script>

<style>

</style>
