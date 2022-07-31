<template>
    <div class="bg-white pb-5 inner-wrapper p-3">
        <div class="title-box">
            <h3 class=" m-b-0 display-4">Events</h3>
            <p class="text-muted m-b-30 font-13">Here you can manage events</p>
        </div>
        <div class="col-12 pb-3 d-flex justify-content-end no-outline">
            <button class="btn btn-success btn-lg">
                <font-awesome-icon icon="fa-solid fa-plus" />
                <span class="ps-1 ">
                    Add new Event
                </span>
            </button>
        </div>
        <table id="myTable" class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>
</template>
<script>
import $ from 'jquery';
export default {
    name: 'EventsView',
    mounted() {
        this.getEvents();
        // $('#example').DataTable({
        //     data: data,
        //     columns: [
        //         { data: 'name' },
        //         { data: 'position' },
        //         { data: 'salary' },
        //         { data: 'office' }
        //     ]
        // });

    },
    methods: {
        getEvents: function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'colvis',
                    'pdf',
                    'print',
                    'csv'
                ]
            });

        }
    },

}
</script>
<style>
</style>