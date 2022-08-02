<template>
    <div class="offcanvas offcanvas-start sidebar-nav bg-purple" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark mt-4">
                <ul class="navbar-nav">
                    <li>
                        <router-link to="/dashboard" class="nav-link px-3">
                            <font-awesome-icon icon="fa-solid fa-gauge" />
                            <span class="ps-2">Dashboard</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/events" class="nav-link px-3">
                            <font-awesome-icon icon="fa-solid fa-calendar-days" />
                            <span class="ps-2">Events</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/tickets" class="nav-link px-3">
                            <font-awesome-icon icon="fa-solid fa-ticket" />
                            <span class="ps-2">Tickets</span>
                        </router-link>

                    </li>
                    <li>
                        <router-link to="/report" class="nav-link px-3">
                            <font-awesome-icon icon="fa-solid fa-chart-column" />
                            <span class="ps-2">Report</span>
                        </router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    name: 'SidebarMenu'

}
</script>
<style lang="">
    
</style>