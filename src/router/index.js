import Vue from "vue";
import VueRouter from "vue-router";
import LoginView from "../views/LoginView.vue";
import DashboardView from "../views/DashboardView.vue";
import EventsView from "../views/EventsView.vue";
import TicketsView from "../views/TicketsView.vue";
import ReportView from "../views/ReportView.vue";
import DefaultView from "../views/DefaultView.vue";
import PageNotFoundView from "../views/PageNotFoundView.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "login",
    component: LoginView,
    meta: {
      title: "Login",
    },
    beforeEnter: (to, from, next) => {
      if (localStorage.getItem("token")) {
        next({ name: "dashboard" });
      } else {
        next();
      }
    },
  },
  {
    path: "/",
    name: "default",
    beforeEnter: (to, from, next) => {
      if (!localStorage.getItem("token")) {
        next({ name: "login" });
      } else {
        next();
      }
    },
    redirect: "/dashboard",
    component: DefaultView,
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: DashboardView,
        meta: { requiresAuth: true, title: "Dashboard" },
      },
      {
        path: "events",
        name: "events",
        component: EventsView,
        meta: { requiresAuth: true, title: "Events" },
      },
      {
        path: "event/edit/:id",
        name: "event-edit",
        component: EventsView,
        meta: { requiresAuth: true, title: "Edit Event" },
      },
      {
        path: "tickets",
        name: "tickets",
        component: TicketsView,
        meta: { requiresAuth: true, title: "Ticktes" },
      },
      {
        path: "report",
        name: "report",
        component: ReportView,
        meta: { requiresAuth: true, title: "Report" },
      },
    ],
  },
  {
    path: "*",
    name: "PageNotFound",
    component: PageNotFoundView,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
  linkActiveClass: "active", // active class for non-exact links.
  linkExactActiveClass: "active", // active class for *exact* links.
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    if (localStorage.getItem("token")) {
      next();
    } else {
      next({ name: "login" });
    }
  }
  document.title = to.meta.title
    ? to.meta.title + " - Event Manager"
    : "Event Manager";
  next();
});

export default router;
