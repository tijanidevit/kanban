<template>
  <div class="kanban-board" id="app">
    <img alt="Vue logo"  src="./assets/logo.png">
    <AddColumn />
    <ColumnList />
  </div>
</template>

<script>
import AddColumn from './components/Column/AddColumn.vue'
import ColumnList from './components/Column/ColumnList.vue';


export default {
  name: 'App',
  components: {
    AddColumn,
    ColumnList
  }
  
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
