<template>
    <div>
       
        <div  class="kanban-board__column__task">
            {{ card.title }}
            <li class="fa fa-arrows move"></li>
        </div>
    </div>
</template>


<script>


export default {
    components:{
    },
    props:{
        card:Object 
    }
}

</script>