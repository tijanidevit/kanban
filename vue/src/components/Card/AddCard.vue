<template>
    <form @submit.prevent="createCard">
      <div>
        <label for="title">Title:</label>
        <input v-model="title" type="text" id="title" />
      </div>

      <div>
        <label for="description">Description:</label>
        <textarea v-model="description" type="text" id="description"></textarea>
      </div>

      <div>
        <label for="column_id">Column:</label>
        <select v-model="column_id" id="column_id">
          <option v-for="column in columns" :key="column.id" :value="column.id">{{column.title}}</option>
        </select>
      </div>
      <button class="btn btn-dark" :disabled="isSubmitting || title==='' || description ==='' " type="submit">Save</button>
    </form>
  </template>
  
  <script>
import { CARD_URL } from '@/constants';
import axios from 'axios';

  // import { bus } from '@/main';

  export default {
    data() {
      return {
        title: '',
        description: '',
        column_id:'',
        isSubmitting : false
      };
    },
    props:{
      columns: Array 
    },
    methods: {
      async createCard(){
        this.isSubmitting = true;
          try {
              await axios.post(CARD_URL, { title : this.title, description: this.description,column_id: this.column_id});
              this.title = this.description = ""
              this.$emit('cardUpdateColumns');
          } catch (error) {
              console.log('error :>> ', error);
              var message = error.response.data.message ;
              alert(message);
          }
          
        this.isSubmitting = false
      }
    },
  };
  </script>
  