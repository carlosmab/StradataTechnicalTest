<template>
    <div class="mx-auto h-screen flex justify-center items-center bg-gray-300">
        <div class="w-96 bg-green-900 rounded-lg shadow-xl p-6">
            <p class="uppercase text-bold text-white">Stradata</p>

            <h1 class="text-white text-3xl pt-8">Bienvenido</h1>

            <form class="pt-8" @submit.prevent="login()">
                <InputField name="email" label="E-mail" placeholder="mi@email..com" :errors="errors" @update:field="form.email = $event" />

                <InputField name="password" label="Contraseña" type="password" :errors="errors" @update:field="form.password = $event" />

                <div class="pt-8">
                    <button type="submit" class="uppercase py-2 px-3 rounded text-left text-green-800 font-bold w-full bg-gray-400">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import auth from "../auth";
import InputField from "../components/InputField.vue"

export default {
    name: "Register",

    components: {
        InputField
    },

    data: function() {
        return {
            form: {
                'email': "",
                'password': "",
            },
            errors: null
        }
    },

    methods: {
        async login () {
            try {
                await auth.login(this.form)
                    .then(response => {
                        console.log(response);
                        this.$router.push('/');
                    }).catch(errors => {
                        this.errors = errors.response.data.error
                    })
            }

        }
    }


}
</script>

<style>

</style>
