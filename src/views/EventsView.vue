<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Events</h3>
            <p class="text-muted m-b-30 font-13">Here you can manage events</p>
        </div>
        <div class="col-12 pb-3 d-flex justify-content-end no-outline">
            <router-link :to="{ name: 'event-create' }" class="btn btn-success btn-lg">
                <font-awesome-icon icon="fa-solid fa-plus" />
                <span class="ps-1 ">
                    Add new Event
                </span>
            </router-link>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered mt-5 no-outline">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date start</th>
                        <th>Date End</th>
                        <th>Silver Price</th>
                        <th>Gold Price</th>
                        <th>Platinum Price</th>
                        <th>Capacity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="e in events" :key="e.id">
                        <td>{{ e.id }}</td>
                        <td>{{ e.title }}</td>
                        <td>{{ e.description }}</td>
                        <td>{{ e.date_start }}</td>
                        <td>{{ e.date_end }}</td>
                        <td>{{ e.silver_price }}</td>
                        <td>{{ e.gold_price }}</td>
                        <td>{{ e.platinum_price }}</td>
                        <td>{{ e.capacity }}</td>
                        <td>
                            <router-link class="btn btn-info btn-sm text-white action-btn"
                                :to="{ name: 'event-edit', params: { id: e.id } }">
                                <font-awesome-icon icon="fa-solid fa-pencil-alt" />
                            </router-link>
                            <button @click="deleteEvent(e.id)" class="btn btn-sm btn-danger action-btn ms-1">
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
    name: 'EventsView',
    data() {
        return {
            events: {}
        }
    },
    mounted() {
        this.getEvents();
    },
    methods: {
        getEvents: function () {

            axios.get('get-event-list', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            }).then((res) => {
                this.events = res.data;
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

            }).catch((error) => {
                console.log(error);
            });

        },
        deleteEvent: function (id) {
            if (confirm('Are you sure you want to delete?')) {
                console.log(id);
            }
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