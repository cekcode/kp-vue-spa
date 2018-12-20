export default {
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
        commit('removeProfile');
        router.push('/admin/profile');
        
        // axios.delete(`/api/profiles/delete/${id}`)
        // .then((response) => {
        //     id.commit('updateProfiles', response.data.profiles);
        // })
    },
    addProfile(context, formData){
        axios.post('/api/profiles/new', formData);
        context.commit('pushProfile', formData);
        context.commit('updateProfiles', false);
        // router.push('/admin/profile');
    },
    updateProfile(context, payload){
        axios.post('/api/profiles/update/'+ payload.id, payload.data);
        context.commit('removeProfile');
        context.commit('updateProfiles', false);
    },
    getPerans(context) {
        axios.get('/api/perans')
        .then((response) => {
            context.commit('updatePerans', response.data.perans);
        })
    },
    addPeran(context, formData){
        axios.post('/api/perans/new', formData);
        context.commit('pushPeran', formData);
    },
    deletePeran({commit}, id) {
        axios.delete(`/api/perans/delete/${id}`);
        commit('removePeran');
    },
    updatePeran(context, payload){
        axios.post('/api/perans/update/'+ payload.id, payload.data);
        context.commit('updatePeran');
        
    }
}