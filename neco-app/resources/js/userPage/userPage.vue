<template>
  <v-container class="mypage" v-if="userData">
    <h2>こんにちは {{ userData.name }}さん</h2>
    <p>地域 {{ userData.region }}</p>
    <router-link to="/userProfileEdit">プロフィール編集</router-link>

    <div class="mycat-list">
      <my-cats-list :userId="userData.id" />
    </div>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    userId: '',
  }),
  computed: {
    userData() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {
  },


  mounted() {
    this.$store.dispatch('auth/fetchUser');
    this.$store.subscribe(mutations => {
      if (mutations.type === 'auth/setUser') {
        const token = this.$store.getters['auth/token'];
        this.userId = this.userData.id;
      }
    });
  },
};
</script>

<style scoped>

.mypage{
  margin-top: 100px;
}

</style>
