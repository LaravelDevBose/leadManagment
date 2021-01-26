<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="iq-card">
                        <div class="iq-card-header bg-primary d-flex justify-content-between">
                            <div class="iq-header-title ">
                                <h4 class="card-title text-white">About Client Documentation</h4>
                            </div>
                            <div class="iq-card-header-toolbar">
                                <a :href="route('admin.lead.print', lead.lead_id)"  class="btn btn-sm btn-success">
                                    <i class="ri-printer-fill"></i><span>Print</span>
                                </a>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                 <div class="row">
                                    <div class="col-3">Created:</div>
                                    <div class="col-9">{{ lead.created_at }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Full Name:</div>
                                    <div class="col-9">{{ lead.full_name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Email:</div>
                                    <div class="col-9"><a :href="'mailto:'+lead.email"> {{ lead.email }}</a></div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Phone:</div>
                                    <div class="col-9">{{ lead.phone_no }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Location:</div>
                                    <div class="col-9">{{ lead.full_address}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card" v-if="lead.current_step  >= 2">
                        <div class="iq-card-header bg-warning d-flex justify-content-between">
                            <div class="iq-header-title ">
                                <h4 class="card-title text-white">Vehicle information</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                <div class="row">
                                    <div class="col-3">VIN No.:</div>
                                    <div class="col-9">{{ lead.vin_no }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Year:</div>
                                    <div class="col-9"> {{ lead.year }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Make:</div>
                                    <div class="col-9">{{ lead.make }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Model:</div>
                                    <div class="col-9">{{ lead.model}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Color:</div>
                                    <div class="col-9">{{ lead.color}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Mileage:</div>
                                    <div class="col-9">{{ lead.mileage}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-3">Lein Holder Info:</div>
                                    <div class="col-9">{{ lead.lein_holder_info}}</div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="iq-card" v-if="lead.current_step  >= 3">
                        <div class="iq-card-header d-flex justify-content-between" :class="lead.trans_status === 'Issue'?'bg-danger': 'bg-info'">
                            <div class="iq-header-title ">
                                <h4 class="card-title text-white">Transaction/Payment information</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                <div class="row" v-if="lead.trans_status_extra && lead.trans_status_extra.lenght > 0">
                                    <div class="col-12 py-2"><h4>Transaction Details:</h4></div>
                                    <div class="col-12 border-bottom" v-for="(transaction, index) in lead.trans_status_extra" :key="index">
                                        <div class="row">
                                            <div class="col-5">Date:</div>
                                            <div class="col-7" v-if="transaction.trans_date"> {{ transaction.trans_date | formated('DD-MMM-YYYY') }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">Status:</div>
                                            <div class="col-7">{{ transaction.trans_status }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">Type:</div>
                                            <div class="col-7">{{ transaction.trans_type }}</div>
                                        </div>
                                        <div class="row" v-if="transaction.trans_status === 'At DMV'">
                                            <div class="col-5">Tracking:</div>
                                            <div class="col-7" v-if="transaction.dmv_tracking !== null"> {{ transaction.dmv_tracking ? transaction.dmv_tracking : ''  }}</div>
                                        </div>
                                        <div class="row" v-if="transaction.trans_status === 'Completed'">
                                            <div class="col-5">Plate:</div>
                                            <div class="col-7" v-if="transaction.complete_plate !== null" > {{ transaction.complete_plate ? transaction.complete_plate : '' }}</div>
                                        </div>
                                        <div class="row" v-if="transaction.trans_status === 'Issue'">
                                            <div class="col-5">Issue Note:</div>
                                            <div class="col-7" v-if="transaction.issue_note !== null"> {{ transaction.issue_note ? transaction.issue_note : '' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 py-2"><h4>Payment Details:</h4></div>
                                    <div class="col-12 py-2" v-if="lead.payment_type_extra">
                                        <table class="table table-sm table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Method</th>
                                                    <th>Track No</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(payment, index) in lead.payment_type_extra" :key="index">
                                                    <td>{{ payment.payment_type }}</td>
                                                    <td>{{ payment.track_no }}</td>
                                                    <td>{{ payment.amount }}</td>
                                                    <td>{{ payment.type }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-card" v-if="lead.current_step  >= 4">
                        <div class="iq-card-header bg-success d-flex justify-content-between">
                            <div class="iq-header-title ">
                                <h4 class="card-title text-white">Special Request</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                <div class="row">
                                    <div class="col-3">Note:</div>
                                    <div class="col-9">{{ lead.special_note }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="iq-card" v-if="lead.logs">
                        <div class="iq-card-header bg-blue-700 d-flex justify-content-between">
                            <div class="iq-header-title ">
                                <h4 class="card-title text-white">Activity Logs</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="list-group">
                                            <li v-for="log in lead.logs" :key="log.created_at"  class="list-group-item list-group-item-action p-1">
                                                <p class="mb-0">{{ log.log_message }}</p>
                                                <small>{{ log.created_at | diffForHumans}}</small>
                                            </li>
                                        </div>
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
                                <div class="iq-card-body p-0">
                                    <div class="iq-edit-list">
                                        <ul class="iq-edit-profile d-flex nav nav-pills">
                                            <li class="col-md-3 p-0">
                                                <a class="nav-link Personal" :class="lead.current_step === 4? 'active': '' "  data-toggle="pill" href="#Personal">
                                                    Personal Documentation
                                                </a>
                                            </li>
                                            <li class="col-md-3 p-0">
                                                <a class="nav-link Vehicle" :class="lead.current_step === 1? 'active': '' " data-toggle="pill" href="#Vehicle">
                                                    Vehicle information
                                                </a>
                                            </li>
                                            <li class="col-md-3 p-0">
                                                <a class="nav-link Transaction" :class="lead.current_step === 2? 'active': '' " data-toggle="pill" href="#Transaction">
                                                    Transaction information
                                                </a>
                                            </li>
                                            <li class="col-md-3 p-0">
                                                <a class="nav-link Special" :class="lead.current_step === 3? 'active': '' " data-toggle="pill" href="#Special">
                                                    Special Request
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="iq-edit-list-data">
                                <div class="tab-content">
                                    <div class="row" v-if="$page.flash.success || $page.flash.error">
                                        <div class="col-12">
                                            <jet-action-message :on="$page.flash.success">
                                                <div class="alert alert-success">
                                                    {{ $page.flash.success}}
                                                    <button type="button" class="close" aria-label="Close" @click.prevent="closeAlertMsg">
                                                        <span aria-hidden="true" class="text-white font-weight-bold">&times;</span>
                                                    </button>
                                                </div>
                                            </jet-action-message>
                                            <jet-action-message :on="$page.flash.error">
                                                <div class="alert alert-danger">
                                                    {{ $page.flash.error}}
                                                    <button type="button" class="close" data-dismiss="modal" @click.prevent="closeAlertMsg">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </jet-action-message>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" :class="lead.current_step === 4? 'active show': '' " id="Personal" role="tabpanel">
                                        <div class="iq-card">
                                            <div class="iq-card-header bg-primary d-flex justify-content-between">
                                                <div class="iq-header-title">
                                                    <h4 class="card-title text-white font-weight-bold">Personal Documentation</h4>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <form-area @submitted="updatePersonalInfo">
                                                    <template #form>
                                                        <div class="row">
                                                            <div class="col-sm-6 form-group">
                                                                <jet-label for="first_name" value="First Name" />
                                                                <jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="personalInfoForm.first_name" autocomplete="name" :required="false" />
                                                                <jet-input-error :message="personalInfoForm.error('first_name')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <jet-label for="last_name" value="Last Name" />
                                                                <jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="personalInfoForm.last_name" autocomplete="name" :required="false" />
                                                                <jet-input-error :message="personalInfoForm.error('last_name')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <jet-label for="sec_client_first_name" value="Second Buyer First Name" />
                                                                <jet-input id="sec_client_first_name" type="text" class="mt-1 block w-full" v-model="personalInfoForm.sec_client_first_name" autocomplete="name" :required="false" />
                                                                <jet-input-error :message="personalInfoForm.error('sec_client_first_name')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6 form-group">
                                                                <jet-label for="sec_client_last_name" value="Second Buyer Last Name" />
                                                                <jet-input id="sec_client_last_name" type="text" class="mt-1 block w-full" v-model="personalInfoForm.sec_client_last_name" autocomplete="name" :required="false" />
                                                                <jet-input-error :message="personalInfoForm.error('sec_client_last_name')" class="mt-2" />
                                                            </div>
                                                            <!-- Email -->
                                                            <div class="col-sm-4 form-group">
                                                                <jet-label for="email" value="Email" />
                                                                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="personalInfoForm.email"  :required="false" />
                                                                <jet-input-error :message="personalInfoForm.error('email')" class="mt-2" />
                                                            </div>

                                                            <div class="col-sm-4 form-group">
                                                                <jet-label for="phone" value="Phone No." />
                                                                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="personalInfoForm.phone_no" :required="true" />
                                                                <jet-input-error :message="personalInfoForm.error('phone_no')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-4 form-group">
                                                                <jet-label for="phone" value="Dealer Name" />
                                                                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="personalInfoForm.dealer_name" :required="false" />
                                                                <jet-input-error :message="personalInfoForm.error('dealer_name')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-12 form-group">
                                                                <jet-label for="address" value="Address" />
                                                                <jet-input id="address" type="text" class="mt-1 block w-full" v-model="personalInfoForm.address"  :required="true" />
                                                                <jet-input-error :message="personalInfoForm.error('address')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-4 form-group">
                                                                <jet-label for="city" value="City" />
                                                                <jet-input id="city" type="text" class="mt-1 block w-full" v-model="personalInfoForm.city" :required="true"  />
                                                                <jet-input-error :message="personalInfoForm.error('city')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-4 form-group">
                                                                <jet-label for="state" value="State" />
                                                                <jet-input id="state" type="text" class="mt-1 block w-full" v-model="personalInfoForm.state" :required="true"  />
                                                                <jet-input-error :message="personalInfoForm.error('state')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-4 form-group">
                                                                <jet-label for="postal_code" value="Zip Code" />
                                                                <jet-input id="postal_code" type="text" class="mt-1 block w-full" v-model="personalInfoForm.postal_code" :required="true"  />
                                                                <jet-input-error :message="personalInfoForm.error('postal_code')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <template #actions>
                                                        <jet-action-message :on="personalInfoForm.recentlySuccessful" class="mr-3">
                                                            Updated.
                                                        </jet-action-message>

                                                        <jet-button :class="{ 'opacity-25': personalInfoForm.processing }" :disabled="personalInfoForm.processing">
                                                            Update
                                                        </jet-button>
                                                    </template>
                                                </form-area>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" :class="lead.current_step === 1? 'active show': '' "  id="Vehicle" role="tabpanel">
                                        <div class="iq-card">
                                            <div class="iq-card-header bg-warning d-flex justify-content-between">
                                                <div class="iq-header-title">
                                                    <h4 class="card-title text-white font-weight-bold">Vehicle information</h4>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <form-area @submitted="updateVehicleInfo">
                                                    <template #form>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <jet-label for="vin_no" value="VIN No." />
                                                                <jet-input id="vin_no" type="text" class="mt-1 block w-full" v-model="vehicleForm.vin_no" autocomplete="name" :required="true" />
                                                                <jet-input-error :message="vehicleForm.error('vin_no')" class="mt-2" />
                                                            </div>

                                                            <!-- Email -->
                                                            <div class="col-sm-6">
                                                                <jet-label for="year" value="Year" />
                                                                <jet-input id="year" type="number" class="mt-1 block w-full" v-model="vehicleForm.year"  :required="true" />
                                                                <jet-input-error :message="vehicleForm.error('year')" class="mt-2" />
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <jet-label for="make" value="Make" />
                                                                <jet-input id="make" type="text" class="mt-1 block w-full" v-model="vehicleForm.make" :required="true" />
                                                                <jet-input-error :message="vehicleForm.error('make')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <jet-label for="model" value="Model" />
                                                                <jet-input id="model" type="text" class="mt-1 block w-full" v-model="vehicleForm.model"  :required="true" />
                                                                <jet-input-error :message="vehicleForm.error('model')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <jet-label for="color" value="Color" />
                                                                <jet-input id="color" type="text" class="mt-1 block w-full" v-model="vehicleForm.color"  :required="true" />
                                                                <jet-input-error :message="vehicleForm.error('color')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <jet-label for="mileage" value="Mileage" />
                                                                <jet-input id="mileage" type="number" class="mt-1 block w-full" v-model="vehicleForm.mileage"  :required="true" />
                                                                <jet-input-error :message="vehicleForm.error('mileage')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <jet-label for="lein_holder_info" value="Lein Holder Info" />
                                                                <textarea id="lein_holder_info" class="form-control mt-1 block w-full" v-model="vehicleForm.lein_holder_info"  rows="3" style="line-height: 22px;"> </textarea>
                                                                <jet-input-error :message="vehicleForm.error('lein_holder_info')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <template #actions>
                                                        <jet-action-message :on="vehicleForm.recentlySuccessful" class="mr-3">
                                                            Saved.
                                                        </jet-action-message>

                                                        <jet-button :class="{ 'opacity-25': vehicleForm.processing }" :disabled="vehicleForm.processing">
                                                            Save
                                                        </jet-button>
                                                    </template>
                                                </form-area>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" :class="lead.current_step === 2? 'active show': '' "  id="Transaction" role="tabpanel">
                                        <div class="iq-card">
                                            <div class="iq-card-header bg-info d-flex justify-content-between">
                                                <div class="iq-header-title">
                                                    <h4 class="card-title text-white font-weight-bold">Transaction/Payment information</h4>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <form-area @submitted="updateTransactionInfo">
                                                    <template #form>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <jet-label for="trans_status" value="Transaction Status" />
                                                                <select class="form-control mt-1 block w-full" v-model="transactionForm.trans_status" id="trans_status">
                                                                    <option value="In Office">In Office</option>
                                                                    <option value="At DMV">At DMV</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Issue">Issue</option>
                                                                </select>
                                                                <jet-input-error :message="transactionForm.error('trans_status')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <jet-label for="trans_type" value="Transaction Type" />
                                                                <jet-input id="trans_type" type="text" class="mt-1 block w-full" v-model="transactionForm.trans_type"  :required="true" />
                                                                <jet-input-error :message="transactionForm.error('trans_type')" class="mt-2" />
                                                            </div>
                                                            
                                                            <div class="col-sm-12" v-if="transactionForm.trans_status === 'Issue'">
                                                                <jet-label for="Issue" value="Issue Note" />
                                                                <textarea id="Issue" class="form-control mt-1 block w-full" required v-model="transactionForm.trans_status_extra.issue_note"  rows="3" style="line-height: 22px;"> </textarea>
                                                                <jet-input-error :message="transactionForm.error('trans_status_extra.issue_note')" class="mt-2" />
                                                            </div>
                                                            <div class="col-sm-12" v-else>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <jet-label for="date" value="Date" />
                                                                        <flat-pickr 
                                                                        id="date" 
                                                                        v-model="transactionForm.trans_status_extra.trans_date" 
                                                                        class="mt-1 block w-full form-input rounded-md shadow-sm"  
                                                                        :config="basicTimeConfig" 
                                                                        placeholder="Select Date"
                                                                        ></flat-pickr>
                                                                        <jet-input-error :message="transactionForm.error('trans_status_extra.trans_date')" class="mt-2" />
                                                                    </div>
                                                                    <div class="col-sm-6" v-if="transactionForm.trans_status === 'At DMV'">
                                                                        <jet-label for="tracking" value="Tracking No" />
                                                                        <jet-input 
                                                                        id="tracking" 
                                                                        type="text" 
                                                                        class="mt-1 block w-full" 
                                                                        v-model="transactionForm.trans_status_extra.dmv_tracking"  
                                                                        :required="true" />
                                                                        <jet-input-error :message="transactionForm.error('trans_status_extra.dmv_tracking')" class="mt-2" />
                                                                    </div>
                                                                    <div class="col-sm-6" v-if="transactionForm.trans_status === 'Completed'">
                                                                        <jet-label for="plate" value="plate" />
                                                                        <jet-input 
                                                                        id="plate" 
                                                                        type="text" 
                                                                        class="mt-1 block w-full" 
                                                                        v-model="transactionForm.trans_status_extra.complete_plate"
                                                                        :required="true" />
                                                                        <jet-input-error :message="transactionForm.error('trans_status_extra.complete_plate')" class="mt-2" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row" v-if="transactionForm.trans_status === 'In Office'">
                                                            <div class="col-sm-6">
                                                                <jet-label for="payment_type" value="Payment Info" />
                                                                <select class="form-control mt-1 block w-full" v-model="transactionForm.payment_type" id="payment_type">
                                                                    <option value="">Select a payment type</option>
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Cash App">Cash App</option>
                                                                    <option value="Check">Check</option>
                                                                    <option value="Paypal">Paypal</option>
                                                                    <option value="Venmo">Venmo</option>
                                                                    <option value="Zelle">Zelle</option>
                                                                </select>
                                                                <jet-input-error :message="transactionForm.error('payment_type')" class="mt-2" />
                                                            </div>
                                                            <div class="col-md-12"  v-if="transactionForm.payment_type">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <jet-label for="check_no" value="Track No" />
                                                                        <jet-input id="check_no" type="text" class="mt-1 block w-full" v-model="transactionForm.payment_type_extra.track_no"  :required="false" />
                                                                        <jet-input-error :message="transactionForm.error('payment_type_extra.track_no')" class="mt-2" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <jet-label for="amount" value="Amount" />
                                                                        <jet-input id="amount" type="number" step="0.0" class="mt-1 block w-full" v-model="transactionForm.payment_type_extra.amount"  :required="true" />
                                                                        <jet-input-error :message="transactionForm.error('payment_type_extra.amount')" class="mt-2" />
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <jet-label for="amount_type" value="Amount Type" />
                                                                        <select class="form-control mt-1 block w-full" required v-model="transactionForm.payment_type_extra.type" id="amount_type">
                                                                            <option value="Full Payment">Full Payment</option>
                                                                            <option value="Partial payment">Partial payment</option>
                                                                        </select>
                                                                        <jet-input-error :message="transactionForm.error('payment_type_extra.type')" class="mt-2" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </template>

                                                    <template #actions>
                                                        <jet-action-message :on="transactionForm.recentlySuccessful" class="mr-3">
                                                            Saved.
                                                        </jet-action-message>

                                                        <jet-button :class="{ 'opacity-25': transactionForm.processing }" :disabled="transactionForm.processing">
                                                            Save
                                                        </jet-button>
                                                    </template>
                                                </form-area>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" :class="lead.current_step === 3? 'active show': '' "  id="Special" role="tabpanel">
                                        <div class="iq-card">
                                            <div class="iq-card-header bg-success d-flex justify-content-between">
                                                <div class="iq-header-title">
                                                    <h4 class="card-title text-white font-weight-bold">Special Request</h4>
                                                </div>
                                            </div>
                                            <div class="iq-card-body">
                                                <form-area @submitted="updateSpecialReqInfo">
                                                    <template #form>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <jet-label for="special_note" value="Special Note" />
                                                                <textarea id="special_note" class="form-control mt-1 block w-full" v-model="specialReqForm.special_note"  rows="5" style="line-height: 22px;"> </textarea>
                                                                <jet-input-error :message="specialReqForm.error('special_note')" class="mt-2" />
                                                            </div>
                                                        </div>
                                                    </template>

                                                    <template #actions>
                                                        <jet-action-message :on="specialReqForm.recentlySuccessful" class="mr-3">
                                                            Saved.
                                                        </jet-action-message>

                                                        <jet-button :class="{ 'opacity-25': specialReqForm.processing }" :disabled="specialReqForm.processing">
                                                            Save
                                                        </jet-button>
                                                    </template>
                                                </form-area>
                                            </div>
                                        </div>
                                    </div>
                                    
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
import FormArea from "../../../Component/Form/FormArea";
import JetButton from '@/Jetstream/Button';
import JetFormSection from '@/Jetstream/FormSection';
import JetInput from '@/Jetstream/Input';
import JetInputError from '@/Jetstream/InputError';
import JetLabel from '@/Jetstream/Label';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import VueFlatPicker from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'

export default {
    name: "Show",
    props: ['lead'],
    components: {
        AppAdminLayout,
        FormArea,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        'flat-pickr':VueFlatPicker
    },
    data() {
        return {
            basicTimeConfig: {
                enableTime: false,
                dateFormat: 'Y-m-d'
            },
            personalInfoForm: this.$inertia.form({
                first_name: '',
                last_name: '',
                sec_client_first_name:'',
                sec_client_last_name: '',
                dealer_name: '',
                email: '',
                phone_no:'',
                address:'',
                city:'',
                state:'',
                postal_code:''
            }, {
                bag: 'personalInfoForm',
                resetOnSuccess: false,
            }),
            vehicleForm: this.$inertia.form({
                vin_no: '',
                year: '',
                make:'',
                model:'',
                color:'',
                mileage:'',
                lein_holder_info:'',
            }, {
                bag: 'vehicleForm',
                resetOnSuccess: false,
            }),
            specialReqForm: this.$inertia.form({
                special_note: '',
            }, {
                bag: 'specialReqForm',
                resetOnSuccess: false,
            }),
            transactionForm: this.$inertia.form({
                trans_status: 'In Office',
                trans_type: '',
                payment_type: '',
                trans_status_extra: {
                    trans_date: '',
                    dmv_tracking: '',
                    complete_plate: '',
                    issue_note: '',
                },
                payment_type_extra: {
                        track_no:'',
                        amount: 0,
                        type: 'Full Payment',
                    },
            }, {
                bag: 'transactionForm',
                resetOnSuccess: false,
            }),
            
        }
    },
    created() {
        dayjs.extend(relativeTime);
    },
    mounted() {
        this.updatePersonalInfoFormData();

        if (this.lead.current_step  >= 2){
            this.updateVehicleFormData();
            if (this.lead.current_step  >= 3){
                this.updateTransactionFormData();
                if (this.lead.current_step  >= 4){
                    this.updateSpecialReqFormData();
                }
            }


        }

    },
    methods:{
        updatePersonalInfoFormData(){
            this.personalInfoForm.first_name = this.lead.first_name;
            this.personalInfoForm.last_name = this.lead.last_name;
            this.personalInfoForm.sec_client_first_name = this.lead.sec_client_first_name;
            this.personalInfoForm.sec_client_last_name = this.lead.sec_client_last_name;
            this.personalInfoForm.dealer_name = this.lead.dealer_name;
            this.personalInfoForm.email = this.lead.email;
            this.personalInfoForm.phone_no = this.lead.phone_no;
            this.personalInfoForm.address = this.lead.address;
            this.personalInfoForm.city = this.lead.city;
            this.personalInfoForm.state = this.lead.state;
            this.personalInfoForm.postal_code = this.lead.postal_code;
        },
        updateVehicleFormData(){
            this.vehicleForm.vin_no = this.lead.vin_no;
            this.vehicleForm.year = this.lead.year;
            this.vehicleForm.make = this.lead.make;
            this.vehicleForm.model = this.lead.model;
            this.vehicleForm.color = this.lead.color;
            this.vehicleForm.mileage = this.lead.mileage;
            this.vehicleForm.lein_holder_info = this.lead.lein_holder_info;
        },
        updateTransactionFormData(){
            // this.transactionForm.trans_status = this.lead.trans_status;
            // this.transactionForm.trans_type = this.lead.trans_type;
            // if(this.lead.trans_status_extra !== null){
            //     this.transactionForm.trans_status_extra = this.lead.trans_status_extra;
            // }
        },
        updateSpecialReqFormData(){
            this.specialReqForm.special_note = this.lead.special_note;
        },

        updatePersonalInfo() {
            this.personalInfoForm.post(route('admin.personal.update', this.lead.lead_id), {
                preserveScroll: true
            });
        },
        updateVehicleInfo() {
            this.vehicleForm.post(route('admin.vehicle.update', this.lead.lead_id), {
                preserveScroll: true
            });
        },
        updateTransactionInfo() {
            this.transactionForm.post(route('admin.transaction.update', this.lead.lead_id), {
                preserveScroll: true
            });
        },
        updateSpecialReqInfo() {
            this.specialReqForm.post(route('admin.special_req.update', this.lead.lead_id), {
                preserveScroll: true
            });
        },
        leadPrint(){
            window.open();
        }
    },
    filters: {
        diffForHumans: (date) => {
            if (!date){
                return null;
            }

            return dayjs(date).fromNow();
        },
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
    .nav-link.active{
        background: transparent!important;
    }
    .Personal.active{
        background: var(--iq-primary) !important;
    }
    .Vehicle.active{
        background: var(--iq-warning) !important;
    }
    .Transaction.active{
        background: var(--iq-info) !important;
    }
    .Special.active{
        background: var(--iq-success) !important;
    }
</style>
