<template>

        <div class="container main-cont">

            <div class="row prod-img-name-container">

                    <img :src="product.image" :alt="product.name" class="single-img">
                    <div class="title-descr">
                        <h3 class="title" v-html="product.name"></h3>
                        <p class="text-muted">{{product.description}}</p>
                        <span class="info small-text text-muted float-left"><b>Pris</b>: {{product.price}} SEK</span><br>
                        <span class="info small-text float-right"><b>Lagerstatus</b>: {{product.units}}</span>
                        <hr>
                        <div style="margin: 20px 0 20px 0; text-align: right;">
                            <router-link :to="{ path: '/checkout?pid='+product.id }" class="button-style col-md-4 btn btn-sm btn-primary float-right">Köp</router-link>
                        </div>
                    </div>
                    
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

    .main-cont {
        width: 100%;
        height: fit-content;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 0 auto;
    }

    .prod-img-name-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
    }

    .single-img {
        min-width: 200px;
        margin: 30px;
    }

    .title-descr {
        width: 400px;
        padding: 25px;
    }

    .info {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .button-style {
        border: none;
        background-color: black;
        color: white;
        padding: 10px;
        border-radius: 10px;
        text-decoration: none;
    }

    .button-style:hover {
        border: 1px solid black;
        transition: 0.4s all cubic-bezier(0.445, 0.05, 0.55, 0.95);
        background-color: #0c2a31;
        color: white;
    }

    .button-style:active {
        font-size: 10px;
    }
    </style>