<template>
    <div>
        <div v-if="searchMatchNames">
            <SearchForm @updateMatchingNamesTable="updateResultsTable($event)" />
        </div>
        <div v-else>
            <LogSearchForm @updateMatchingNamesTable="updateResultsTable($event)" />
        </div>
        <hr>
        <ResultsTable :results="matchingNames" :firstSearch="firstSearch"/>
    </div>
</template>

<script>
    import SearchForm from "./SearchForm.vue";
    import ResultsTable from "./ResultsTable.vue";
    import LogSearchForm from "./LogSearchForm.vue";

    export default {

        name: "Search",

        props: [
            'searchMatchNames'
        ],

        components: {
            SearchForm,
            ResultsTable,
            LogSearchForm,
        },

        data: function () {
            return {
                matchingNames: [],
                firstSearch: true,
            }
        },

        methods: {
            updateResultsTable: function (matchingNames) {
                this.matchingNames = matchingNames;
            },

            updatesTable: function (matchingNames) {
                this.matchingNames = matchingNames;
            }
        },

         watch: {
            searchMatchNames: function (newView) {
                this.matchingNames = [];
            }
        }



    }
</script>

<style>

</style>
