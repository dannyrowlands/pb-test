<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Welcome to Pamper Book Test Appointment System
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white">
                            <div>
                                <a href="#"><span>Book Appointment</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            <li v-for="item in appointments">
                                <div class="p-6 bg-white">
                                    <div class="">{{ item.name }}</div>
                                    <div class="">{{ item.body }}</div>
                                    <div>
                                        <a href="#"><span>Edit Appointment</span></a>
                                    </div>
                                    <div>
                                        <a href="#"><span>Cancel Appointment</span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    data() {
        return {
            appointments: {}
        }
    },
    mounted() {
        this.appointments = {
            1: {
                name: 'Appointment 1',
                body: 'Test body',
            },
            2: {
                name: 'Appointment 2',
                body: 'Test Body 2',
            },
            3: {
                name: 'Appointment 3',
                body: 'Test Body 3',
            }
        }
    }

}
</script>
