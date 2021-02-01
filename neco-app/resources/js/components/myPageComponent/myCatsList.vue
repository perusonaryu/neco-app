<template>
  <v-row justify="center">
    <v-col v-if="show">
      <!-- <div v-for="catData in myCats" :key="catData.name">
        <p>{{ catData.name }}</p>
        <p>性格：{{ catData.personality }}</p>
        <v-img :src="`storage/catImages/${catData.image}`" heiht="250" width="300" />
      </div> -->
      <v-card
        class="mx-auto"
        max-width="344"
        outlined
        v-for="catData in myCats"
        :key="catData.name"
      >
        <v-list-item three-line>
          <v-list-item-avatar rounded="50%" size="100">
            <v-img :src="`/storage/catImages/${catData.image}`"></v-img>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title class="headline mb-1">
              {{ catData.name }}
            </v-list-item-title>
            <v-list-item-subtitle>
                性格：{{catData.personality}}
            </v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>

        <v-card-actions>
          <v-btn outlined rounded text>
            編集
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data: function() {
    return {
      show: false,
    };
  },

  props: ['userId'],

  computed: {
    myCats() {
      return this.$store.getters['cat/myCatsList'];
    },
  },
  watch: {
    userId: function(id, undefind) {
      this.$store.dispatch('cat/myCatsListGet', id);
      this.myCatsList = this.$store.getters['cat/myCatsList'];
      this.show = true;
    },
  },

  methods: {},
};
</script>

<style></style>
