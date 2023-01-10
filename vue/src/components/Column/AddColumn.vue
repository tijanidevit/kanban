<template>
    <div>
      <button @click="showColumnModal" class="btn btn-dark">Add new column</button>

      <modal name="addColumnModal" >
        <form class="kanban-board__form mb-3" @submit.prevent="addColumn">
          <h3>Add a new Column</h3>
          <label for="title">Title:</label>
          <input v-model="title" type="text" id="title" />
          <button class="btn btn-dark" :disabled="isSubmitting || title==='' " type="submit">Save</button>
        </form>
      </modal>
    </div>
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
      showColumnModal(){
        this.$modal.show('addColumnModal')
      },
      addColumn (){
          bus.$emit('addColumn', this.title);
          this.$modal.hide('addColumnModal')
          this.title = "";
      }
    },
  };
  </script>
  