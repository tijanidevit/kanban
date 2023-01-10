<template>
    <form @submit.prevent="addColumn">
      <label for="title">Title:</label>
      <input v-model="title" type="text" id="title" />
      <button :disabled="isSubmitting || title==='' " type="submit">Save</button>
    </form>
  </template>
  
  <script>
  import { bus } from '@/main';
  
  export default {
    data() {
      return {
        title: '',
        isSubmitting : false,
      };
    },
    methods: {
      addColumn (){
          bus.$emit('addColumn', this.title);
          this.title = "";
      }
    },
  };
  </script>
  