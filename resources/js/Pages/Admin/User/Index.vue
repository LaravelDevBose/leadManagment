<template>
    <app-admin-layout>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Employee & Admin List</h4>
                        </template>
                        <template v-slot:headerAction>
                            <inertia-link :href="route('admin.users.create')"  class="btn btn-sm btn-success">
                                <i class="ri-home-3-line"></i><span>Create Employee & Admin</span>
                            </inertia-link>
                        </template>
                        <template v-slot:body>
                            <alert-messages></alert-messages>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody v-if="users && users.length > 0">
                                <tr v-for="(user, index) in users" :key="index">
                                    <td>{{ user.name}}</td>
                                    <td>{{ user.email}}</td>
                                    <td>
                                        <span v-if="user.role === 1" class="badge badge-info">Admin</span>
                                        <span v-if="user.role === 2" class="badge badge-primary">Employee</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center text-right">
                                            <inertia-link
                                                :href="route('admin.users.show', user.id)"
                                                class="avatar-45 text-center ml-3 rounded-circle iq-bg-primary font-size-18"
                                                data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="View"
                                            >
                                                <i class="ri-file-list-3-fill font-size-16"></i>
                                            </inertia-link>
                                            <inertia-link :href="route('admin.users.edit', user.id)"  class="avatar-45 text-center ml-3 rounded-circle iq-bg-success font-size-18" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                <i class="ri-pencil-fill font-size-16"></i>
                                            </inertia-link>
                                            <a class="avatar-45 rounded-circle text-center ml-3 iq-bg-danger font-size-18"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title=""
                                               data-original-title="Delete"
                                               href="#"
                                               @click.prevent="deleteItem(user.id)"
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
    props:['users'],
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
                bag: 'userFormBag',
                resetOnSuccess: false,
            }),
        }
    },
    methods:{
        deleteItem(id){
            this.form.post(route('admin.users.destroy', id), {
                preserveScroll: true
            });
        }
    }
}
</script>

<style scoped>

</style>
