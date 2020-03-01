export default {
    namespaced: true,
    state: {
        snackbar: false,
        snackbarText: '',
        snackbarTimeout: 5000,
    },
    getters: {
        snackbar: (state) => {
            return state.snackbar;
        },
        snackbarText: (state) => {
            return state.snackbarText;
        },
    },
    actions: {
        showSnackbar({ commit, state }, text, color){
            commit('updateSnackbar', true);
            commit('updateSnackbarText', text);
            setTimeout(function () {
                commit('updateSnackbar', false);
                commit('updateSnackbarText', '');
            }, state.snackbarTimeout);
        },
        closeSnackbar({ commit }){
            commit('updateSnackbar', false);
        }
    },
    mutations: {
        updateSnackbar(state, snackbar){
            state.snackbar = snackbar;
        },
        updateSnackbarText(state, text){
            state.snackbarText = text;
        },
    },
}
