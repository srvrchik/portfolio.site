export default {
    namespaced: true,
    state: {
        categories: [],
        category: {}
    },
    getters: {
        all: (state) => {
            return state.categories;
        },
        category: (state) => {
            return state.category;
        },
    },
    actions: {
        getAll(context)
        {
            axios
                .post('/api/categories')
                .then((res) => {
                    context.commit('updateAll', res.data);
                })
                .catch((res) => {
                    console.log(res.response);
                    throw "Something went wrong.";
                });
        },
        getOne(context, id)
        {
            axios
                .post('/api/categories/' + id)
                .then((res) => {
                    context.commit('updateOne', res.data);
                })
                .catch((res) => {
                    console.log(res.response);
                    throw "Something went wrong.";
                });
        },
        delete(context, id)
        {
            axios
                .post('/api/categories/' + id + '/delete')
                .then((res) => {
                    context.dispatch('getAll');
                })
                .catch((res) => {
                    console.log(res.response);
                    throw "Something went wrong.";
                });
        }
    },
    mutations: {
        updateAll(state, all){
            state.categories = all;
        },
        updateOne(state, one){
            state.category = one;
        },
    },
}
