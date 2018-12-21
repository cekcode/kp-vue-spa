import state from './state';
import actions from './actions';
 

export default {
    state,
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
        },
        perans(state) {
            return state.perans;
        },
        kategoris(state) {
            return state.kategoris;
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
        removeProfile(state){
            state.profiles;
            // profiles.splice(profiles.indexOf(profile), 1);
        },
        pushProfile(state, formData){
            state.profiles.push(formData);
        },
        updatePerans(state, payload) {
            state.perans = payload;
        },
        pushPeran(state, formData){
            state.perans.push(formData);
        },
        removePeran(state){
            state.perans;
        },
        updatePeran(state) {
            state.perans;
        },
        updateKategoris(state, payload) {
            state.kategoris = payload;
        },
        pushKategori(state, formData){
            state.kategoris.push(formData);
        },
        removeKategori(state){
            state.kategoris;
        }
    },
    actions
};