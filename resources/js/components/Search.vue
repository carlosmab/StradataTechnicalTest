<template>
    <div>
        <div v-if="searchMatchNames">
            <SearchForm @updateMatchingNamesTable="updateResultsTable($event)" />
            <hr>
            <ResultsTable :results="matchingNames" :firstSearch="firstSearch"/>
        </div>
        <div v-else>
            <LogSearchForm @updateLogsTable="updateLogsTable($event)" />
            <hr>
            <LogTable :logs="logs" />
        </div>
    </div>
</template>

<script>
    import SearchForm from "./SearchForm.vue";
    import ResultsTable from "./ResultsTable.vue";
    import LogTable from "./LogTable.vue";
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
            LogTable,
        },

        data: function () {
            return {
                matchingNames: [],
                firstSearch: true,
                logs: []
            }
        },

        methods: {
            updateResultsTable: function (matchingNames) {
                this.matchingNames = matchingNames;
            },

             updateResultsTable: function (logs) {
                this.logs = logs;
            }
        }

    }
</script>

<style>

</style>
