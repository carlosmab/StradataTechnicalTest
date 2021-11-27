<template>
    <div class="relative pb-3">
        <div class="relative">
            <label :for="name" class="uppercase text-green-500 text-xs font-bold absolute pl-3 pt-2">{{ label }}</label>
            <div>
                <input :id="name" v-model="value" class="pt-8 w-full rounded p-3 bg-green-100 border text-gray-900 outline-none focus:bg-white focus:border-b focus:border-green-500" :name="name"
                :type="type"
                :placeholder="placeholder"
                @input="updateField()"
                :class="errorClassObject()" >
            </div>
            <p class="text-red-600 text-sm" v-text="errorMessage()">Error here</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InputField",

        props: [
            'name', 'label', 'placeholder', 'errors', 'data', 'type'
        ],

        data: function () {
            return {
                value: ''
            }
        },

        computed: {
            hasError: function () {
                return this.errors && this.errors[this.name] && this.errors[this.name].length>0;
            }
        },

        methods: {
            updateField: function () {
                this.clearErrors(this.name);
                this.$emit('update:field', this.value);
            },

            errorMessage: function () {
                if (this.hasError) {
                    return this.errors[this.name][0];
                }
            },

            clearErrors: function () {
                if (this.hasError) {
                    this.errors[this.name] = null;
                }
            },

            errorClassObject: function () {
                return {
                    'error-field': this.hasError
                }
            }
        },

        watch: {
            data: function (val) {
                this.value = val
            }
        }
    }
</script>

<style scoped>
    .error-field {
        @apply border-red-500 border-b-2
    }
</style>
