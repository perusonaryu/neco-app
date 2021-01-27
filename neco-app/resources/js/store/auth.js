const auth = {
    state: {
        user: null,
        token: window.localStorage.getItem('token')
    },


    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setToken(state, token) {
            window.localStorage.setItem('token', token);
        }
    },

    actions: {
        register(context, data) {
            axios.post('/api/register', data).then((result) => {
                context.commit("setUser", result.data.user);
                context.commit("setToken", result.data.token);
            }).catch(error => {
                console.log(`Error! HTTP Status: ${error}`);
            });
        },

        login(context, data) {
            axios.post('/api/login', data).then((result) => {
                context.commit("setUser", result.data.user);
                context.commit("setToken", result.data.token);
            }).catch(error => {
                console.log(`Error! HTTP Status: ${error}`);
            });
        },
        
        logout(context) {
            console.log(state.token)
            axios.post('/api/logout', null, {
                headers: {
                    Authorization: `Bearer ${state.token}`,
                }
            }).then((result) => {
                console.log(result)
                context.commit("setUser", null);
                context.commit("setToken", null);
            }).catch(error => {
                console.log(`Error! HTTP Status: ${error}`);
            });
        },

        fetchUser(context) {
            axios.get('/api/user', null, {
                headers: {
                    Authorization: `Bearer ${state.token}`,
                }
            }).then((result) => {
                context.commit("setUser", result.data.user);
            }).catch(error => {
                console.log(`Error! HTTP Status: ${error}`);
            });
        }
    },

}


export default {
    auth,
}
