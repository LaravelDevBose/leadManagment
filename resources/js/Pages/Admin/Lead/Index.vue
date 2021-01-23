<template>
    <app-admin-layout>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <b-row>
                        <b-col cols="12 mb-4">
                            <inertia-link :href="route('admin.lead.create')"  class="btn btn-primary">
                                <i class="ri-add-box-line font-size-18"></i> <span>Add New Client</span>
                            </inertia-link>
                        </b-col>
                    </b-row>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <iq-card
                                bodyClass="pro-bg-card"
                                class="bg-transparent shadow-none mr-3 lead-card-block bg-primary"
                                style="width: 100%"
                                >
                                <template v-slot:headerTitle>
                                    <h5 class="text-white">10 Days</h5>
                                </template>
                                <template v-slot:body>
                                    <draggable :list="tenDays" group="scrumboard" @change="log">
                                        <div
                                            class="shadow"
                                            v-for="(element, index) in tenDays"
                                            :key="element.full_name +'-'+ index"
                                        >
                                            <iq-card
                                                bodyClass="pro-task-bg-card "
                                                headerClass="pro-task-bg-card"
                                            >
                                                <template v-slot:headerTitle >
                                                    <h5 class="card-title text-muted">{{ element.full_name }}</h5>
                                                    <h6 class="text-muted">{{ element.created_at }}</h6>
                                                </template>
                                                <template v-slot:headerAction>
                                                    <inertia-link :href="route('admin.lead.show', element.lead_id)"  class="iq-bg-primary px-2  rounded shadow">
                                                        <i class="ri-ball-pen-line font-size-18" />
                                                    </inertia-link>
                                                </template>
                                                <template v-slot:body>
                                                    <p class="font-size-12 text-black">{{ element.full_address}}</p>
                                                    <b-progress style="height: 4px" class="mt-2 bg-white" :max="100" show-value >
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 1" class="iq-border-radius-10" variant="primary" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 2" class="iq-border-radius-10" variant="warning" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 3" class="iq-border-radius-10" variant="info" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 4" class="iq-border-radius-10" variant="success" label=" " />
                                                    </b-progress>
                                                </template>
                                            </iq-card>
                                        </div>
                                    </draggable>
                                </template>
                            </iq-card>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <iq-card
                                bodyClass="pro-bg-card"
                                class="shadow-none mr-3 lead-card-block bg-warning"
                                style="width: 100%"
                                >
                                <template v-slot:headerTitle>
                                    <h5 class="text-white">20 days</h5>
                                </template>
                                <template v-slot:body>
                                    <draggable :list="tDays" group="scrumboard" @change="log">
                                        <div
                                            class="shadow"
                                            v-for="(element, index) in tDays"
                                            :key="element.full_name +'-'+ index"
                                        >
                                            <iq-card
                                                bodyClass="pro-task-bg-card "
                                                headerClass="pro-task-bg-card"
                                            >
                                                <template v-slot:headerTitle >
                                                    <h5 class="card-title text-muted">{{ element.full_name }}</h5>
                                                    <h6 class="text-muted">{{ element.created_at }}</h6>
                                                </template>
                                                <template v-slot:headerAction>
                                                    <inertia-link :href="route('admin.lead.show', element.lead_id)"  class="iq-bg-primary px-2  rounded shadow">
                                                        <i class="ri-ball-pen-line font-size-18" />
                                                    </inertia-link>
                                                </template>
                                                <template v-slot:body>
                                                    <p class="font-size-12 text-black">{{ element.full_address}}</p>
                                                    <b-progress style="height: 4px" class="mt-2 bg-white" :max="100" show-value >
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 1" class="iq-border-radius-10" variant="primary" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 2" class="iq-border-radius-10" variant="warning" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 3" class="iq-border-radius-10" variant="info" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 4" class="iq-border-radius-10" variant="success" label=" " />
                                                    </b-progress>
                                                </template>
                                            </iq-card>
                                        </div>
                                    </draggable>
                                </template>
                            </iq-card>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <iq-card
                                bodyClass="pro-bg-card"
                                class="shadow-none mr-3 lead-card-block bg-success"
                                style="width: 100%"
                                >
                                <template v-slot:headerTitle>
                                    <h5 class="text-white">30 days (+)</h5>
                                </template>
                                <template v-slot:body>
                                    <draggable :list="allDays" group="scrumboard" @change="log">
                                        <div
                                            class="shadow"
                                            v-for="(element, index) in allDays"
                                            :key="element.full_name +'-'+ index"
                                        >
                                            <iq-card
                                                bodyClass="pro-task-bg-card "
                                                headerClass="pro-task-bg-card"
                                            >
                                                <template v-slot:headerTitle >
                                                    <h5 class="card-title text-muted">{{ element.full_name }}</h5>
                                                    <h6 class="text-muted">{{ element.created_at }}</h6>
                                                </template>
                                                <template v-slot:headerAction>
                                                    <inertia-link :href="route('admin.lead.show', element.lead_id)"  class="iq-bg-primary px-2  rounded shadow">
                                                        <i class="ri-ball-pen-line font-size-18" />
                                                    </inertia-link>
                                                </template>
                                                <template v-slot:body>
                                                    <p class="font-size-12 text-black">{{ element.full_address}}</p>
                                                    <b-progress style="height: 4px" class="mt-2 bg-white" :max="100" show-value >
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 1" class="iq-border-radius-10" variant="primary" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 2" class="iq-border-radius-10" variant="warning" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 3" class="iq-border-radius-10" variant="info" label=" " />
                                                        <b-progress-bar :value="25" v-if="element.current_step  >= 4" class="iq-border-radius-10" variant="success" label=" " />
                                                    </b-progress>
                                                </template>
                                            </iq-card>
                                        </div>
                                    </draggable>
                                </template>
                            </iq-card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-admin-layout>
