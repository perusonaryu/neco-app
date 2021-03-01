<template>
  <div>
    <v-row justify="center"  v-if="AllCatData">
      <v-col cols="12" md="6" lg="6" v-for="catData in AllCatData" :key="catData.name">
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
            <like-check class="check-btn" :catId="catData.id" :userId="userId"  />
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({
    AllCatData: '',
  }),
  props: ['userId'],

  mounted() {
    this.$store.dispatch('cat/allCatsData');
    this.$store.subscribe(mutations => {
      if (mutations.type === 'cat/setAllCatData') {
        this.AllCatData = this.$store.getters['cat/allCatData'];
      }
    });
  },
};
</script>

<style scoped>
.check-btn {
  z-index: 3;
}
</style>
