<template>
    <form @submit.prevent="$emit('submitted')">
        <div class="overflow-hidden sm:rounded-md">
            <div class="pb-3">
                <slot name="form"></slot>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6" v-if="hasActions">
                <slot name="actions"></slot>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    name: "FormArea",
    computed: {
        hasActions() {
            return !! this.$slots.actions
        }
    }
}
</script>

<style scoped>

</style>
