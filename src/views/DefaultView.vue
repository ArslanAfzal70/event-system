<template>
    <div>
        <!-- --------------- TOPNAVBAR --------------- -->
        <TopNavbar :user=user />
        <!-- -------------- Sidebar Menu--------------- -->
        <SidebarMenu />
        <!-- --------------- MAINPAGE ---------------- -->
        <div class="main">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import TopNavbar from '@/components/TopNavbar.vue';
import SidebarMenu from '@/components/SidebarMenu.vue';

export default {
    name: 'DefaultView',
    components: {
        TopNavbar,
        SidebarMenu
    },
    data() {
        return {
            user: {}
        }
    },
    methods: {

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

.no-outline {

    input,
    button {
        outline: none !important;
        border: none !important;
    }

    button:focus,
    .btn:focus {
        box-shadow: none;
    }

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

.main {
    margin-top: 56px;
    padding: 15px;
    background-color: #edf1f5;
    min-height: calc(100vh - 56px) !important;
}

.inner-wrapper {
    min-height: calc(100vh - 56px);
}

.title-box {
    padding: 25px 25px 0;
    margin-bottom: 15px;
}

@media (min-width:992px) {
    body {
        overflow: auto !important;
    }

    .main {
        margin-left: $sidebarWdith;
    }

    .sidebar-nav {
        transform: none !important;
        visibility: visible !important;
        top: 56px !important;
        // height: calc(100% - 56px) !important;
    }
}
</style>