import Vue from 'vue'
import VueRouter from 'vue-router'


// ページコンポーネントをインポートする
import Register from './auth/Register.vue'
import Login from './auth/Login.vue'
import userPage from './userPage/userPage.vue'
import userProfileEdit from './userPage/userProfileEdit.vue'
import catRegister from './userPage/catRegister.vue'

// ルータをインストール
Vue.use(VueRouter)


// パスとコンポーネントのマッピング
const routes = [
  { 
    path: '/userRegister', 
    component: Register ,
    name:'userRegister'
  },
  { 
    path: '/userLogin', 
    component: Login ,
    name: 'userLogin',
  },
  { 
    path: '/userPage', 
    component:userPage,
    name: 'userPage', 
  },
  {
    path:'/userProfileEdit',
    component:userProfileEdit,
    name:'userProfileEdit'
  },
  {
    path:'/catRegister',
    component:catRegister,
    name:'catRegister',
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})




// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router