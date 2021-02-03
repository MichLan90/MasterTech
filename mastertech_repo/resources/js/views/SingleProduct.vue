<template>

        <div class="container main-cont">

            <div class="row prod-img-name-container">

                    <img :src="product.image" :alt="product.name" class="single-img">
                    <div class="title-descr">
                        <h3 class="title" v-html="product.name"></h3>
                        <p class="text-muted">{{product.description}}</p>
                        <span class="info small-text text-muted float-left"><b>Pris</b>: {{product.price}} SEK</span><br>
                        <span class="info small-text float-right"><b>Lagerstatus</b>: {{product.units}}</span>
                        <p class="small-text text-muted">Antal:
                            <input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="quantity" @change="checkUnits">
                        </p>
                        <hr>
                        <div style="margin: 20px 0 20px 0; text-align: right;">
                            <div v-if="!isLoggedIn" style="text-align: center; font-size: 14px; color: red;"><p>Du behöver vara inloggad för att köpa produkten.</p></div>
                            <!--<router-link :to="{ path: '/checkout?pid='+product.id }" v-if="isLoggedIn" class="button-style col-md-4 btn btn-sm btn-primary float-right">Lägg i kundvagnen</router-link>-->
                            <button class="button-style" v-if="isLoggedIn" @click="addToCart">Lägg till kundvagn</button>
                        </div>
                    </div>
                    
            </div>
        </div>
    </template>

    <script>
    export default {
        data(){
             return {
                address : "",
                quantity : 1,
                isLoggedIn : null,
                product : []
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
        },
        beforeMount(){
            let url = `/api/products/${this.$route.params.id}`
            axios.get(url).then(response => this.product = response.data)      
        },
        methods : {
            login() {
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            },
            register() {
                this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
            },
            checkUnits(e){
                if (this.quantity > this.product.units) {
                    this.quantity = this.product.units
                }
            },
            addToCart(e) {
                //e.preventDefault()
                let orderArray = [];
                let singleOrder = {
                    product_name: this.product.name,
                    product_id: this.product.id,
                    quantity: this.quantity,
                    product_price: this.product.price,
                    product_img : this.product.image,
                    product_api : this.product.api
                }

                if(!localStorage.getItem('bigStore.cart')) {
                    orderArray.push(singleOrder);
                    localStorage.setItem('bigStore.cart', JSON.stringify(orderArray));
                } else {
                    orderArray = JSON.parse(localStorage.getItem('bigStore.cart'));
                    orderArray.push(singleOrder);
                    localStorage.setItem('bigStore.cart', JSON.stringify(orderArray));
                }
                window.alert("Produkten har lagts till.");
                location.reload();
            },
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

@media only screen and (max-width: 768px) {
    .single-img {
        object-fit: contain;
    }
}
    </style>