<template>
    <div>
        <h2>Recipes</h2>
        <input type='text' class="form-control"  v-model="search" placeholder="Search a recipe">
        <h5>Categories</h5>
        <ul class="nav justify-content-center">
            <a class="nav-link" href="#" @click="fetchCategoryRecipes('')">all</a>
            <a v-for="category in categories" v-bind:key='category.id' class="nav-link" href="#" @click="fetchCategoryRecipes(category.title)">{{ category.title }}</a>
        </ul>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRecipes(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#"> Page {{ pagination.current_page }} of {{ pagination.last_page }} </a> </li>
                <li  v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRecipes(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div class="card mb-2" v-for="recipe in filteredRecipes" v-bind:key='recipe.id'> 
            <img :src="getPicture()" class="card-img-top" alt="...">
            <div class="card-body">
            <h3> {{ recipe.name }}</h3>
            <p> Time: {{ recipe.time }} minutes </p>
            <p>  Category: {{ recipe.category.title }} </p>
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
            recipe_id:'',
            photo:'',
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
        this.fetchRecipes()
        this.fetchCategories()
    },

    methods: {
        fetchRecipes(page_url){
            let vm = this;
            page_url = page_url || '/api/recipes'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=> {
                this.recipes = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err=>console.log(err));
        },
        fetchCategories(){
            fetch('/api/categories')
            .then(res=>res.json())
            .then(res=> {
                this.categories = res.data;
                vm.makePagination(res.meta, res.links);
            })
            .catch(err=>console.log(err));
        },
        fetchCategoryRecipes(category_id){
            console.log(category_id);
            this.search = category_id;
            console.log('categoryid' + this.selectedCategory)

        },getPicture(){
            return "../images/bbg.jpg" + this.photo;
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