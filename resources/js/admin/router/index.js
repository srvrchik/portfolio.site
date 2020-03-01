import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import settings from "./routes/settings";
import Index from "../pages/Index";
import users from "./routes/users";
import portfolio from "./routes/portfolio";
import skills from "./routes/skills";
import categories from "./routes/categories";

const routes = [
    {
        path: '/admin',
        component: Index,
        name: 'dashboard'
    },
    ...settings,
    ...users,
    ...portfolio,
    ...skills,
    ...categories,
];

var router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    next();
});

router.afterEach((to, from) => {
});

export default router;
