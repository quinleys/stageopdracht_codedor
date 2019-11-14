<template>
    <div>
        <h1>{{ ingredient.title }}  </h1>
        <p>{{ ingredient.recipe.length }} recipe(s)</p>
        <div class="card mb-2" v-for="recipe in ingredient.recipe" v-bind:key="recipe.id">
            <img :src="getPicture()" class="card-img-top" alt="...">
            <div class="card-body">
            <h1>{{ recipe.name }}</h1>
            <p>time: {{ recipe.time }} minutes </p>
            <a v-bind:href="'/detail/'+ recipe.id" class="btn btn-color">Go to detail page</a>
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
            ingredient: {
                id:'',
                title:'',
            },
            recipe_id:'',
            ingredient_id:'',
            pagination:{},
            edit:false,
            photo:'',
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
        this.fetchIngredient()
    },

    methods: {
        fetchIngredient(){
            let vm = this;
            // getting the id by the url
            // Fix later
            var path = window.location.pathname;
            var str = path.split("/");
            var url = str[2]
            console.log(url)

            fetch('/api/ingredients/' + url)
            .then(res=>res.json())
            .then(res=> {
                console.log(res)
                this.ingredient = res.data;
                
            })
            .catch(err=>console.log(err));
        },getPicture(){
            return "../images/bbg.jpg" + this.photo;
        },
        fetchCategoryRecipes(category_id){
            console.log(category_id);
            this.search = category_id;
            console.log('categoryid' + this.selectedCategory)

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