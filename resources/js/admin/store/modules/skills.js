export default {
    namespaced: true,
    state: {
        skills: [],
        skill: {}
    },
    getters: {
        skills: (state) => {
            return state.skills;
        },
        skill: (state) => {
            return state.skill;
        },
    },
    actions: {
        getSkills(context)
        {
            axios
                .post('/api/skills')
                .then((res) => {
                    context.commit('updateSkills', res.data);
                })
                .catch((res) => {
                    console.log(res.response);
                    throw "Something went wrong.";
                });
        },
        getSkill(context, id){
            axios
                .post('/api/skills/' + id)
                .then((res) => {
                    context.commit('updateSkill', res.data);
                })
                .catch((res) => {
                    console.log(res.response);
                    this.showSnackbar('Something went wrong.');
                });
        },
    },
    mutations: {
        updateSkills(state, all){
            state.skills = all;
        },
        updateSkill(state, skill){
            state.skill = skill;
        },
    },
}
