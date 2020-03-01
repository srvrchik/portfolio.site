import Vue from 'vue'
import NProgress from "vue-nprogress"

Vue.use(NProgress);

const nProgress = new NProgress({
    parent: '.nprogress-container'
});

export default nProgress;
