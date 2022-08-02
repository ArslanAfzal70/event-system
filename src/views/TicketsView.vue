<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Tickets</h3>
            <p class="text-muted m-b-30 font-13">Here you can manage tickets</p>
        </div>
        <div class="col-12 pb-3 d-flex justify-content-end no-outline">
            <router-link :to="{ name: 'ticket-create' }" class="btn btn-success btn-lg">
                <font-awesome-icon icon="fa-solid fa-plus" />
                <span class="ps-1 ">
                    Add new Ticket
                </span>
            </router-link>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered mt-5 no-outline">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Event</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(t, index) in tickets" :key="t.id" :id="'row' + index">
                        <td>{{ t.id }}</td>
                        <td>{{ t.name }}</td>
                        <td>{{ t.email }}</td>
                        <td>{{ t.phone }}</td>
                        <td>{{ t.type }}</td>
                        <td>{{ t.price }}</td>
                        <td>{{ t.event.title }}</td>
                        <td>
                            <router-link class="btn btn-info btn-sm text-white action-btn"
                                :to="{ name: 'ticket-edit', params: { id: t.id } }">
                                <font-awesome-icon icon="fa-solid fa-pencil-alt" />
                            </router-link>
                            <button @click="deleteTicket(t.id, index)" class="btn btn-sm btn-danger action-btn ms-1">
                                <font-awesome-icon icon="fa-solid fa-trash" />
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>
<script>
import axios from 'axios';
import $ from 'jquery';
export default {
    name: 'TicketsView',
    data() {
        return {
            tickets: {}
        }
    },
    mounted() {
        this.getTickets();

    },
    methods: {
        getTickets: function () {

            axios.get('get-ticket-list', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((res) => {
                this.tickets = res.data;
                this.initDatatable();

            }).catch((error) => {
                console.log(error);
            });

        },
        deleteTicket: async function (id, index) {

            if (confirm('Are you sure you want to delete?')) {
                try {
                    const res = await axios.post('delete-ticket/' + id, {}, {
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('token')}`
                        }
                    });
                    if (res.data.status) {
                        this.tickets.splice(index, 1);
                        $("#myTable").DataTable().rows($("#row" + index)).remove()
                        this.initDatatable();
                        this.$toast.success('Ticket Deleted Successfully');
                    }
                    else {
                        this.$toast.error('Something went wrong please try again.');
                    }
                } catch (e) {
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors;
                    }
                }
            }
        },
        initDatatable: function () {
            setTimeout(() => {
                $('#myTable').DataTable({
                    dom: 'Bfrtip',
                    responsive: true,
                    destroy: true,
                    buttons: [
                        'copy',
                        'pdf',
                        'print',
                        'csv'
                    ],
                });
            }, 1000)
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