<template>

        <div class="container">

            <div class="row single-page-container">

                    <img :src="product.image" :alt="product.name" class="flex-child">
                    <h3 class="title flex-child" v-html="product.name"></h3>
                    <p class="text-muted flex-child">{{product.description}}</p>
                        <span class="small-text text-muted float-left flex-child">{{product.price}} SEK</span>
                        <span class="small-text float-right flex-child">Available Quantity: {{product.units}}</span>
                    <br>
                    <hr>
                    <router-link :to="{ path: '/checkout?pid='+product.id }" class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</router-link>

            </div>
        </div>
    </template>

    <script>
    export default {
        data(){
            return {
                product : []
            }
        },
        beforeMount(){
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => this.product = response.data)      
        }
    }
    </script>

    <style scoped>
    .single-page-container {
        display: flex;
        flex-wrap: wrap;
    }

    .flex-child {
        min-width: 200px;
    }
    </style>