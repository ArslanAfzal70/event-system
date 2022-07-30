import "bootstrap/dist/css/bootstrap.min.css";
import Vue from "vue";
import App from "./App.vue";
import "./axios";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import AOS from "aos";
import "aos/dist/aos.css";
/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

/* import specific icons */
import {
  faUser,
  faCalendarDays,
  faGauge,
  faChartColumn,
  faTicket,
} from "@fortawesome/free-solid-svg-icons";

/* add icons to the library */
library.add(faUser, faCalendarDays, faGauge, faChartColumn, faTicket);

/* add font awesome icon component */
Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;
AOS.init();

Vue.use(Toast);

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");

import "bootstrap/dist/js/bootstrap.js";
import router from "./router";
