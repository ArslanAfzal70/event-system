<template>
    <div class="bg-white pb-5 inner-wrapper">
        <div class="row">

            <div class="col-md-4">
                <div class="card-box one" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="1000">
                    <div class="name">
                        <font-awesome-icon icon="fa-solid fa-calendar-days" class="text-muted" />
                        <span class="ps-1 text-muted">
                            Today Bookings
                        </span>
                    </div>
                    <div class="number">
                        {{ todayBookings }}
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card-box two" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="1000">
                    <div class="name">
                        <font-awesome-icon icon="fa-solid fa-calendar-days" class="text-muted" />
                        <span class="ps-1 text-muted">
                            Total Events
                        </span>
                    </div>
                    <div class="number">
                        {{ eventCount }}
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card-box three" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="1000">

                    <div class="name">
                        <font-awesome-icon icon="fa-solid fa-ticket" class="text-muted" /> <span
                            class="ps-1 text-muted">Total Bookings</span>
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
            ticketCount: '',
            todayBookings: '',
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
            this.todayBookings = res.data.todayBookings;

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

    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 7px;
    padding: 25px 20px;
    text-align: center;

    &.one {
        border-top: 6px #28A745 solid;
    }

    &.two {
        border-top: 6px #17A2B8 solid;
    }

    &.three {

        border-top: 6px#DC3545 solid;

    }

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