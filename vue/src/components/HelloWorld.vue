<template>
  <div class="kanban-board">
    <template v-for="column in columns">
      <div class="kanban-column">
        <div class="kanban-column-header">
          {{ column.title }}
          <button @click="deleteColumn(column.id)">Delete</button>
        </div>
        <draggable v-model="column.cards" class="kanban-cards" :options="{group: 'cards'}">
          <div v-for="card in column.cards" class="kanban-card" @click="openCardModal(card)">
            {{ card.title }}
          </div>
        </draggable>
        <button @click="openCardModal()">Add Card</button>
      </div>
    </template>
    <button @click="openColumnModal()">Add Column</button>
  </div>
</template>

<script>
import draggable from 'vuedraggable';
import axios from 'axios';

export default {
  components: {
    draggable,
  },
  data() {
    return {
      columns: [],
    };
  },
  created() {
    this.fetchColumns();
  },
  methods: {
    async fetchColumns() {
      try {
        const response = await axios.get('/api/columns');
        this.columns = response.data;
             for (let i = 0; i < this.columns.length; i++) {
          const column = this.columns[i];
          const response = await axios.get(`/api/columns/${column.id}/cards`);
          column.cards = response.data;
        }
      } catch (error) {
        console.error(error);
      }
    },




    async createColumn(title) {
      try {
        const response = await axios.post('/api/columns', { title });
        this.columns.push(response.data);
      } catch (error) {
        console.error(error);
      }
    },
    async deleteColumn(id) {
      try {
        await axios.delete(`/api/columns/${id}`);
        this.columns = this.columns.filter(column => column.id !== id);
      } catch (error) {
        console.error(error);
      }
    }
  }
}