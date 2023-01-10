<template>
        <draggable class="kanban-cards" :options="{group: 'cards', handle:'.move'}" @add="addDraggedCard" >
            <CardItem v-for="card in cards" :key="card.id" :card="card" />
        </draggable>
</template>

<script>
    import { bus } from '@/main';
    import { CARD_URL } from '@/constants';
    import axios from 'axios';
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
            cards: Array,
        },
        methods:{
            addDraggedCard(event){
                let newColumnId = event.to;
                let cardId = event.item.children[0].getAttribute('data-id');
                this.updateCardColum(cardId,newColumnId);

            },
            async updateCardColum(id,column_id) {
                try {
                    await axios.patch(`${CARD_URL}/column`, { id,column_id });
                    bus.$emit('fetchColumns');
                    console.log('newColumnId :>> ', 'newColumnId');
                }
                catch (error) {
                    var message = error.response.data.message ;
                    alert(message);
                }
            }

        },
        created(){
            
        },
        watch: {
            card() {
                this.myCards = this.$props.cards
            }    
        }
   }
</script>