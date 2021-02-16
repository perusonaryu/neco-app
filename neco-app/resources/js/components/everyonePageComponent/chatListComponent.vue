<template>
  <router-link
    :to="{
      name: 'chat',
      params: { chatUserId: chatId },
    }"
  >
    {{ chatUser }}
  </router-link>
</template>

<script>
export default {
  data: () => ({
    chatUser: '',
  }),
  props: ['chatId'],
  computed: {
    chatUserData() {
      return this.$store.getters['postedUserData'];
    },
  },
  mounted() {
    this.chatUserDataGet(this.chatId);
  },

  methods: {
    chatUserDataGet(chatId) {
      axios.get('api/posted/user/detail/' + chatId).then(result => {
        this.chatUser = result.data.postedUser.name;
      });
    },
  },
};
</script>

<style></style>
