<template>
    <app-layout>
        <div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center">
                <div>
                    <jet-application-logo class="block h-12 w-auto" />
                </div>

                <div class="mt-8 text-2xl">
                    Thank You  For Your Time. Our Team will Connect With You Very soon.
                </div>

                <div class="mt-6 text-gray-500">
                   this page and content is for testing it wll change as per client given text.
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
    components: {JetApplicationLogo,AppLayout}
}
</script>

<style scoped>

</style>
