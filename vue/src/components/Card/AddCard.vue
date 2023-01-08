<template>
    <form @submit.prevent="submitForm">
      <label for="name">Name:</label>
      <input v-model="name" type="text" id="name" />
      <button type="submit">Save</button>
    </form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        name: '',
      };
    },
    methods: {
      async submitForm() {
        try {
          await axios.post('/api/save-name', { name: this.name });
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  