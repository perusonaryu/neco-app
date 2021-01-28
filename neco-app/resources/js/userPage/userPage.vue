<template>
  <v-container>
    <h2>こんにちは {{ user.name }}</h2>
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
    const user = this.$store.getters['auth/user'];
    if (token && !user && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
    }
  },
};
</script>

<style></style>
