<template>
  <div>
    <h1>Register</h1>
    <v-container>
      <v-form class="register-form" @submit.prevent="register">
        <v-text-field v-model="registerForm.name" label="name" outlined></v-text-field>
        <v-text-field v-model="registerForm.email" type="email" label="email" outlined></v-text-field>
        <v-text-field v-model="registerForm.password" type="password" label="password" outlined></v-text-field>
        <v-text-field v-model="registerForm.password_confirmation" type="password" label="Confirm password" outlined></v-text-field>
        <v-btn @click="register">register</v-btn>
      </v-form>
    </v-container>
  </div>
</template>

<script>
export default {
  name: 'register',
  data() {
    return {
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
    };
  },
  methods: {
    register() {
      this.$store.dispatch("auth/register", this.registerForm)
        .then(() => {
          this.$router.push({ name: "userPage" });
        });
    }
  }
};
</script>


<style scoped>
  .register-form{
    max-width:500px;
    margin:0 auto;
  }
</style>
