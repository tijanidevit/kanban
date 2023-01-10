<template>
    <div>
       
        <div @click="showModal" class="kanban-board__column__task" :data-id="card.id">
            {{ card.title }}
            <li class="fa fa-arrows move"></li>

            <modal name="editCardModal">
                <form @submit.prevent="updateCardDetails">
                    <h4>Edit Card</h4>
                    <div>
                        <label for="title">Title:</label>
                        <input v-model="title" type="text" id="title" />
                      </div>
                
                      <div>
                        <label for="description">Description:</label>
                        <textarea rows="4" v-model="description" type="text" id="description"></textarea>
                      </div>
                      <button class="btn btn-dark" :disabled="isSubmitting || title==='' || description ==='' " type="submit">Save</button>
                </form>
            </modal>
        </div>
        
    </div>
</template>


<script>
import { CARD_URL } from '@/constants';
import { bus } from '@/main';
import axios from 'axios';

export default {
    
    data(){
        return{
            isSubmitting : false,
            title : this.card.title,
            description : this.card.description,
        }
    },
    components:{
    },
    methods:{
        showModal () {
            this.$modal.show('editCardModal')
        },
        hideModal () {
            this.$modal.hide('editCardModal')
        },

        async updateCardDetails(){
            this.isSubmitting = true;
            try {
                await axios.patch(`${CARD_URL}`, { id:this.card.id,title : this.title,description: this.description });
                bus.$emit('fetchColumns');
                this.hideModal();
            }
            catch (error) {
                console.log('error :>> ', error);
                var message = error.response.data.message ;
                alert(message);
            }
            this.isSubmitting = false;
        }
    },
    props:{
        card:Object 
    }
}

</script>