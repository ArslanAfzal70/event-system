<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Create Ticket</h3>
            <p class="text-muted m-b-30 font-13">Create a new Ticket</p>
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
            <form @submit.prevent="createTicket" class="row g-3 no-outline">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input v-model="name" type="text" class="form-control" id="name">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input v-model="email" type="email" class="form-control" id="email">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input v-model="phone" type="number" class="form-control" id="phone">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="col-12 mt-4">
                    <button class="btn form-btn btn-lg text-white text-uppercase">Create</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'CreateTicketView',
    data() {
        return {
            name: "",
            email: "",
            phone: "",
            type: "",
            price: "",
            event_id: "",
            errors: ""
        }
    },

    methods: {
        createTicket: async function () {
            this.errors = "";
            try {
                const res = await axios.post('create-ticket', {
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                    type: this.silver_price,
                    price: this.gold_price,
                    event_id: this.date_end,
                }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                if (res.data.status) {
                    this.name = "";
                    this.email = "";
                    this.phone = "";
                    this.silver_price = "";
                    this.gold_price = "";
                    this.date_end = "";
                    this.$toast.success('Ticket Created Successfully');
                }
                else {
                    this.$toast.error('Something went wrong please try again.');
                }
            } catch (e) {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors;
                    console.log(this.errors);
                }
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