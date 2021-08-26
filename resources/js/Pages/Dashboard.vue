<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pamper Book Test Appointment System
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="p-6 bg-white">
                            <div class="pb-5">
                                <a href="#" v-if="!config.showBookingForm" @click="toggleBookingForm()"><span>Book Appointment</span></a>
                                <a href="#" v-if="config.showBookingForm" @click="toggleBookingForm()"><span>Hide Booking Form</span></a>
                            </div>
                            <div v-if="config.showBookingForm">

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="service" class="block text-sm font-medium text-gray-700 font-bold">Service to be booked</label>
                                    <select class="form-control" v-model="service" name="service">

                                        <option v-for="service in services" v-bind:value="service.id" :key="service.id">
                                            {{ service.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">

                                    <label for="date" class="block text-sm font-medium text-gray-700 font-bold">Appointment Date</label>

                                    <input autofocus v-model="date" placeholder="eg 2021-10-10" name="date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">

                                    <label for="starttime" class="block text-sm font-medium text-gray-700 font-bold">Start of appointment to be booked</label>

                                    <input autofocus v-model="starttime" name="starttime" placeholder="e.g 10:00" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">

                                    <label for="endtime" class="block text-sm font-medium text-gray-700 font-bold">End of appointment to be booked</label>

                                    <input autofocus v-model="endtime" name="endtime" placeholder="e.g 10:30" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2" v-if="!config.editMode">
                                    <button @click="createAppointment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">Create Apppointment</button>
                                </div>
                                <div class="col-span-6 sm:col-span-6 lg:col-span-2" v-if="config.editMode">
                                    <button @click="saveEditedAppointment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-sm">Alter Apppointment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            <li v-for="appointment in appointments">
                                <div class="p-6 bg-white">
                                    <div class="">{{ appointment.service }}</div>
                                    <div class="">{{ appointment.date }}</div>
                                    <div class="">{{ appointment.start }}</div>
                                    <div class="">{{ appointment.end }}</div>
                                    <div>
                                        <a @click="editAppointment(appointment)" href="#"><span>Edit Appointment</span></a>
                                    </div>
                                    <div>
                                        <a @click="delAppointment(appointment)" href="#"><span>Cancel Appointment</span></a>
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
            appointments: {},
            services: {},
            service: null,
            starttime: null,
            endtime: null,
            date: null,
            user: null,
            currentAppointment: null,
            config:
            {
                showBookingForm: false,
                editMode: false,
            }
        }
    },
    methods: {
        error(e)
        {
         console.log(e)
        },
        toggleBookingForm()
        {
            this.config.showBookingForm = !this.config.showBookingForm
            this.config.editMode = false
            this.date = null
            this.time = null
            this.endtime = null
            this.service = null
            this.currentAppointment = null
        },
        getServices()
        {
            axios.get('/api/v1/services', {}).
            then((response) => {
                if (response.data) {
                    this.services = response.data
                }
            }).
            catch((error) => {
                this.error()
            });
        },
        getAppointments()
        {
            axios.get('/api/v1/appointments?user=' + this.user, {}).
            then((response) => {
                if (response.data) {
                    this.appointments = response.data
                }
            }).
            catch((error) => {
                this.error()
            });
        },
        createAppointment()
        {
            axios.post('/api/v1/appointments', {
                service: this.service,
                starttime: this.starttime,
                endtime: this.endtime,
                date: this.date,
                user: this.user,
            }).
            then((response) => {
                if (response.data) {
                    this.getAppointments()
                }
            }).
            catch((error) => {
                this.error()
            });
        },
        editAppointment(appointment)
        {
            console.log(appointment)
            this.date = appointment.date
            this.service = appointment.service_id
            this.endtime = appointment.end
            this.starttime = appointment.start
            this.config.editMode = true
            this.config.showBookingForm = true
            this.currentAppointment = appointment.appointment
        },
        saveEditedAppointment(appointment)
        {
            axios.put('/api/v1/appointments/' + this.currentAppointment, {
                service: this.service,
                starttime: this.starttime,
                endtime: this.endtime,
                date: this.date,
                user: this.user,
            }).
            then((response) => {
                if (response.data) {
                    this.getAppointments()
                    this.config.showBookingForm = false
                    this.currentAppointment = null
                    this.date = null
                    this.service = null
                    this.endtime = null
                    this.starttime = null
                }
            }).
            catch((error) => {
                this.error()
            });
        },
        delAppointment(appointment)
        {
            if (confirm('Do you wish to delete this record?')) {
                axios.delete('/api/v1/appointments/' + appointment.appointment, {
                    service: this.service,
                    starttime: this.starttime,
                    endtime: this.endtime,
                    date: this.date,
                    user: this.user,
                }).then((response) => {
                    if (response.data) {
                        this.getAppointments()
                    }
                }).catch((error) => {
                    this.error()
                });
            }
        }
    },
    created() {
        this.user = user
        this.getAppointments()
        this.getServices()
    }

}
</script>
