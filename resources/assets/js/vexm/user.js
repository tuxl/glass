const user = {
    namespaced: true,
    state: {
        info:{
            name:'',
        },
    },
    mutations: {
        setInfo(state, info){
            state.info = info;
        },
    },
    actions: {  },
    getters: {  }
};

export { user };