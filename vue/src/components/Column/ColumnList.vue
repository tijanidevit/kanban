<template>
    
    <div >
        <AddCard :columns="this.columns" @cardUpdateColumns="fetchColumns" />
        <div style="display: flex;overflow: auto; justify-content:space-around; border:red 2px; flex: 1 0 auto">
            <ColumnCard v-model="columns" v-for="column in columns" :key="column.id" :column="column" />
        </div>
    </div>

</template>


<script>
import { COLUMN_URL } from '@/constants';
import axios from 'axios';
import ColumnCard from './ColumnCard.vue';
import { bus } from '@/main';
import AddCard from '../Card/AddCard.vue';

export default {
    components: {
        ColumnCard,
        AddCard 
    },
    data() {
        return {
            columns: [],
        };
    },
    created() {
        this.fetchColumns();
        bus.$on('addColumn', (title) => {
            this.createColumn(title);
        });
        bus.$on('fetchColumns', () => {
            this.fetchColumns();
        });
        bus.$on('deleteColumn', (id) => {
            this.deleteColumn(id);
        });
    },
    methods: {
        async fetchColumns() {
            try {
                const response = await axios.get(COLUMN_URL);
                this.$set(this, 'columns', response.data.data);
            }
            catch (error) {
                var message = error.message ;
                alert(message);
            }
        },
        async createColumn(title) {
            try {
                await axios.post(COLUMN_URL, { title });
                this.fetchColumns();
            }
            catch (error) {
                var message = error.response.data.message ;
                alert(message);
            }
        },
        async deleteColumn(id) {
            try {
                await axios.delete(`${COLUMN_URL}/${ id }`);
                this.fetchColumns();
            }
            catch (error) {
                var message = error.response.data.message ;
                alert(message);
            }
        }
    }
}
</script>

<style lang="scss">
@import '@/assets/_shared.scss'
</style>