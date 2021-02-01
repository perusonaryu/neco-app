<template>
  <div>
    <v-container>
      <v-form class="register-form" @submit.prevent="register">
        <h1>Register</h1>
        <v-text-field v-model="registerForm.name" label="name" outlined></v-text-field>
        <v-text-field
          v-model="registerForm.email"
          type="email"
          label="email"
          outlined
        ></v-text-field>
        <v-text-field
          v-model="registerForm.password"
          type="password"
          label="password"
          outlined
        ></v-text-field>
        <v-text-field
          v-model="registerForm.password_confirmation"
          type="password"
          label="Confirm password"
          outlined
        ></v-text-field>
        <v-select
          :items="prefectures"
          item-text="name"
          item-value="name"
          label="地域選択"
          v-model="registerForm.region"
          outlined
        ></v-select>
        <v-btn @click="register">register</v-btn>
      </v-form>
    </v-container>
  </div>
</template>

<script>
import prefectureData from '../prefectureData.json';
export default {
  name: 'register',
  data() {
    return {
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        region:'',
      },
      prefectures:[],
      
    };
  },
  methods: {
    register() {
      this.$store.dispatch('auth/register', this.registerForm);
    },
  },
  mounted() {
    this.prefectures =  prefectureData;
  },
};
</script>

<style scoped>
.register-form {
  max-width: 500px;
  margin: 0 auto;
}
</style>
