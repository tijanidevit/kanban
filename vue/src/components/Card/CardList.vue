<template>
    <div >
        <draggable class="kanban-cards" :options="{group: 'cards', handle:'.move'}" >
            <CardItem v-for="card in cards" :key="card.id" :card="card" />
        </draggable>
    </div>
</template>

<script>
    import { bus } from '@/main';
    import draggable from 'vuedraggable';
    import CardItem from './CardItem.vue';
    
    export default {
        data(){
            return {
                myCards : this.cards
            }
        },
        components:{
            CardItem,
            draggable
        },
        props:{
            cards: Array
        },
        created(){
            bus.$on('createCard', (title,description,column_id) => {
                this.createCard(title,description,column_id);
            });
        },
        watch: {
            card() {
                this.myCards = this.$props.cards
            }    
        }
   }
</script>