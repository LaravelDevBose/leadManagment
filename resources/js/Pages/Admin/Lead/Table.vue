<template>
    <app-admin-layout>
        <b-container fluid>
            <b-row>
                <b-col sm="12">
                    <iq-card class="pb-3">
                        <template v-slot:headerTitle>
                            <h4 class="card-title">Client List</h4>
                        </template>
                        <template v-slot:headerAction>
                            <inertia-link :href="route('admin.lead.create')"  class="btn btn-primary">
                                <i class="ri-add-box-line font-size-18"></i> <span>Add New Client</span>
                            </inertia-link>
                        </template>
                        <template v-slot:body>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Created At</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Progress</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody v-if="leads">
                                    <tr v-for="(lead, index) in leads.data" :key="index">
                                        <td>{{ lead.created_at}}</td>
                                        <td>{{ lead.full_name}}</td>
                                        <td>{{ lead.email}}</td>
                                        <td>{{ lead.phone_no}}</td>
                                        <td>{{ lead.full_address}}</td>
                                        <td style="max-width: 7rem">
                                            <div class="progress" v-if="lead.trans_status === 'Issue' && lead.current_step  >= 3">
                                                <div class="progress-bar bg-danger" style="width:100%"> </div>
                                            </div>
                                            <div class="progress" v-else-if="lead.trans_status === 'Completed' && lead.current_step  >= 3">
                                                <div class="progress-bar bg-success" style="width:100%"></div>
                                            </div>
                                            <div class="progress" v-else>
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
                                                <a class="avatar-45 rounded-circle text-center ml-3 iq-bg-danger font-size-18"
                                                   data-toggle="tooltip"
                                                   data-placement="top"
                                                   title=""
                                                   data-original-title="Delete"
                                                   href="#"
                                                   @click.prevent="deleteItem(lead.lead_id)"
                                                >
                                                    <i class="ri-delete-bin-line font-size-16"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
                        <pagination :meta="leads"></pagination>
                    </iq-card>
                </b-col>
            </b-row>
        </b-container>
    </app-admin-layout>
</template>

<script>
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import IqCard from "../../../Component/core/cards/iq-card";
import Pagination from '../../../Component/helper/Pagination.vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

export default {
    name: "Table",
    props:['leads'],
    components: {
        AppAdminLayout,
        IqCard,
        Pagination,
    },
    data(){
        return{
            form: this.$inertia.form({
                '_method': 'DELETE',
            }, {
                bag: 'serviceForm',
                resetOnSuccess: false,
            }),
            paginates: {},
        }
    },
    methods:{
        deleteItem(id){
            this.form.post(route('admin.lead.destroy', id), {
                preserveScroll: true
            });
        }
    },
    computed:{
        checkLeadsData(){
            console.log
            return JSON.parse(JSON.stringify(this.leads))
        }
    },
    watch:{
        leads:{
            handler(newValue, oldValue){
                const leadDate = {...this.leads};
                console.log(leadDate);
                    delete leadDate.data;
                    
                    this.paginates = {...leadDate};
            },
            deep:true,
        },
    },
    filters: {
    
        formated: (date, format) => {
            if (!date){
                return null;
            }

            return dayjs(date).format(format);
        }
    },
}
</script>

<style scoped>
    tr:hover .progress{
        background-color: #ffffff;
    }
</style>
