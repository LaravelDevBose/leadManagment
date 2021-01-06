<template>
    <app-admin-layout>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <iq-card>
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Client List</h4>
                        </template>
                        <template v-slot:body>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Progress</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="leads && leads.length > 0">
                                    <tr v-for="(lead, index) in leads" :key="index">
                                        <td>{{ lead.full_name}}</td>
                                        <td>{{ lead.email}}</td>
                                        <td>{{ lead.phone_no}}</td>
                                        <td>{{ lead.full_address}}</td>
                                        <td style="max-width: 7rem">
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" v-if="lead.current_step  >= 1" style="width:25%"> </div>
                                                <div class="progress-bar bg-warning" v-if="lead.current_step  >= 2" style="width:25%"></div>
                                                <div class="progress-bar bg-info" v-if="lead.current_step  >= 3" style="width:25%"></div>
                                                <div class="progress-bar bg-success" v-if="lead.current_step === 4" style="width:25%"></div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex align-items-center text-right">
                                                <inertia-link
                                                    :href="route('admin.lead.show', lead.lead_id)"
                                                    class="avatar-45 text-center ml-3 rounded-circle iq-bg-success font-size-18"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Edit"
                                                >
                                                    <i class="ri-pencil-fill font-size-16"></i>
                                                </inertia-link>
<!--                                                <a class="avatar-45 rounded-circle text-center ml-3 iq-bg-danger font-size-18"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title=""
                                                   data-original-title="Delete"
                                                   href="#"
                                                   @click.prevent="deleteItem(testimonial.id)"
                                                >
                                                    <i class="ri-delete-bin-line font-size-16"></i>
                                                </a>-->
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

export default {
    name: "Table",
    props:['leads'],
    components: {
        AppAdminLayout,
        IqCard,
    }
}
</script>

<style scoped>
    tr:hover .progress{
        background-color: #ffffff;
    }
</style>
