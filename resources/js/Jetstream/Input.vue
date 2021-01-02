<template>
    <input
        class="form-input rounded-md shadow-sm"
        :value="value"
        @input="$emit('input', $event.target.value)"
        ref="input"
        :required="required"
        :placeholder="placeholder"
    >
</template>

<script>
    export default {
        props: ['value', 'required','placeholder'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

