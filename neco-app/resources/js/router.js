import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Register from './auth/Register.vue'
import Login from './auth/Login.vue'

// ルータをインストール
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  { path: '/userRegister', component: Register },
  { path: '/userLogin', component: Login },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
    mode: 'history',
    routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router