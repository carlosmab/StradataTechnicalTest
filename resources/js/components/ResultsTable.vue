<template>
    <div v-if="resultsPerPage.length > 0" class="ml-10 mr-10 mt-15" >
        <div class="flex justify-end mt-10">
            <button @click="previousPage()" :disabled="prevPageDisabled" class="p-2 bg-green-500 text-white w-32 rounded hover:bg-green-600">Anterior</button>
            <button @click="nextPage()" :disabled="nextPageDisabled" class="ml-5 p-2 bg-green-500 text-white w-32 rounded hover:bg-green-600">Siguiente</button>
        </div>
        <table class="w-full mt-10">
            <thead class="bg-green-500 text-white">
                <th>Nombre</th>
                <th>Tipo de persona</th>
                <th>Tipo de cargo</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th>% Coincidencia</th>
            </thead>
            <tbody>
                <tr v-for="(result, index) in resultsPerPage" :key="index" :class="{'bg-green-100' : index % 2 == 0}" >
                    <td> {{result.name }} </td>
                    <td> {{ result.person_type }} </td>
                    <td> {{ result.job_title }} </td>
                    <td> {{ result.region }} </td>
                    <td> {{ result.city }} </td>
                    <td> {{ result.match_rate }} </td>
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
        name: "ResultsTable",

        props: [
            'results', 'firstSearch'
        ],

        data: function () {
            return {
                resultsPerPage: [],
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

                this.resultsPerPage = this.results.slice(this.rows_per_page * this.page, this.rows_per_page  * (this.page + 1));
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

                this.resultsPerPage = this.results.slice(this.rows_per_page * this.page, this.rows_per_page  * (this.page + 1));
            }
        },

        watch: {
            results: function (newResults) {
                this.num_pages = Math.ceil(newResults.length / this.rows_per_page) - 1;
                this.resultsPerPage = newResults.slice(0, this.rows_per_page);
            }
        }

    }
</script>

<style>

</style>
