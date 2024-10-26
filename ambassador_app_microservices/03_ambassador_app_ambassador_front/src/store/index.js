import { createStore } from 'vuex';

export default createStore({
    state: {
        user: null
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        }
    },
    actions: {
        setUser({ commit }, user) { 
            return commit('SET_USER', user);
        }
    }
});
