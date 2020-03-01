export default {
    namespaced: true,
    state: {
        users: [],
        user: {
            name: ''
        }
    },
    getters: {
        users: (state) => {
            return state.users;
        },
        user: (state) => {
            return state.user;
        },
    },
    actions: {
        getUsers(context){
            axios
                .get('/api/users/list')
                .then((res) => {
                    context.commit('updateUsers', res.data);
                })
                .catch((res) => {
                    console.log(res.response.data);
                    throw "Something went wrong.";
                });
        },
        getUser(context, user_id)
        {
            axios
                .post('/api/users/' + user_id)
                .then((res) => {
                    context.commit('updateUser', res.data.user);
                })
                .catch((res) => {
                    console.log(res.response.data);
                    throw "Something went wrong.";
                });
        },
        deleteUser(context, id)
        {
            var res = confirm('Are you sure?');
            if(res)
            {
                axios
                    .post('/api/users/'+id+'/delete')
                    .then((res) => {
                        context.dispatch('snackbar/showSnackbar', 'Deleted');
                        context.dispatch('getUsers');
                    })
                    .catch((res) => {
                        console.log(res.response.data);
                        throw "Something went wrong.";
                    });
                return true;
            }

            return false;
        }
    },
    mutations: {
        updateUsers(state, users){
            state.users = users;
        },
        updateUser(state, user){
            state.user = user;
        },
    },
}
