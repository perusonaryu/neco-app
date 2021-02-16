<template>
  <v-container>
    <ul>
      <li v-for="chat in chatList" :key="chat.id">
        <chat-list v-if="user.id != chat.user_id_1" :chatId="chat.user_id_1"></chat-list>
        <chat-list v-else-if="user.id != chat.user_id_2" :chatId="chat.user_id_2"></chat-list>
      </li>
    </ul>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    chatList: '',
  }),
  computed: {
    user() {
      return this.$store.getters['auth/user'];
    },
  },
  mounted() {
    this.$store.dispatch('auth/fetchUser');
    this.$store.subscribe(mutations => {
      if (mutations.type === 'auth/setUser') {
        this.chatListDataGet(this.user.id);
      }
    });
  },
  methods: {
    chatListDataGet(userId) {
      axios
        .get('api/messagelist/' + userId)
        .then(result => {
          this.chatList = result.data.chatList;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
};
</script>

<style></style>
