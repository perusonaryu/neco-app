

const state = {
    myCatsList:'',
    token: window.sessionStorage.getItem('token'),
    editCatData:'',
    allCatData:'',
    detailCatData:'',
    postedUserData:'',
}

const getters = {
    myCatsList: state => state.myCatsList ? state.myCatsList : '',
    editCatData: function(state){
        return state.editCatData
    },
    allCatData:state => state.allCatData,
    detailCatData:state => state.detailCatData,
    postedUserData:state => state.postedUserData,
}

const mutations = {
    setMyCatsList(state,data){
        state.myCatsList = data;
    },
    setCatEditData(state,data){
        state.editCatData = data;
    },
    setToken(state){
        state.token = window.sessionStorage.getItem('token');
    },
    setAllCatData(state,data){
        state.allCatData = data;
    },
    setCatDetail(state,data){
        state.detailCatData = data;
    },
    setPostedUserData(state,data){
        state.postedUserData = data;
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

    myCatsListGet(context,{userId,token}){
        axios.get('api/cat/mydata/'+ userId,{
            headers: {
                Authorization: `Bearer ${token}`,
            }
        })
        .then( (result) => {
            context.commit('setMyCatsList',result.data.myCatsList);
            context.commit('setToken');
        })
        .catch((error) => {
            console.log(error);
        })
    },

    catEditDataGet(context,id){
        axios.get('api/cat/edit/'+ id ,{
            headers: {
                Authorization: `Bearer ${state.token}`,
            }
        })
        .then((result) => {
            context.commit('setCatEditData',result.data.catData[0]);
        })
    },
    catDataUpdate(context,data){
        axios.post('api/cat/update',data,{
            headers: {
                Authorization: `Bearer ${state.token}`,
                'X-HTTP-Method-Override': 'PUT',
            }
        }).then( (result) => {
            context.commit('setCatEditData',result.data.catData);
            alert('保存しました！')
        }).catch( (error) => {
            console.log(error);
        })
    },
    allCatsData(context){
        axios.get('api/cats/data')
        .then( (result) => {
            context.commit('setAllCatData',result.data.catsData);
        })
    },
    catDatailGet(context,catiId){
        axios.get('api/cat/detail/' + catiId)
        .then( (result) =>{
            context.commit('setCatDetail',result.data.catData[0]);
        })
        .catch((error) => {
            console.log(error);
        })
    },
    postedUserDetail(context,postedUserId){
        axios.get('/api/posted/user/detail/' + postedUserId)
        .then( (result) => {
            context.commit('setPostedUserData',result.data.postedUser);
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