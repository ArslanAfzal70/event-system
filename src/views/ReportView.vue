<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Report</h3>
            <p class="text-muted m-b-30 font-13">Here you can generate Reports</p>
        </div>

        <!-- ----------------- FORM ------------------ -->
        <div class="col-12 form-main py-3">
            <div class="row g-3 no-outline">
                <div class="col-md-6">
                    <label for="events" class="form-label">Events</label>
                    <select @change="eventChange($event)" v-model="event_id" class="form-select"
                        aria-label="Default select example" id="tickets">
                        <option value="all"> All Events </option>
                        <option v-for="(e, index) in events" :key="index" :value="e.id">{{ e.title
                        }}
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tickets" class="form-label">Tickets</label>
                    <select @change="ticketChange($event)" v-model="ticket_id" class="form-select"
                        aria-label="Default select example" id="events">
                        <option value="all"> All Tickets </option>
                        <option value="silver">Silver</option>
                        <option value="gold">Gold</option>
                        <option value="platinum">Platinum</option>
                    </select>

                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end no-outline">
            <button class="btn form-btn btn-lg text-white" @click="generatePdf">
                <font-awesome-icon icon="fa-solid fa-chart-column" />
                <span class="ps-1 ">
                    Generate Report
                </span>
            </button>
        </div>

        <div class="table-responsive" ref="content">
            <table id="ticketTable" class="table table-bordered mt-3 no-outline">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Event</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="t in tickets" :key="t.id">
                        <td>{{ t.id }}</td>
                        <td>{{ t.name }}</td>
                        <td>{{ t.email }}</td>
                        <td>{{ t.phone }}</td>
                        <td>{{ t.type }}</td>
                        <td>{{ t.price }}</td>
                        <td>{{ t.event.title }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>
<script>
import axios from 'axios';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';

export default {
    name: 'ReportView',
    data() {
        return {
            ticket_id: 'all',
            event_id: 'all',
            events: {},
            tickets: {}
        }
    },
    mounted() {
        this.getAllTickets();
        this.getEvents();

    },
    methods: {

        //get all events list
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

        //get all tickets list
        getAllTickets: function () {

            axios.get('get-ticket-list', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((res) => {
                this.tickets = res.data;


            }).catch((error) => {
                console.log(error);
            });

        },

        //when event select changed
        eventChange: function () {

            if (this.event_id == 'all' && this.ticket_id == 'all') {
                this.getAllTickets();
            }
            else {
                axios.get(`generate-report/${this.event_id}/${this.ticket_id}`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                }).then((res) => {
                    this.tickets = res.data;

                }).catch((error) => {
                    console.log(error);
                });

            }
        },

        //when ticket select changed
        ticketChange: function () {

            if (this.event_id == 'all' && this.ticket_id == 'all') {
                this.getAllTickets();
            }
            else {
                axios.get(`generate-report/${this.event_id}/${this.ticket_id}`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                }).then((res) => {
                    this.tickets = res.data;

                }).catch((error) => {
                    console.log(error);
                });

            }
        },
        generatePdf: function () {
            const doc = new jsPDF()
            autoTable(doc, { html: '#ticketTable' })
            doc.save('Report.pdf')
        }

    },

}
</script>
<style lang="scss" scoped>
.action-btn {
    width: 30px;
    height: 30px;
}
</style>