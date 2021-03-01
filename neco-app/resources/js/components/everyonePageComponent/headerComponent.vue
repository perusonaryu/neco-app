<template>
  <div class="header">
    <router-link
      class="logo"
      :to="{
        name: 'topPage',
      }"
    >
      <img src="/storage/nekologo3.png" />
    </router-link>
    <ul>
      <li v-if="!authCheck">
        <router-link  :to="{ name: 'userRegister' }">
          新規登録
        </router-link>
      </li>
      <li v-if="!authCheck">
        <router-link  :to="{ name: 'userLogin' }">
          ログイン
        </router-link>
      </li>
      <li v-if="authCheck">
        <router-link :to="{ name: 'userPage' }">
          マイページ
        </router-link>
      </li>
      <li v-if="authCheck">
        <router-link :to="{ name: 'catRegister' }">
          猫登録
        </router-link>
      </li>
      <li v-if="authCheck">
        <router-link :to="{ name: 'chatList' }">
          チャットリスト
        </router-link>
      </li>
      <li>
        <router-link
          :to="{
            name: 'catSearched',
          }"
        >
          猫を探す
        </router-link>
      </li>
      <li v-if="authCheck">
        <a @click="logout">
          ログアウト
        </a>
      </li>
      <div v-if="authCheck" >
        <span class="user-name">
          {{ user.name }}
        </span>
        さん
      </div>
    </ul>
  </div>
</template>

<script>
export default {
  data: () => ({
    authCheck: false,
  }),
  computed: {
    user() {
      return this.$store.getters['auth/user'];
    },
  },
  mounted() {
    const token = this.$store.getters['auth/token'];

    if (token && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
      this.authCheck = true;
    } else {
      this.authCheck = false;
    }
  },
  watch: {
    user: function(userData, undefind) {
      if (userData) {
        this.authCheck = true;
      } else {
        this.authCheck = false;
      }
    },
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout').then(() => {
        if (this.$route.path != '/') this.$router.push({ name: 'topPage' });
      });
    },
  },
};
</script>

<style scoped>
ul {
  margin: 0;
  padding: 0;
}

.header {
  display: flex;
  justify-content: space-between;
  position: fixed;
  width: 100%;
  z-index: 5;
  /* opacity: 0.7; */
  /* background-color: #fdf7f3; */
  background: rgba(253, 247, 243, 0.7);
}

.header .logo {
  width: 200px;
  height: 60px;
}

.header .logo:hover {
  opacity: 0.7;
}

.header .logo img {
  width: 100%;
  height: 100%;
}

.header ul {
  display: flex;
  list-style: none;
  align-items: center;
  margin: 0;
}

.header ul li {
  height: 100%;
  width: 105px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.header ul li a {
  color: #333333;
}

.header ul li:hover {
  background-color: #dae2db;
}

.user-name{
  font-weight:bold;
}
</style>
