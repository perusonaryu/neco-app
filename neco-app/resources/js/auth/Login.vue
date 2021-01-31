<template>
  <div>
    <v-container>
      <v-form class="login-form" @submit.prevent="register">
        <h1>Login</h1>
        <v-text-field v-model="loginForm.email" type="email" label="email" outlined></v-text-field>
        <v-text-field
          v-model="loginForm.password"
          type="password"
          label="password"
          outlined
        ></v-text-field>
        <v-btn @click="login">login </v-btn>
      </v-form>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    loginForm: {
      email: '',
      password: '',
    },
  }),
  methods: {
    login() {
      this.$store.dispatch('auth/login', this.loginForm).then( () => {
        this.$router.push({ name: 'userPage' });
      });
    },
  },
};
</script>

<style scoped>
.login-form {
  max-width: 500px;
  margin: 0 auto;
}
</style>