</template>

<script>
import AppAdminLayout from "../../../Layouts/AppAdminLayout";
import draggable from 'vuedraggable';
import IqCard from "../../../Component/core/cards/iq-card";
export default {
    name: "Index",
    components: {
        IqCard,
        AppAdminLayout,
        draggable
    },
    props:['tenDays', 'tDays', 'allDays'],
    computed: {
    },
    data () {
        return {
            colors: [
                'bg-primary',
                'bg-warning',
                'bg-success',
            ],

            board: this.defaultBoard(),
            task: this.defaultTask(),
            boardTitles: [
                'Documentation',
                'Vehicle information',
                'Special Request'
            ]
        }
    },
    methods: {
        defaultBoard () {
            return {
                id: 0,
                title: '',
                color: '',
                list: [
                ]
            }
        },
        defaultTask () {
            return {
                id: 0,
                name: '',
                description: '',
                status: 0
            }
        },
        log () {
        },
        saveBoard (item) {
            const board = this.boards.findIndex(b => b.id === item.id)
            if (board === -1) {
                item.id = this.boards.length
                item.color = this.colors[Math.floor(Math.random() * this.colors.length)]
                this.boards.push(item)
            }
            this.board = this.defaultBoard()
            this.$bvModal.hide('board')
        },
        saveTask (item) {
            const index = this.board.list.findIndex(task => task.id === item.id)
            if (index !== -1) {
                this.board.list[index] = item
            } else {
                this.board.list.push(item)
            }
            this.$bvModal.hide('task')
            this.task = this.defaultTask()
            this.board = this.defaultBoard()
        },
        addTask (board) {
            this.board = board
            this.task = this.defaultTask()
            this.$bvModal.show('task')
        },
        editBoard (item) {
            this.board = item
        },
        editTask (item, board) {
            this.board = board
            this.task = item
        }
    }
}
</script>

<style scoped>

</style>
