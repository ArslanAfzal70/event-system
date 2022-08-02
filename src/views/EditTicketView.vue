<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Edit Ticket</h3>
            <p class="text-muted m-b-30 font-13">Here you can edit ticket</p>
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
            <form @submit.prevent="updateTicket" class="row g-3 no-outline">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input v-model="ticketData.name" type="text" class="form-control" id="name">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input v-model="ticketData.email" type="email" class="form-control" id="email">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input v-model="ticketData.phone" type="text" class="form-control" id="phone">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Events</label>
                    <select @change="updateTicketPrice($event)" class="form-select" aria-label="Default select example"
                        v-model="ticketData.event_id">
                        <option v-for="(e, index) in events" :key="index" :value="e.id" :data-index="index">
                            {{ e.title }}
                        </option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input @change="updateTypePrice($event)" class="form-check-input" name="eventPrice" type="radio"
                            id="silver_price" :value="silver_price" data-type="silver" ref="silver_radio">
                        <label class="form-check-label" for="silver_price">
                            Silver (${{ silver_price }})
                        </label>
                    </div>
                    <div class="form-check">
                        <input @change="updateTypePrice($event)" class="form-check-input" type="radio" name="eventPrice"
                            id="gold_price" :value="gold_price" data-type="gold" ref="gold_radio">
                        <label class="form-check-label" for="gold_price">
                            Gold (${{ gold_price }})
                        </label>
                    </div>
                    <div class="form-check">
                        <input @change="updateTypePrice($event)" class="form-check-input" type="radio" name="eventPrice"
                            id="platinum_price" :value="platinum_price" data-type="platinum" ref="platinum_radio">
                        <label class="form-check-label" for="platinum_price">
                            Platinum (${{ platinum_price }})
                        </label>
                    </div>
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
    name: 'EditTicketView',
    data() {
        return {
            // name: "",
            // email: "",
            // phone: "",
            // type: "",
            // price: "",
            // event_id: "",
            errors: "",
            events: {},
            silver_price: 0,
            gold_price: 0,
            platinum_price: 0,
            ticketData: {},



        }
    },
    mounted() {
        this.getEvents();
        this.getTicketData();
    },

    methods: {

        //get events list to show in select
        getEvents: function () {

            axios.get('get-event-list', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((res) => {
                this.events = res.data;

            }).catch((error) => {
                console.log(error);
            });

        },

        // Get Ticket Data
        getTicketData: async function () {
            const res = await axios.get('edit-ticket/' + this.$route.params.id, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (res.data.status) {
                this.ticketData = res.data.ticket;
                this.silver_price = this.ticketData.event.silver_price;
                this.gold_price = this.ticketData.event.gold_price;
                this.platinum_price = this.ticketData.event.platinum_price;
                this.ticketData.type == 'silver' ? this.$refs.silver_radio.checked = true : this.$refs.silver_radio.checked = false;
                this.ticketData.type == 'gold' ? this.$refs.gold_radio.checked = true : this.$refs.gold_radio.checked = false;
                this.ticketData.type == 'platinum' ? this.$refs.platinum_radio.checked = true : this.$refs.platinum_radio.checked = false;
            }
            else {
                this.$router.push('/pageNotFound');
            }
        },

        //update ticket
        updateTicket: async function () {
            this.errors = "";
            try {
                const res = await axios.post('update-ticket/' + this.$route.params.id, this.ticketData, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                if (res.data.status) {
                    this.$toast.success('Ticket updated Successfully');
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
        },

        //update the ticket price when user change the select option
        updateTicketPrice: function (event) {
            const index = event.target.options[event.target.options.selectedIndex].getAttribute('data-index');
            this.silver_price = this.events[index].silver_price;
            this.gold_price = this.events[index].gold_price;
            this.platinum_price = this.events[index].platinum_price;
            this.$refs.silver_radio.checked = false;
            this.$refs.gold_radio.checked = false;
            this.$refs.platinum_radio.checked = false;
        },

        // update the data of selected type and price
        updateTypePrice: function (event) {
            const type = event.target.getAttribute('data-type');
            switch (type) {
                case "silver":
                    this.ticketData.type = type;
                    this.ticketData.price = this.silver_price;
                    break;
                case "gold":
                    this.ticketData.type = type;
                    this.ticketData.price = this.gold_price;
                    break;
                case "platinum":
                    this.ticketData.type = type;
                    this.ticketData.price = this.platinum_price;
                    break;
                default:
                    break;
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