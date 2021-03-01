<template>
  <v-container>
    <v-row justify="center" align="center">
      <v-col class="image" md="7" cols="12" v-if="catId == this.catDetail.id">
        <h2>{{ catDetail.name }}</h2>
        <img :src="`/storage/catImages/${catDetail.image}`" />
      </v-col>
      <v-col md="7" cols="12">
        <table>
          <tr>
            <th>性別</th>
            <td class="w-25">おす</td>
            <th>年齢</th>
            <td class="w-25">{{ catDetail.age }}歳</td>
          </tr>
          <tr>
            <th>特徴</th>
            <td colspan="3">{{ catDetail.personality }}</td>
          </tr>
        </table>
      </v-col>
      <v-col md="4" cols="12" v-if="catPostedUserData">
        <h4>掲載者</h4>
        <div class="user_information">
          <p>掲載者： {{ catPostedUserData.name }}</p>
          <p>所在県： {{ catPostedUserData.region }}</p>
          <p>自己紹介など： {{ catPostedUserData.introduction }}</p>
        </div>
        <router-link
          v-if="catDetail"
          :to="{
            name: 'chat',
            params: { chatUserId: catDetail.user_id },
          }"
        >
          <v-btn text>連絡をする</v-btn>
        </router-link>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({}),
  computed: {
    catDetail() {
      return this.$store.getters['cat/detailCatData'];
    },
    catId() {
      return this.$route.params.catId;
    },
    catPostedUserData() {
      return this.$store.getters['cat/postedUserData'];
    },
  },
  mounted() {
    this.catDatailGet();
  },
  watch: {
    catDetail: function(catDetail, undefind) {
      this.catPostedUserDataGet();
    },
  },

  methods: {
    catDatailGet() {
      this.$store.dispatch('cat/catDatailGet', this.$route.params.catId);
    },
    catPostedUserDataGet() {
      this.$store.dispatch('cat/postedUserDetail', this.catDetail.user_id);
    },
  },
};
</script>

<style scoped>
.image img {
  background-size: cover;
  background-position: center;
  width: 100%;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  border: 1px solid gray;
}

table th,
table td {
  padding: 10px 0;
  text-align: center;
}

table th {
  background-color: yellow;
  width: 20%;
}

table tr + tr {
  border-top: 1px solid gray;
}

.w-25 {
  width: 25%;
}

.user_information {
  border: 1px solid gray;
  border-radius: 5px;
  padding: 10px;
}
</style>
