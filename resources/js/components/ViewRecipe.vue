<template>
    <div>
       <img :src="getPicture()" class="image"> 
        <h2> {{ recipe.name }}</h2>
        <p> Category: {{ recipe.category.title }} </p>
        <div class="card mb-2">
            <h4>Ingredients</h4>
            <div class="card-body">
                <p>How many people?</p>
                 <input v-model.number="person" type="number" min='1' placeholder=2>
                 <p> {{this.person}}</p>
        <p> time: {{ recipe.time }} minutes</p>
        <div v-for="ingredient in recipe.ingredient" v-bind:key='ingredient.id'>
            <a v-bind:href="'/ingredient/'+ ingredient.id">{{ ingredient.title }}:{{ingredient.unit}}</a>
        </div>
        
        </div>
        </div>
        <div>
            <h3>Steps:</h3>
            <p>{{ recipe.steps }}</p>
        </div>
         <div v-for="selectedRecipe in selectedRecipes" v-bind:key='selectedRecipe.id'>
            
        </div>
        <h3>Suggestions</h3>
        <div class="row">
            <div class="col-sm-4" style='width: 18rem;' v-for="recipe in recipes" v-bind:key='recipe.id'> 
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
            person:'',
            recipes: [],
            amountIngredient: '2',
            selectedRecipes: [],
            recipe: {
                id:'',
                name:'',
                time:'',
                steps:'',
            },
            recipe_id:'',
            ingredients: [],
            ingredient: {
                id:'',
                title:'',
                unit:'',
            },
            photo:'',
            edit:false
        };
    },

    created(){
        this.fetchRecipes()
        this.fetchIngredients()
    },
    methods: {
        fetchRecipes(){
            let vm = this;
            // getting the id by the url
            // Fix later
            var path = window.location.pathname;
            var str = path.split("/");
            var url = str[2]
            //console.log(url)

            fetch('/api/random/')
            .then(res=>res.json())
            .then(res=> {
                console.log(res)
                this.recipes = res.data;
            })
            .catch(err=>console.log(err));

            fetch('/api/recipes/'+url)
            .then(res=>res.json())
            .then(res=> {
                console.log(res)
                this.recipe = res.data;
                
            })
            .catch(err=>console.log(err));
        }, getPicture(){
            return "../images/bbg.jpg" + this.photo;
        },
        computed: {
        filteredRecipes: function(){
            return amountIngredient = this.amountIngredient * this.person;
        }
    },

    }
}
</script>