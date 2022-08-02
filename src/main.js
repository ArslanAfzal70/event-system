import "bootstrap/dist/css/bootstrap.min.css";
import "datatables.net-bs5";
import "datatables.net-buttons-bs5";
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "jszip";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;
import "datatables.net-buttons/js/buttons.colVis.js";
import "datatables.net-buttons/js/buttons.html5.js";
import "datatables.net-buttons/js/buttons.print.js";

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
  faPlus,
  faTrash,
  faPencilAlt,
} from "@fortawesome/free-solid-svg-icons";

/* add icons to the library */
library.add(
  faUser,
  faCalendarDays,
  faGauge,
  faChartColumn,
  faTicket,
  faPlus,
  faTrash,
  faPencilAlt
);

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
