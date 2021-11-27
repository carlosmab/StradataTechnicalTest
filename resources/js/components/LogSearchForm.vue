<template>
    <div class="justify-center">
        <form @submit.prevent="search()" class="flex">
            <div class="m-5 w-96">
                <InputSearchField name="uuid" label="UUID"
                    :errors="errors" @update:field="form.uuid = $event"/>
            </div>

            <div class="m-5 pb-3">
                <button class="w-40 h-auto bg-green-500 text-white  h-full text-bold uppercase rounded hover:bg-green-600">Buscar</button>
            </div>
        </form>
        <div v-if="founded" class="mt-10 ml-10">
            <div>
                <h2 class="text-bold uppercase text-green-500">Nombre Buscado</h2>
                <p>{{ searched_name }}</p>
            </div>
            <div class="mt-3">
                <h2 class="text-bold uppercase text-green-500">% Coincidencia</h2>
                <p>{{ match_rate }}</p>
            </div>
            <div class="mt-3 mb-10">
                <h2 class="text-bold uppercase text-green-500">Estado de la Ejecución</h2>
                <p>{{ execution_status }}</p>
            </div>
        </div>
        <div v-if="hasErrors">
            <p class="text-red-700 text-bold p-10">El texto ingresado no corresponde a ningún UUID</p>
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
                    uuid: '',
                },
                errors: [],
                founded: false,
                searched_name: "",
                match_rate: "",
                execution_status: "",
                hasErrors: false,
            }
        },

        methods: {
            search: function () {

                let token = this.$localStorage.get('token');

                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                };

                axios.get('/api/logs/' + this.form.uuid, config)
                    .then(response => {
                        try {
                            this.founded = true;
                            this.hasErrors = false;
                            this.searched_name = response.data.data.searched_name;
                            this.match_rate = response.data.data.match_rate;
                            this.execution_status = response.data.data.execution_status;
                            this.$emit('updateMatchingNamesTable', response.data.data.results);
                        } catch {
                            this.founded = false;
                            this.hasErrors = true;
                            this.searched_name = "";
                            this.match_rate = "";
                            this.execution_status = "";
                            this.$emit('updateMatchingNamesTable', []);
                        }


                    }).catch (error => {
                        this.founded = false;
                        this.hasErrors = true;
                        this.searched_name = "";
                        this.match_rate = "";
                        this.execution_status = "";
                        this.$emit('updateMatchingNamesTable', []);
                    });
            }
        }
    }

</script>

<style scope>
</style>
