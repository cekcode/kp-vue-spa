import { getLocalUser } from "./helpers/auth";

const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        profiles: []
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        currentUser(state) {
            return state.currentUser;
        },
        authError(state) {
            return state.auth_error;
        },
        profiles(state) {
            return state.profiles;
        }
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user, {token: payload.access_token});

            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        updateProfiles(state, payload) {
            state.profiles = payload;
        },
        REMOVE_PROFILE(state, profile){
            state.profiles;
            // profiles.splice(profiles.indexOf(profile), 1);
        },
        ADD_PROFILE(state){
            state.profiles.push({
                body: state.newProfile,
                completed: false
            });
        }
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        getProfiles(context) {
            axios.get('/api/profiles')
            .then((response) => {
                context.commit('updateProfiles', response.data.profiles);
            })
        },
        deleteProfile({commit}, id) {
            axios.delete(`/api/profiles/delete/${id}`);
            commit('REMOVE_PROFILE');
            router.push('/admin/profile');
            
            // axios.delete(`/api/profiles/delete/${id}`)
            // .then((response) => {
            //     id.commit('updateProfiles', response.data.profiles);
            // })
        },
        addProfile({commit}, formData){
            axios.post('/api/profiles/new', formData);
            router.push('/admin/profile');
            commit('ADD_PROFILE');
            
        }
    }
};