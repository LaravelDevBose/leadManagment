<template>
    <app-layout class="bg-gray-50">
        <div class="card ">
            <div class="card-body text-center">
                <div class="mt-8 text-2xl">
                    Meeting Details
                </div>

                <div class="mt-6 text-gray-500" v-if="setting && setting.data">
                   {{ setting.data.zoom_url? setting.data.zoom_url: ''}}
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
export default {
    name: "ThankYouPage",
    props:['setting'],
    components: {JetApplicationLogo,AppLayout}
}
</script>

<style scoped>

</style>
