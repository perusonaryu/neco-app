<template>
  <v-container class="text-center wrap">
    <h2>猫を探す</h2>

    <p class="error-text" v-if="error">文字を入力してください！</p>
    <form class="form-inline d-flex justify-center">
      <input
        class="form-control mr-sm-2 "
        type="search"
        placeholder="地域で検索 例:沖縄"
        aria-label="Search"
        v-model="searchWord"
      />
      <v-btn @click="search">検索</v-btn>
    </form>
    <v-row justify="center" v-if="catsSearchedData">
      <v-col cols="12" md="6" lg="6" v-for="catData in catsSearchedData" :key="catData.name">
        <v-card class="mx-auto" width="100%" outlined>
          <v-list-item three-line>
            <router-link
              :to="{
                name: 'catDetail',
                params: { catId: catData.id },
              }"
            >
              <v-list-item-avatar rounded="50%" size="150">
                <v-img :src="`/storage/catImages/${catData.image}`"></v-img>
              </v-list-item-avatar>
            </router-link>
            <v-list-item-content>
              <v-list-item-title class="headline mb-1">
                {{ catData.name }}
              </v-list-item-title>
              <v-list-item-subtitle> {{ catData.age }}さい </v-list-item-subtitle>
              <v-list-item-subtitle> 性格：{{ catData.personality }} </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-card-actions>
            <like-check class="check-btn" :catId="catData.id" :userId="user.id" />
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    catsData: '',
    userId: '',
    searchWord: '',
    error:false
  }),

  computed: {
    user() {
      return this.$store.getters['auth/user'];
    },
    catsSearchedData() {
      return this.catsData;
    },
    allCatsData() {
      return this.$store.getters['cat/allCatData'];
    },
  },
  mounted() {
    // this.search();
    this.allCatsDataGet();
    const token = this.$store.getters['auth/token'];
    if (token && token != 'null') {
      this.$store.dispatch('auth/fetchUser');
    }
  },

  watch: {
    allCatsData: function(allCatsData, undefind) {
      this.catsData = allCatsData;
    },
  },

  methods: {
    allCatsDataGet() {
      this.$store.dispatch('cat/allCatsData');
    },
    search() {
        if(this.searchWord){
            axios
              .get('api/search', { params: this.searchWord })
              .then(result => {
                this.catsData = result.data.searchedCatsData;
                this.error = false;
              })
              .catch(error => {
                console.log(error);
              });
        }else{
            this.error = true;
        }
    },
  },
};
</script>

<style scoped>
.wrap{
  margin-top: 100px;
}

.error-text{
    color:red;
}
</style>
