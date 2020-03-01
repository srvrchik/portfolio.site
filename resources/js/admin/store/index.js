import Vue from 'vue'
import Vuex from 'vuex'
import users from "./modules/users";
import snackbar from "./modules/snackbar";
import user from "./modules/user";
import portfolio from "./modules/portfolio";
import skills from "./modules/skills";
import categories from "./modules/categories";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        users: users,
        user: user,
        snackbar: snackbar,
        portfolio: portfolio,
        skills: skills,
        categories: categories
    }
})
