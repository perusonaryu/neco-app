<template>
  <router-link
    v-if="chatUser"
    class="chat-user"
    :to="{
      name: 'chat',
      params: { chatUserId: chatUserId },
    }"
  >
    <v-list-item-avatar height="70" width="70">
      <v-img :src="`/storage/userImages/${chatUser.image}`"></v-img>
    </v-list-item-avatar>
    <v-list-item-content>
      <v-list-item-title class="chat-user-name" v-text="chatUser.name"></v-list-item-title>
      <v-list-item-subtitle class="item-list">
        <span class="message"> {{ ratestMessage.message }} </span>
        <span class="datetime"> {{ ratestMessage.created_at | datetime }} </span>
      </v-list-item-subtitle>
    </v-list-item-content>
  </router-link>
</template>

<script>
import moment from 'moment';
export default {
  data: () => ({
    chatUser: '',
    ratestMessage: '',
  }),
  props: ['chatUserId', 'userId'],
  computed: {
    chatUserData() {
      return this.$store.getters['postedUserData'];
      
    },
  },
  mounted() {
    this.chatUserDataGet(this.chatUserId);
    this.ratestMessageGet(this.chatUserId, this.userId);
  },
  filters: {
    datetime: function(date) {
      return moment(date).format('YYYY/MM/DD HH:mm');
    },
  },

  methods: {
    chatUserDataGet(chatUserId) {
      axios.get('api/posted/user/detail/' + chatUserId).then(result => {
        this.chatUser = result.data.postedUser;
      });
    },
    ratestMessageGet(userId1, userId2) {
      axios.get('api/latestmessage/' + userId1 + '/' + userId2).then(result => {
        this.ratestMessage = result.data.ratestMessage;
      });
    },
  },
};
</script>

<style scoped>
.chat-user {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
}

.chat-user-name {
  font-weight: bold;
}

.item-list {
  display: flex;
  justify-content: space-between;
}
</style>
