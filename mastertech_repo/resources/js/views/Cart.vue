<template>
        <div class="container main-cont">
            <div class="row prod-img-name-container">
                        <h2 style="text-align: center; font-size: 24px;">Kundvagn</h2>

                        <div>
                            <div class="product-container titles" v-if="cartLength">
                                <div class="img"></div>
                                <div class="prod-child name"><b>Namn</b></div>
                                <div class="prod-child qnt"><b>Antal</b></div>
                                <div class="prod-child price"><b>Tot Pris</b></div>                              
                            </div>
                            <div class="product-container" v-if="cartLength" v-for="product in orderArray">
                                <img :src="product.product_img" class="img">
                                <div class="prod-child name">{{product.product_name}}</div>
                                <div class="prod-child qnt">{{product.quantity}}</div>
                                <div class="prod-child price">{{product.product_price * product.quantity}}</div>  
                                <button @click="removeProduct(product)" class="removebtn"> Ta bort </button>                            
                            </div>
                            <div class="proceed" v-if="cartLength">
                                <router-link :to="{ path: '/checkingout' }" v-if="cartLength">Gå till betalning och leverans</router-link>
                            </div>
                            <div class="product-container" style="justify-content: center;" v-if="!cartLength">
                                Inga produkter hittades.
                            </div>
                        </div>
            </div>
        </div>
    </template>

 <script>
    export default {
        data(){
             return {
                cartLength: JSON.parse(localStorage.getItem('bigStore.cart')).length,
                orderArray : JSON.parse(localStorage.getItem('bigStore.cart')),
                isLoggedIn : null,
                product : [],
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
        },
        beforeMount(){
            this.showCart();
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
            showCart(e) {
                e.preventDefault()
                let orderArray = JSON.parse(localStorage.getItem('bigStore.cart'));
            },
            removeProduct(product) {
                let orderArray = JSON.parse(localStorage.getItem('bigStore.cart'));                
                this.orderArray.splice(this.orderArray.indexOf(product), 1);
                  for(let i = 0; i < orderArray.length; i++) {                    
                        orderArray.splice(i, 1) 
                        let newOrderArray = orderArray
                        localStorage.setItem("bigStore.cart", JSON.stringify(newOrderArray));
                        if (newOrderArray.length < 1) {
                            location.reload();
                        }
                        
                        return newOrderArray
                  }
                
                console.log(orderArray) 
            }
        }
    }
    </script>

    <style scoped>
    .product-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        border-bottom: 1px solid black;
    }

    .prod-child {
        width: 20%;
        padding: 10px;
    }

    .img {
        width:10%;
        margin: 10px;
    }

    .titles {
        background-color:#EAEAEA;
    }

    .removebtn {
        background-color: red;
        border: black 1px solid;
        width: 80px;
        height: 40px;
    }

    .proceed {
        text-align: center;
        width: 100%;
        height: 2vh;
        margin-top: 20px;
    }

    .proceed a {
        text-decoration: none;
        color: black;
        padding: 10px;
        background-color: #EAEAEA;
        border-radius: 10px;
    }

    .proceed a:hover {
        transition: 0.4s all cubic-bezier(0.445, 0.05, 0.55, 0.95);
        color: white;
        background-color: #0c2a35;
    }
    </style>