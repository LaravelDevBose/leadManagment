<template>
    <app-admin-layout>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Service List</h4>
                        </template>
                        <template v-slot:headerAction>
                            <inertia-link :href="route('admin.services.create')"  class="btn btn-sm btn-success">
                                <i class="ri-home-3-line"></i><span>Create Service</span>
                            </inertia-link>
                        </template>
                        <template v-slot:body>
                            <alert-messages></alert-messages>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Service Title</th>
                                    <th>Service Icon</th>
                                    <th>Service Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody v-if="services && services.length > 0">
                                <tr v-for="(service, index) in services" :key="index">
                                    <td>{{ service.service_title}}</td>
                                    <td><i class="far " :class="service.service_icon"></i></td>
                                    <td>{{ service.service_details}}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center text-right">
                                            <inertia-link :href="route('admin.services.edit', service.id)"  class="avatar-45 text-center ml-3 rounded-circle iq-bg-success font-size-18" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="ri-pencil-fill font-size-16"></i>
                                            </inertia-link>
                                            <a class="avatar-45 rounded-circle text-center ml-3 iq-bg-danger font-size-18"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title=""
                                               data-original-title="Delete"
                                               href="#"
                                               @click.prevent="deleteItem(service.id)"
                                            >
                                                <i class="ri-delete-bin-line font-size-16"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </template>
                    </iq-card>
                </b-col>
            </b-row>
        </b-container>
    </app-admin-layout>
</template>

<script>
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import IqCard from "../../../Component/core/cards/iq-card";
import AlertMessages from "../../../Component/Include/AlertMessages";


export default {
    name: "Index",
    props:['services'],
    components: {
        AlertMessages,
        AppAdminLayout,
        IqCard
    },
    data(){
        return{
            form: this.$inertia.form({
                '_method': 'DELETE',
            }, {
                bag: 'serviceForm',
                resetOnSuccess: false,
            }),
        }
    },
    methods:{
        deleteItem(id){
            this.form.post(route('admin.services.destroy', id), {
                preserveScroll: true
            });
        }
    }
}
</script>

<style scoped>

</style>
