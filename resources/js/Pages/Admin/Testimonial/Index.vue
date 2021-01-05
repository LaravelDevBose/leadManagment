<template>
    <app-admin-layout>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Testimonial List</h4>
                        </template>
                        <template v-slot:headerAction>
                            <inertia-link :href="route('admin.testimonials.create')"  class="btn btn-sm btn-success">
                                <i class="ri-home-3-line"></i><span>Create Testimonial</span>
                            </inertia-link>
                        </template>
                        <template v-slot:body>
                            <alert-messages></alert-messages>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody v-if="testimonials && testimonials.length > 0">
                                <tr v-for="(testimonial, index) in testimonials" :key="index">
                                    <td>{{ testimonial.client_name}}</td>
                                    <td>{{ testimonial.testimonial_details}}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center text-right">
                                            <inertia-link
                                                :href="route('admin.testimonials.edit', testimonial.id)"
                                                class="avatar-45 text-center ml-3 rounded-circle iq-bg-success font-size-18"
                                                data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Edit"
                                            >
                                                <i class="ri-pencil-fill font-size-16"></i>
                                            </inertia-link>
                                            <a class="avatar-45 rounded-circle text-center ml-3 iq-bg-danger font-size-18"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title=""
                                               data-original-title="Delete"
                                               href="#"
                                               @click.prevent="deleteItem(testimonial.id)"
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
    props:['testimonials'],
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
                bag: 'testimonialForm',
                resetOnSuccess: false,
            }),
        }
    },
    methods:{
        deleteItem(id){
            this.form.post(route('admin.testimonials.destroy', id), {
                preserveScroll: true
            });
        }
    }
}
</script>

<style scoped>

</style>
