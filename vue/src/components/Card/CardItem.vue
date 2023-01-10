<template>
    <div>
       
        <div @click="showModal" class="kanban-board__column__task" :data-id="card.id">
            {{ card.title }}
            <li class="fa fa-arrows move"></li>

            <modal name="editCardModal">
                <form @submit.prevent="updateCardDetails">
                    <div>
                        <label for="title">Title:</label>
                        <input v-model="title" type="text" id="title" />
                      </div>
                
                      <div>
                        <label for="description">Description:</label>
                        <textarea v-model="description" type="text" id="description"></textarea>
                      </div>
                      <button class="btn btn-dark" :disabled="isSubmitting || title==='' || description ==='' " type="submit">Save</button>
                </form>
            </modal>
        </div>
        
    </div>
</template>


<script>

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
    },
    props:{
        card:Object 
    }
}

</script>