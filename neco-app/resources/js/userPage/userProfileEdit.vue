<template>
  <v-container>
    <v-text-field v-model="userData.name" type="text" label="name" outlined></v-text-field>

    <v-textarea outlined label="自己紹介文" auto-grow v-model="userData.introduction"></v-textarea>
    <v-select
      :items="prefectures"
      item-text="name"
      item-value="name"
      label="地域選択"
      v-model="user.region"
      outlined
    ></v-select>
    <v-btn @click="update">保存</v-btn>
  </v-container>
</template>

<script>
import prefectureData from '../prefectureData.json';
export default {
  data: () => ({
    userData: '',
    prefectures: [],
  }),
  computed: {
    user() {
      return (this.userData = this.$store.getters['auth/user']);
    },
  },
  mounted() {
    this.prefectures = prefectureData;
    const token = this.$store.getters['auth/token'];
    //認証されているかチェック
    if (!token) {
      this.$router.push({ name: 'userLogin' });
    }

    const user = this.$store.getters['auth/user'];
    if (token && !this.userData && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
    }
  },
  methods: {
    update() {
      this.$store.dispatch('auth/userUpdate',this.userData)
      .then(() => {
          alert('保存しました！');
      })
      ;
    },
  },
};
</script>

<style></style>
