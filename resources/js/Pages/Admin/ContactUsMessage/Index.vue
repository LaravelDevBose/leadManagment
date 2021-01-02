<template>
    <app-admin-layout>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Contact Us Message List</h4>
                        </template>
                        <template v-slot:body>
                            <alert-messages></alert-messages>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone no</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody v-if="messages && messages.length > 0">
                                <tr v-for="(message, index) in messages" :key="index">
                                    <td>{{ message.first_name}}</td>
                                    <td>{{ message.last_name}}</td>
                                    <td>{{ message.email}}</td>
                                    <td>{{ message.phone_no}}</td>
                                    <td>{{ message.message}}</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center text-right">
                                            <a class="avatar-45 rounded-circle text-center ml-3 iq-bg-danger font-size-18"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title=""
                                               data-original-title="Delete"
                                               href="#"
                                               @click.prevent="deleteItem(message.id)"
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
    props:['messages'],
    components: {
        AlertMessages,
        AppAdminLayout,
        IqCard
    },
    data(){
        return{
            form: this.$inertia.form({
                '_method': 'DELETE',
            }),
        }
    },
    methods:{
        deleteItem(id){
            this.form.post(route('admin.contact_us.message.delete', id), {
                preserveScroll: true
            });
        }
    }
}
</script>

<style scoped>

</style>
