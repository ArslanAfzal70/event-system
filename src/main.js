import "bootstrap/dist/css/bootstrap.min.css";
import Vue from "vue";
import App from "./App.vue";
import "./axios";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import AOS from "aos";
import "aos/dist/aos.css";

Vue.config.productionTip = false;
AOS.init();

Vue.use(Toast);

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");

import "bootstrap/dist/js/bootstrap.js";
import router from "./router";
