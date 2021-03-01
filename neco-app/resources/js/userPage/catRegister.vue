<template>
  <v-container class="cat-register" v-if="user">
    <h2 class="text-center mb-5">猫を登録</h2>
    <v-text-field v-model="form.name" type="text" label="お名前" outlined></v-text-field>
    <v-text-field v-model="form.age" type="text" label="年齢" outlined></v-text-field>
    <v-text-field v-model="form.personality" type="text" label="性格" outlined></v-text-field>
    <v-text-field v-model="form.gender" type="text" label="性別" outlined></v-text-field>
    <v-file-input
      multiple
      label="猫画像"
      prepend-inner-icon="mdi-camera"
      prepend-icon
      show-size
      v-on:change="confirmImage"
    ></v-file-input>
    <p v-if="confirmedImage">
      <img :src="confirmedImage" class="img" />
    </p>

    <v-btn @click="catRegister">
      登録
    </v-btn>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    form: {
      name: '',
      age: '',
      personality: '',
      gender: '',
      image: '',
      userId: '',
    },
    userData: '',
    confirmedImage: '',
  }),
  computed: {
    user() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    user: function(user, undefind) {
      this.form.userId = user.id;
    },
  },
  mounted() {
    const token = this.$store.getters['auth/token'];
    if (token && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
    } else {
      this.$router.push({ name: 'userLogin' });
    }
  },

  methods: {
    catRegister() {
      let formData = new FormData();
      formData.append('name', this.form.name);
      formData.append('age', this.form.age);
      formData.append('personality', this.form.personality);
      formData.append('image', this.form.image);
      formData.append('gender', this.form.gender);
      formData.append('userId', this.form.userId);

      this.$store.dispatch('cat/register', formData);
    },
    confirmImage(e) {
      this.form.image = e[0];
      this.createImage(this.form.image);
    },

    createImage(image) {
      let reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = e => {
        this.confirmedImage = e.target.result;
      };
    },
  },
};
</script>

<style scoped>
.cat-register {
  margin-top: 100px;
}

.img {
  width: 500px;
  height: 300px;
  background-size: cover;
  background-position: center;
}
</style>
