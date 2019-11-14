<template>
<div>
    <h1>Ingredients</h1>
    <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchIngredients(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#"> Page {{ pagination.current_page }} of {{ pagination.last_page }} </a> </li>
                <li  v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchIngredients(pagination.next_page_url)">Next</a></li>
            </ul>
    </nav>
        <div class="card mb-2" v-for="ingredient in ingredients" v-bind:key='ingredient.id'> 
            <div class="card-body">
            <h3> {{ ingredient.title }}</h3>
            <p> {{ ingredient.recipe.length}} recipe(s) </p>
            <a v-bind:href="'/ingredient/'+ ingredient.id">Go to detail page</a>
            </div>
        </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            search:'',
            recipes: [],
            recipe: {
                id:'',
                name:'',
                time:'',
                steps:'',
            },
            ingredients: [],
            recipe_id:'',
            pagination:{},
            edit:false,
            categories: [],
            category: {
                id:'',
                title:'',
                synopsis:'',
            },
            category_id:'',
        };
    },

    created(){
        this.fetchIngredients()
    },

    methods: {
        fetchIngredients(page_url){
            let vm = this;
            page_url = page_url || '/api/ingredients'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=> {
                console.log(res)
                this.ingredients = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err=>console.log(err));
        },
         makePagination(meta,links){
             let pagination = {
                 current_page: meta.current_page,
                 last_page: meta.last_page,
                 next_page_url: links.next,
                 prev_page_url: links.prev,
             }

             this.pagination = pagination;
         }
    },
    computed: {
        filteredRecipes: function(){
            return this.recipes.filter((recipe) => {
                return recipe.category.title.match(this.search) || recipe.name.match(this.search)
                
            })
        }
    },
}
</script>