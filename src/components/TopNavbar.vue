<template>
    <div>
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
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'TopNavbar',
    props: ['user'],
    methods: {
        logout: async function () {
            const res = await axios.post('logout', {}, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`
                }
            });
            if (res.data.status) {
                localStorage.removeItem('user');
                localStorage.removeItem('token');
                this.$toast.success('Logout Success !');
                this.$router.push({ name: 'login' });
            }
        }
    },
}
</script>
<style lang="">
    
</style>