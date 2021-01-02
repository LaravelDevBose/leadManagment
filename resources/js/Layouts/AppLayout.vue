<template>
    <section class="contact">
        <div class="container">
            <slot name="header"></slot>
            <template>
                <slot></slot>
            </template>
        </div>
    </section>
</template>

<script>

    export default {
        name: "AppLayout",
        components: {
        },
    }
</script>
