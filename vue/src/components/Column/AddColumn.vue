<template>
    <form @submit.prevent="submitForm">
      <label for="column">Column:</label>
      <input v-model="column" type="text" id="column" />
      <button type="submit">Save</button>
    </form>
  </template>
  
  <script>
  import axios from 'axios';
  import API_URL from './../../constants'
  
  export default {
    data() {
      return {
        column: '',
      };
    },
    methods: {
      async submitForm() {
        try {
          await axios.post( API_URL, { column: this.column });
        } catch (error) {
          console.error(error);
        }
      },
    },
  };
  </script>
  