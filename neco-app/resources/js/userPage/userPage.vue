<template>
  <v-container>
    <h2>こんにちは {{ user.name }}さん</h2>
    <p>地域 {{ user.region }}</p>
    <router-link to="/userProfileEdit">プロフィール編集</router-link>
    <v-btn @click="logout">Logout</v-btn>
  </v-container>
</template>

<script>
export default {
  data: () => ({}),
  computed: {

    user() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {
    logout() {
      this.$store.dispatch('auth/logout').then(() => {
        this.$router.push({ name: 'userLogin' });
      });
    },
  },

  mounted() {

    const token = this.$store.getters['auth/token'];
    //認証されているかチェック
    if(!token){
        this.$router.push({ name: 'userLogin' });
    }
    const user = this.$store.getters['auth/user'];

    if (token && !user && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
    }
  },
};
</script>

<style></style>
