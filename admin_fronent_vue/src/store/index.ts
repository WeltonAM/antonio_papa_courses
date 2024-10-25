import Vuex, { Commit } from 'vuex'
import { User } from "../models/user";

export default new Vuex.Store({
    state: {
        user: new User()
    },
    mutations: {
        SET_USER(state: { user: User }, user: User) {
            state.user = user;
        }
    },
    actions: {
        setUser({commit}: { commit: Commit }, user: User) {
            return commit('SET_USER', user);
        }
    }
})
