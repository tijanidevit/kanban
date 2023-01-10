<template>
    <div class="kanban-board__column">
        <div class="kanban-board__column--header">
          {{ this.column.title }}
          <button @click="deleteColumn" class="btn btn-danger">Delete</button>
        </div>
        <CardList :cards="this.column.cards" :column-id="this.column.id" />
    </div>
</template>
  
<script>

  import CardList from '../Card/CardList.vue';
  
  import { bus } from '@/main';
  
  export default {
    components:{
      CardList,
    },
    props:{
      column : Object
    },
    updated(){
      () => console.log('column :>> ', this.column);
    },
    methods: {
      deleteColumn (){
        // alert(this.column.id)
        bus.$emit('deleteColumn', this.column.id);
      }
    },
  };
</script>
  