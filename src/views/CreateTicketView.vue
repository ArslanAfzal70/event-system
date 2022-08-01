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
                    <input v-model="phone" type="text" class="form-control" id="phone">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Events</label>
                    <select @change="updateTicketPrice($event)" v-model="event_id" class="form-select"
                        aria-label="Default select example">
                        <option selected disabled value=""> -- Select Event -- </option>
                        <option v-for="(e, index) in events" :key="index" :value="e.id" :data-index="index">{{ e.title
                        }}
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
    name: 'CreateTicketView',
    data() {
        return {
            name: "",
            email: "",
            phone: "",
            type: "",
            price: "",
            event_id: "",
            errors: "",
            events: {},
            silver_price: 0,
            gold_price: 0,
            platinum_price: 0,

        }
    },
    mounted() {
        this.getEvents();
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

        //create a new ticket
        createTicket: async function () {
            this.errors = "";
            try {
                const res = await axios.post('create-ticket', {
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                    type: this.type,
                    price: this.price,
                    event_id: this.event_id,
                }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                if (res.data.status) {
                    this.name = "";
                    this.email = "";
                    this.phone = "";
                    this.type = "";
                    this.price = "";
                    this.$refs.silver_radio.checked = false;
                    this.$refs.gold_radio.checked = false;
                    this.$refs.platinum_radio.checked = false;
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
                    this.type = type;
                    this.price = this.silver_price;
                    break;
                case "gold":
                    this.type = type;
                    this.price = this.gold_price;
                    break;
                case "platinum":
                    this.type = type;
                    this.price = this.platinum_price;
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