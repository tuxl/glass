const sidebar = {
    namespaced: true,
    state: {
        current:'',
    },
    mutations: {
        setMenu(state, menu){
            state.current = menu;
        },
    },
    actions: {

    },
    getters: {

    }
};

export {sidebar};