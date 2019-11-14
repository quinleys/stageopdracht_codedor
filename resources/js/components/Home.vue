<template>
    <div>
        <div class="home">
            <img :src="getPicture2()" class="homeimage" alt="...">
            <div class="text">
            <h1>Only the best recipes for you!</h1>
            <p>Find the best recipes for you and your friends. Search the recipes by ingredients.</p>
            <a class="btn btn-color" href="/overview">Search</a>
            </div>
        </div>
        <h2 class="text-center">Suggestions</h2>
        <div class="row">
            
        <div  class="col-sm-4" style='width: 18rem;' v-for="recipe in recipes" v-bind:key='recipe.id'> 
            <div class="card">
            <img :src="getPicture()" class="card-img-top" alt="...">
            <div class="card-body">
            <h3> {{ recipe.name }}</h3>
            <p> time: {{ recipe.time }} minutes </p>
            <p>  Category: {{ recipe.category.title }} </p>
            <a v-bind:href="'/detail/'+ recipe.id" class="btn btn-color">Go to detail page</a>
            </div>
            </div>
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
        this.fetchRecipes()
        this.fetchCategories()
    },
    methods: {
        fetchRecipes(page_url){
            let vm = this;
            page_url = page_url || '/api/random'
            fetch(page_url)
            .then(res=>res.json())
            .then(res=> {
                console.log(res)
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
        getPicture(){
            return "../images/bbg.jpg" + this.photo;
        },
        getPicture2(){
            return "../images/smallhome.png" + this.photo;
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

}
</script>