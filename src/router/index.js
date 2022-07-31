import Vue from "vue";
import VueRouter from "vue-router";
import LoginView from "../views/LoginView.vue";
import DashboardView from "../views/DashboardView.vue";
import DefaultView from "../views/DefaultView.vue";
import PageNotFoundView from "../views/PageNotFoundView.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/login",
    name: "login",
    component: LoginView,
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
        meta: { requiresAuth: true },
      },
    ],
  },
  // {
  //   path: "/dashboard",
  //   name: "dashboard",
  //   component: DashboardView,
  //   meta: { requiresAuth: true },
  // },
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
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    if (localStorage.getItem("token")) {
      next();
    } else {
      next({ name: "login" });
    }
  }
  next();
});

export default router;
