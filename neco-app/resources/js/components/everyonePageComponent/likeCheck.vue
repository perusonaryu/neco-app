<template>
  <div>
    <v-btn @click="unLike(userId, catId)" v-if="check" icon color="red">
      <v-icon>mdi-star</v-icon>
    </v-btn>
    <v-btn @click="like(userId, catId)" v-if="!check" icon color="black">
      <v-icon>mdi-star</v-icon>
    </v-btn>
  </div>
</template>

<script>
export default {
  data: () => ({
    check: false,
  }),
  props: ['catId', 'userId'],
  computed: {},
  watch: {
    userId: function(userId, undefind) {
      this.likeCheck(userId, this.catId);
    },
  },
  mounted() {
    if (this.userId) {
      this.likeCheck(this.userId, this.catId);
    }
  },
  methods: {
    likeCheck(userId, catId) {
      if (this.userId) {
        axios
          .post('api/cats/like/check', {
            user_id: userId,
            cat_id: catId,
          })
          .then(result => {
            if (result.data.check) {
              this.check = true;
            } else {
              this.check = false;
            }
          });
      }
    },
    like(userId, catId) {
      if (this.userId) {
        axios
          .post('api/cat/like', {
            user_id: userId,
            cat_id: catId,
          })
          .then(result => {
            this.check = !this.check;
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        this.$router.push({ name: 'userLogin' });
      }
    },
    unLike(userId, catId) {
      if (this.userId) {
        axios
          .post('api/cat/unlike', {
            user_id: userId,
            cat_id: catId,
          })
          .then(result => {
            this.check = !this.check;
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        this.$router.push({ name: 'userLogin' });
      }
    },
  },
};
</script>

<style></style>
