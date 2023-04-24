import { createRouter, createWebHistory } from "vue-router";
// @ts-ignore
import Home from "../Home.vue";
// @ts-ignore
import Welcome from "../views/Welcome.vue";
// @ts-ignore
import Favourites from "../views/Favourites.vue";

const generalRoutes: any = [
  {
    path: "/home",
    name: "home",
    component: Home,
    meta: {
      title: "Home",
    },
  },
];

const guestRoutes: any = [
  {
    path: "/",
    name: "welcome",
    component: Welcome,
    meta: {
      title: "Welcome",
    },
  },
];

const userRoutes: any = [
  {
    path: "/favourites",
    name: "my-favourites",
    component: Favourites,
    meta: {
      title: "My Favourites",
    },
  },
];

const allRoutes = []
  .concat(generalRoutes)
  .concat(guestRoutes)
  .concat(userRoutes);

export const router = createRouter({
  history: createWebHistory(),
  routes: allRoutes,
});
