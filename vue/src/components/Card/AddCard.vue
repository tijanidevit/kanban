<template>
    <div class="mb-3">
      <button class="btn btn-dark" @click="showCardModal"> Add Card</button>

      <modal name="addCardModal" height="400">
        <form @submit.prevent="createCard" class="mb-3">
          <h4>Add a new card</h4>
          <div>
            <label for="title">Title:</label>
            <br/>
            <input v-model="title" type="text" id="title" />
          </div>
        
          <div>
            <label for="description">Description:</label>
            <br/>
            <textarea rows="4" v-model="description" type="text" id="description"></textarea>
          </div>
       
          <div>
            <label for="column_id">Column:</label>
            <br/>
            <select v-model="column_id" id="column_id">
              <option v-for="column in columns" :key="column.id" :value="column.id">{{column.title}}</option>
            </select>
          </div>
        <button class="btn btn-dark" :disabled="isSubmitting || title==='' || description ==='' " type="submit">Save</button>
      </form>
      </modal>
    </div>
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
      showCardModal(){
        this.$modal.show('addCardModal')
      },
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
        this.$modal.hide('addCardModal')
      }
    },
  };
  </script>
  