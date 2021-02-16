<template>
  <v-row justify="center">
    <v-col v-for="catData in myCats" :key="catData.name" md="4">
      <v-card class="mx-auto" max-width="400" outlined>
        <v-list-item three-line>
          <v-list-item-avatar rounded="50%" size="100">
            <v-img :src="`/storage/catImages/${catData.image}`"></v-img>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="headline mb-1">
              {{ catData.name }}
            </v-list-item-title>
            <v-list-item-subtitle> {{ catData.age }}さい </v-list-item-subtitle>
            <v-list-item-subtitle> 性格：{{ catData.personality }} </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-card-actions>
          <router-link
            :to="{
              name: 'myCatEdit',
              params: { catId: catData.id },
            }"
          >
            <v-btn outlined rounded text>
              編集
            </v-btn>
          </router-link>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: function() {
    return {};
  },

  props: ['userId'],

  computed: {
    myCats() {
      return this.$store.getters['cat/myCatsList'];
    },

    user() {
      return this.$store.getters['auth/user'];
    },
  },
  watch: {
    user: function(user, undefind) {
      const token = this.$store.getters['auth/token'];
      this.$store.dispatch('cat/myCatsListGet', { userId: user.id, token: token });
    },
  },
  mounted() {},

  methods: {},
};
</script>

<style></style>
