<template>
  <v-container>
    <h2 class="text-center mb-5">猫を登録</h2>
    <v-text-field type="text" label="お名前" outlined></v-text-field>
    <v-text-field type="text" label="年齢" outlined></v-text-field>
    <v-text-field type="text" label="性格" outlined></v-text-field>
    <v-file-input
      label="猫画像"
      prepend-inner-icon="mdi-camera"
      prepend-icon
      show-size
    ></v-file-input>
  </v-container>
</template>

<script>
export default {
    data:() => ({
        
    }),
};
</script>

<style></style>
