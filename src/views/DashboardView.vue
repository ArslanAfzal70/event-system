<template>
    <div class="bg-white pb-5 inner-wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="card-box">
                    <div class="name">
                        <font-awesome-icon icon="fa-solid fa-calendar-days" class="text-muted" />
                        <span class="ps-1 text-muted">
                            Events
                        </span>
                    </div>
                    <div class="number">
                        {{ eventCount }}
                    </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card-box">

                    <div class="name">
                        <font-awesome-icon icon="fa-solid fa-ticket" class="text-muted" /> <span
                            class="ps-1 text-muted">Tickets</span>
                    </div>
                    <div class="number">
                        {{ ticketCount }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            eventCount: '',
            ticketCount: ''
        }
    },
    mounted() {
        this.getDataCount();
    },
    methods: {

        //get events list to show in select
        getDataCount: async function () {

            const res = await axios.get('get-data-count', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            this.eventCount = res.data.eventCount;
            this.ticketCount = res.data.ticketCount;

        },
    },
}
</script>
<style lang="scss" scoped>
$dark-purpule : #32213A;
$yellow : #F4BF01;

.inner-wrapper {
    padding: 25px 25px 0;
}

.card-box {
    border-top: 6px $yellow solid;
    box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
    border-radius: 7px;
    padding: 25px 20px;
    text-align: center;

    .name {
        font-size: 20px;
    }

    .number {
        font-size: 40px;
        color: $dark-purpule;
        font-weight: bold;
    }
}
</style>