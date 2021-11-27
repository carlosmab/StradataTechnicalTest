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
                logs: [],
            }
        },

        methods: {
            search: function () {

                let token = this.$localStorage.get('token');

                const config = {
                    headers: { Authorization: `Bearer ${token}` }
                };

                axios.post('/api/logs', this.form, config)
                    .then(response => {
                        this.$emit('updateLogsTable', response.data.data)
                        console.log(response.data.data);
                    }).catch (error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }

</script>

<style scope>
</style>
