<template>
  <div>
    <v-container>
      <div class="register-form">
        <v-form @submit.prevent="register" ref="form">
          <h1 class="text-center mb-5">新規登録</h1>
          <v-text-field
            v-model="registerForm.name"
            :rules="nameRules"
            label="お名前"
            outlined
            required
          ></v-text-field>
          <v-text-field
            v-model="registerForm.email"
            type="email"
            label="メールアドレス"
            :rules="emailRules"
            outlined
            required
          ></v-text-field>
          <v-text-field
            v-model="registerForm.password"
            type="password"
            label="パスワード"
            :rules="passwordRules"
            outlined
            required
          ></v-text-field>
          <v-text-field
            v-model="registerForm.password_confirmation"
            type="password"
            label="パスワード(確認)"
            :rules="confirmPasswordRules"
            outlined
            required
          ></v-text-field>
          <v-select
            :items="prefectures"
            item-text="name"
            item-value="name"
            label="地域選択"
            v-model="registerForm.region"
            :rules="prefecturesRules"
            outlined
            required
          ></v-select>
          <v-file-input
            multiple
            label="猫画像"
            prepend-inner-icon="mdi-camera"
            prepend-icon
            show-size
            v-on:change="confirmImage"
            :rules="imageRules"
          ></v-file-input>
        </v-form>
        <p v-if="confirmedImage">
          <img :src="confirmedImage" class="img" />
        </p>
        <div class="d-flex justify-end">
          <v-btn @click="register" outlined text color="#73a776">登録</v-btn>
        </div>
      </div>
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
        region: '',
        image: '',
      },
      confirmedImage: '',
      prefectures: [],
      nameRules: [v => !!v || 'お名前を入力してください。'],
      emailRules: [
        v => !!v || 'メールアドレスを入力してください。',
        v => /.+@.+\..+/.test(v) || 'メールアドレスは不正な値です。',
      ],
      passwordRules: [v => !!v || 'パスワードを入力してください。'],
      confirmPasswordRules: [
        v => !!v || '確認用パスワードを入力してください。',
        v => v === this.registerForm.password || 'パスワードと一致しません。',
      ],
      prefecturesRules: [v => !!v || '地域を選択してください。'],
      imageRules: [v => !!v || '画像を入れてください。'],

      valid: true,
    };
  },
  computed: {
    checked() {
      if (
        this.registerForm.name &&
        this.registerForm.email &&
        this.registerForm.password &&
        this.registerForm.password_confirmation &&
        this.registerForm.region
      ) {
        return true;
      } else {
        return false;
      }
    },
  },
  methods: {
    register() {
      if (this.$refs.form.validate()) {
        let registerFormData = new FormData();
        registerFormData.append('name', this.registerForm.name);
        registerFormData.append('email', this.registerForm.email);
        registerFormData.append('password', this.registerForm.password);
        registerFormData.append('password_confirmation', this.registerForm.password_confirmation);
        registerFormData.append('image', this.registerForm.image);
        registerFormData.append('region', this.registerForm.region);
        this.$store.dispatch('auth/register', registerFormData);
      }
    },
    confirmImage(e) {
      if (e[0]) {
        this.registerForm.image = e[0];
        this.createImage(this.registerForm.image);
      } else {
        this.register.image = '';
        this.confirmedImage = '';
      }
    },

    createImage(image) {
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.confirmedImage = e.target.result;
      };
    },
  },
  mounted() {
    this.prefectures = prefectureData;
  },
};
</script>

<style scoped>
.register-form {
  max-width: 500px;
  margin: 100px auto 0;
  border: 1px solid #73a776;
  border-radius: 10px;
  padding: 30px;
}

.img {
  height: 300px;
  background-size: cover;
  background-position: center;
  object-fit: cover;
}
</style>
