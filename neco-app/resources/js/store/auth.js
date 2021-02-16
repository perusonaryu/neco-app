import router from '../router'

const state =  {
    user: null,
    token: window.sessionStorage.getItem('token'),

}


const getters = {
    check: state => !!state.user,
    user: state => state.user ? state.user : '',
    token: state => state.token ? state.token : ''
}

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    resetUser(state){
        state.user = null;
    },
    setToken(state, token) {
        window.sessionStorage.setItem('token', token);
        state.token = token;
    },
    
}

const actions = {
    register(context, data) {
        axios.post('/api/register', data).then((result) => {
            context.commit("setUser", result.data.user);
            context.commit("setToken", result.data.token);
            router.push({ name: 'userPage' });
        }).catch(error => {
            console.log(`Error! HTTP Status: ${error}`);
        });
    },

    login(context, data) {
        axios.post('/api/login', data).then((result) => {
            context.commit("setUser", result.data.user);
            context.commit("setToken", result.data.token);
            router.push({ name: 'topPage' });
        }).catch(error => {
            console.log(`Error! HTTP Status: ${error}`);
            router.push({ name: 'userLogin' });
        });
    },

    logout(context) {
        axios.post('/api/logout', null,{
            headers: {
                Authorization: `Bearer ${state.token}`,
            }
        })
        .then((result) => {
            console.log(result.data);
            context.commit("resetUser", null);
            context.commit("setToken", null);
            
        }).catch(error => {
            console.log(`Error! HTTP Status: ${error}`);
            
        });
    },

    fetchUser(context) {
        axios.get('/api/user',{
            headers: {
                Authorization: `Bearer ${state.token}`,
            }
        }).then((result) => {
            context.commit("setUser", result.data.user);
        }).catch(error => {
            console.log(`Error! HTTP Status: ${error}`);
            router.push({ name: 'userLogin' });
        });
    },

    userUpdate(context,data){
        axios.put('/api/user/update',data ,{
            headers: {
                Authorization: `Bearer ${state.token}`,
            }
        }).then((result) => {
            context.commit('setUser',result.data.user);
        }).catch(error => {
            console.log(error);
        })
    },
    
}




export default {
    namespaced:true,
    state,
    getters,
    mutations,
    actions
}
