<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Edit Event</h3>
            <p class="text-muted m-b-30 font-13">Here you can Edit an event</p>
        </div>
        <div class="alert alert-danger" v-if="errors">
            <ul>
                <li v-for="(errorArray, idx) in errors" :key="idx">
                    <span class="d-block" v-for="(allErrors, idx) in errorArray" :key="idx">
                        {{ allErrors }}
                    </span>
                </li>
            </ul>
        </div>
        <!-- ----------------- FORM ------------------ -->
        <div class="col-12 form-main">
            <form @submit.prevent="updateEvent" class="row g-3 no-outline">
                <div class="col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input v-model="eventData.title" type="text" class="form-control" id="title">
                </div>
                <div class="col-md-6">
                    <label for="capacity" class="form-label">Capacity</label>
                    <input v-model="eventData.capacity" type="number" class="form-control" id="capacity">
                </div>
                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea v-model="eventData.description" class="form-control" id="description"></textarea>
                </div>
                <div class="col-6">
                    <label for="date-start" class="form-label">Date Start</label>
                    <input v-model="eventData.date_start" type="datetime-local" class="form-control" id="date-start">
                </div>
                <div class="col-6">
                    <label for="date-end" class="form-label">Date End</label>
                    <input v-model="eventData.date_end" type="datetime-local" class="form-control" id="date-end">
                </div>
                <div class="col-md-4">
                    <label for="silver_price" class="form-label">Silver Price</label>
                    <input v-model="eventData.silver_price" type="number" class="form-control" id="silver_price">
                </div>
                <div class="col-md-4">
                    <label for="gold_price" class="form-label">Gold Price</label>
                    <input v-model="eventData.gold_price" type="number" class="form-control" id="gold_price">
                </div>
                <div class="col-md-4">
                    <label for="platinum_price" class="form-label">Platinum Price</label>
                    <input v-model="eventData.platinum_price" type="number" class="form-control" id="platinum_price">
                </div>

                <div class="col-12 mt-4">
                    <button class="btn form-btn btn-lg text-white text-uppercase">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'CreateEventView',
    data() {
        return {
            errors: "",
            eventData: {}
        }
    },

    mounted() {
        this.getEventData();
    },

    methods: {
        //Update Event
        updateEvent: async function () {
            this.errors = "";
            try {
                const res = await axios.post('update-event/' + this.$route.params.id, this.eventData, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                if (res.data.status) {
                    this.$toast.success('Event updated Successfully');
                }
                else {
                    this.$toast.error('Something went wrong please try again.');
                }
            } catch (e) {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                }
            }
        },

        // Get Event Data
        getEventData: async function () {
            const res = await axios.get('edit-event/' + this.$route.params.id, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (res.data.status) {
                this.eventData = res.data.event;
            }
            else {
                this.$router.push('/pageNotFound');
            }
        }
    },

}
</script>
<style lang="scss" scoped>
.form-main {
    padding: 25px 25px 0;
}
</style>