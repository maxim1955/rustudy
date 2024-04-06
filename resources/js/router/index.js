import {createRouter, createWebHistory} from "vue-router";
import HomePage from "../views/Homepage.vue";
import Test from "../views/test.vue";


const routes = [
    {
        path: "/",
        name: "home",
        component: HomePage,

    },
    {
        path: "/test",
        name: "test",
        component: Test,
    }
];

const router = createRouter({
    history: createWebHistory(),
    // history: createWebHistory(),
    routes,
});

export default router;
