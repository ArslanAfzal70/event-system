import "bootstrap/dist/css/bootstrap.min.css";
import Vue from "vue";
import App from "./App.vue";
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
import AOS from "aos";
import "aos/dist/aos.css";

Vue.config.productionTip = false;
AOS.init();

Vue.use(Toaster);

new Vue({
  render: (h) => h(App),
}).$mount("#app");

import "bootstrap/dist/js/bootstrap.js";
