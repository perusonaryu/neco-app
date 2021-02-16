<template>
  <div>
    <div class="top-image">
      <img src="/storage/cat-top-image.jpg" alt="" />
    </div>

    <v-container>
      <all-cat-list :userId="userData.id" />
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({}),
  computed: {
    userData() {
      return this.$store.getters['auth/user'];
    },
  },
  mounted() {
    const token = this.$store.getters['auth/token'];
    if (token && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
      // this.$store.subscribe(mutations => {
      //   if (mutations.type === 'auth/setUser') {
      //     this.userData = this.$store.getters['auth/user'];
      //   }
      // });
    }
  },
  // watch: {
  //   userData: function(userData, undefind) {
  //   },
  // },
};
</script>

<style scoped>
.top-image {
  width: 100%;
  height: 500px;
}

.top-image img {
  background-image: url('/storage/cat-top-image.jpg');
  background-size: cover;
  background-position: center;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
