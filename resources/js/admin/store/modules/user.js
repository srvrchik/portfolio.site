export default {
    namespaced: true,
    state: {
        authUser: {}
    },
    getters: {
        authUser: (state) => {
            return state.authUser;
        },
    },
    actions: {
        getUser(context)
        {
            axios
                .post('/user')
                .then((res) => {
                    context.commit('updateUser', res.data.user);
                })
                .catch((res) => {
                    console.log(res);
                    throw "Something went wrong.";
                });
        },
    },
    mutations: {
        updateUser(state, user){
            state.authUser = user;
        },
    },
}
