<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="iq-card">
                        <div class="iq-card-header bg-primary d-flex justify-content-between">
                            <div class="iq-header-title ">
                                <h4 class="card-title text-white">User Details</h4>
                            </div>
                        </div>
                        <div class="iq-card-body" v-if="userInfo">
                            <div class="about-info m-0 p-0">
                                <div class="row">
                                    <div class="col-3">Name:</div>
                                    <div class="col-9">{{ userInfo.name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Email:</div>
                                    <div class="col-9">{{ userInfo.email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Role:</div>
                                    <div class="col-9">
                                        <span v-if="userInfo.role === 1" class="badge badge-info">Admin</span>
                                        <span v-if="userInfo.role === 2" class="badge badge-primary">Employee</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="iq-card">
                                <div class="iq-card-header bg-success d-flex justify-content-between">
                                    <div class="iq-header-title ">
                                        <h4 class="card-title text-white">User Attendances</h4>
                                    </div>
                                </div>
                                <div class="iq-card-header">
                                    <form action="" @submit.prevent="search">
                                        <div class="row">
                                            <div class="col-sm-3 mt-1">
                                                <flat-pickr id="start" v-model="form.start" class="mt-1 block w-full form-input rounded-md shadow-sm"  :config="basicTimeConfig" placeholder="Select start date"></flat-pickr>
                                                <jet-input-error :message="form.error('start')" class="mt-2" />
                                            </div>
                                            <div class="col-sm-3 mt-1">
                                                <flat-pickr id="end" v-model="form.end" class="mt-1 block w-full form-input rounded-md shadow-sm"  :config="basicTimeConfig" placeholder="Select end date"></flat-pickr>
                                                <jet-input-error :message="form.error('end')" class="mt-2" />
                                            </div>
                                            <div class="col-sm-3 mt-2">
                                                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                    Search
                                                </jet-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="iq-card-body">
                                    <table class="table table-sm table-hover table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Login Time</th>
                                                <th>Logout Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-if="attendances" v-for="(attendance, index) in attendances">
                                                <td>{{ index+1}}</td>
                                                <td>{{ attendance.date }}</td>
                                                <td>{{ attendance.login_time}}</td>
                                                <td>{{ attendance.logout_time }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-admin-layout>
</template>

<script>
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import VueFlatPicker from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css';
import JetInputError from '@/Jetstream/InputError';
import JetButton from '@/Jetstream/Button';
export default {
    name: "Show",
    props: ['userInfo', 'attendances'],
    components: {
        AppAdminLayout,
        'flat-pickr':VueFlatPicker,
        JetInputError,
        JetButton
    },
    data(){
        return{
            form: this.$inertia.form({
                '_method': 'GET',
                start: '',
                end: '',
            }, {
                resetOnSuccess: false,
            }),
            basicTimeConfig: {
                enableTime: false,
                dateFormat: 'Y-m-d'
            }
        }
    },
    methods:{
        search(){
            this.form.post(route('admin.users.show', this.userInfo.id), {
                preserveScroll: true,
            });
        }
    }
}
</script>

<style scoped>

</style>
