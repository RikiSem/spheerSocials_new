import {createStore} from "vuex";
import axios from "axios";

export default createStore({
    state: {
        user: {}
    },
    mutations: {
        getUser(state, user) {
            state.user = user;
        }
    }
})