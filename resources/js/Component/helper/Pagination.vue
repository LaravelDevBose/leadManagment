<template>
    <div class="d-flex justify-content-between px-3" v-if="showPagination">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing {{ meta.from }} to {{ meta.to }} of
            {{ meta.total }} entries
        </div>
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination">
                <li class="paginate_button page-item" v-for="(link, key) in meta.links" :key="key" v-bind:class="isActive(link)">
                    <inertia-link class="page-link" :href="link.url" v-if="link.url" v-html="link.label"></inertia-link>
                    <a class="page-link" href="#" v-else @click.prevent="handleNoLink" v-html="link.label "></a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        meta: Object,
    },
    computed: {
        showPagination() {
            return this.meta.links.length > 3
        }
    },
    methods: {
        isActive(link) {
            return (link.active === true) ? 'active' : 'normal'
        },
        handleNoLink() {
            return false
        }
    }
}
</script>

<style scoped>
.pagination{
    border-color: var(--iq-primary-dark);
}
.page-link{
    color: var(--iq-primary-light);
    border-color: var(--iq-primary-dark);
}
.page-item.active .page-link{
    background-color:var(--iq-primary);
    border-color: var(--iq-primary-dark);
}
</style>
