<template>
    <div class="d-flex justify-content-center align-items-center flex-column h-vh main-container">
        <h2 class="display-1">404 Page not Found</h2>
        <h3 class="text-muted display-5">Please go to <router-link to="/dashboard">Homepage</router-link>
        </h3>
    </div>
</template>
<script>
export default {
    name: 'PageNotFoundView',
}
</script>
<style scoped>
.main-container {
    height: 100vh;
}

a {
    text-decoration: none;
}
</style>