<template>
    <div>
        <!-- ---------------- NAVBAR ----------------- -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-purple">
            <div class="container-fluid">
                <!-- ----------- OFFCANVAS TRIGGER ----------- -->
                <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <router-link to="/dashboard" class="navbar-brand fw-bold me-auto">
                    <font-awesome-icon icon="fa-solid fa-calendar-days" />
                    <span class="ms-2">Event Manager</span>
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <font-awesome-icon icon="fa-solid fa-user" />
                                <span class="ms-2">{{ user.name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><button class="dropdown-item" @click="logout">Logout</button></li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <!-- -------------- OFFCAVANAS --------------- -->

        <div class="offcanvas offcanvas-start sidebar-nav bg-purple" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-body p-0">
                <nav class="navbar-dark mt-4">
                    <ul class="navbar-nav">
                        <li>
                            <a href="#" class="nav-link px-3 active">
                                <font-awesome-icon icon="fa-solid fa-gauge" />
                                <span class="ps-2">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-3">
                                <font-awesome-icon icon="fa-solid fa-calendar-days" />
                                <span class="ps-2">Event</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-3 ">
                                <font-awesome-icon icon="fa-solid fa-ticket" />
                                <span class="ps-2">Tickets</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-3 ">
                                <font-awesome-icon icon="fa-solid fa-chart-column" />
                                <span class="ps-2">Report</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'DashbaordView',
    data() {
        return {
            user: {}
        }
    },
    methods: {
        logout: async function () {
            let token = this.user.token;
            axios.defaults.headers.common["Authorization"] = "Bearer " + token;
            const res = await axios.post('logout');
            if (res.data.status) {
                localStorage.removeItem('user');
                this.$toast.success('Logout Success !');
                this.$router.push('/');
            }
        }
    },
    mounted() {
        this.user = JSON.parse(localStorage.getItem('user'));
    },
}
</script>
<style lang="scss">
$dark-purpule : #32213A;
$yellow : #F4BF01;
$sidebarWdith : 300px;

input,
button {
    outline: none !important;
    border: none !important;
}

button:focus {
    box-shadow: none;
}

.bg-purple {
    background-color: $dark-purpule;
}

.sidebar-nav {
    width: $sidebarWdith  !important;

    ul {
        li {
            padding-bottom: 10px;
        }
    }
}

.navbar-toggler:focus {
    box-shadow: none;
}

@media (min-width:992px) {
    body {
        overflow: auto !important;
    }

    .sidebar-nav {
        transform: none !important;
        visibility: visible !important;
        top: 56px !important;
        // height: calc(100% - 56px) !important;
    }
}
</style>