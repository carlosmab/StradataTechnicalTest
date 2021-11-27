<template>
    <div class="justify-center">
        <form @submit.prevent="validate()" class="flex">
            <div class="m-5 w-96">
                <InputSearchField name="searched_name" label="Nombre a buscar"
                    :errors="errors" @update:field="form.searched_name = $event"/>
            </div>

            <div class="m-5 w-50">
                <InputSearchField name="match_rate" label="% de Coincidencia"
                :errors="errors" @update:field="form.match_rate = $event" />
            </div>
            <div class="m-5 pb-3">
                <button class="w-40 h-auto bg-green-500 text-white  h-full text-bold uppercase rounded hover:bg-green-600">Buscar</button>
            </div>

        </form>
        <div v-if="noResults">
            <p class="text-gray-700 text-bold p-10">No se encontraron resultados</p>
        </div>

    </div>
</template>

<script>
    import InputSearchField from "./InputSearchField.vue";

    export default {
        name: "SearchForm",

        components: {
            InputSearchField
        },

        data: function() {
            return {
                form: {
                    searched_name: '',
                    match_rate: 0,
                },
                errors: [],
                matchingNames: [],
                noResults: false,
            }
        },

        methods: {

            validate: function () {

                let token = this.$localStorage.get('token');

                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                };

                axios.post('/api/validate', this.form, config)
                    .then(response => {
                        this.$emit('updateMatchingNamesTable', response.data.data.results)
                        if (response.data.data.results.length == 0) {
                            this.noResults = true;
                        } else {
                            this.noResults = false;
                        }
                    }).catch (error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }

</script>

<style scope>

</style>
