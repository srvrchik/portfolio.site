export default {
    namespaced: true,
    state: {
        all: [],
        one: {}
    },
    getters: {
        all: (state) => {
            return state.all;
        },
        one: (state) => {
            return state.one;
        },
    },
    actions: {
        getAll(context){
            axios
                .post('/api/portfolio')
                .then((res) => {
                    context.commit('updateAll', res.data);
                })
                .catch((res) => {
                    console.log(res.response.data);
                    context.dispatch('snackbar/showSnackbar', 'Something went wrong.');
                });
        },
        getOne(context, id){
            axios
                .post('/api/portfolio/' + id)
                .then((res) => {
                    context.commit('updateOne', res.data);
                })
                .catch((res) => {
                    console.log(res.response.data);
                    context.dispatch('snackbar/showSnackbar', 'Something went wrong.');
                });
        },
    },
    mutations: {
        updateAll(state, all){
            state.all = all;
        },
        updateOne(state, one){
            state.one = one;
        },
    }
}
