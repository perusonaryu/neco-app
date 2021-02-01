

const state = {
    myCatsList:'',
    token: window.localStorage.getItem('token')
}

const getters = {
    myCatsList: state => state.myCatsList ? state.myCatsList : '',
}

const mutations = {
    setMyCatsList(state,data){
        state.myCatsList = data;
    }
}

const actions = {
    register(context,data){
        
        axios.post('api/cat/register',data,{
        headers: {
            Authorization: `Bearer ${state.token}`,
            'content-type': 'multipart/form-data',
        }})
        .then( (result) => {
            console.log('猫を登録しました!');
        })
        .catch( (error) => {
            console.log(error);
        })
    },

    myCatsListGet(context,id){
        axios.get('api/cat/mydata/'+ id,{
            headers: {
                Authorization: `Bearer ${state.token}`,
            }
        })
        .then( (result) => {
            context.commit('setMyCatsList',result.data.myCatsList);
        })
    }
}


export default {
    namespaced:true,
    state,
    getters,
    mutations,
    actions
}