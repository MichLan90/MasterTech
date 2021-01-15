<template>
        <div class="container main-cont">
            <div class="row prod-img-name-container">
                        <h2 style="text-align: center; font-size: 24px;">Sammanfattning av din beställning</h2>

                        <div class="main-cont-all">
                            <div class="product-container titles" v-if="cartLength">                      
                                <div class="prod-child name"><b>Namn</b></div>
                                <div class="prod-child qnt"><b>Antal</b></div>
                                <div class="prod-child price"><b>Tot Pris</b></div>                              
                            </div>
                            <div class="product-container" v-if="cartLength" v-for="product in orderArray">                             
                                <div class="prod-child name">{{product.product_name}}</div>
                                <div class="prod-child qnt">{{product.quantity}}</div>
                                <div class="prod-child price">{{product.product_price * product.quantity}}</div>                                                              
                            </div>

                            <div class="product-container titles" v-if="cartLength">
                                <div>Totalt: FUNCTION TODO</div>
                            </div>
                            <br><br>
                            <div class="other-container" v-if="cartLength">
                                <h2 style="text-align: center; font-size: 24px;">Leveransalternativ</h2>
                                 <p>Välj en alternativ:</p>
                                    <input type="radio" id="ship-option1" name="shipping" value="option1">
                                    <label for="ship-option1">Option 1</label><br>
                                    <input type="radio" id="ship-option2" name="shipping" value="option2">
                                    <label for="ship-option2">Option 2</label><br>
                                    <input type="radio" id="ship-option3" name="shipping" value="option3">
                                    <label for="ship-option3">Option 3</label><br>   
                            </div>
                            <br><br>
                            <div class="other-container" v-if="cartLength">
                                <h2 style="text-align: center; font-size: 24px;">Betalningalternativ</h2>
                                 <p>Välj en alternativ:</p>
                                    <input type="radio" id="card" name="payment" value="option1">
                                    <label for="card">Kort</label><br>
                                    <input type="radio" id="swish" name="payment" value="option2">
                                    <label for="swish">Swish</label><br>
                                    <input type="radio" id="cash" name="payment" value="option3">
                                    <label for="cash">Kontakt vid leverans</label><br>   
                            </div>
                            </div>
                            <br><br>
                            <div class="proceed" v-if="cartLength">
                                <router-link :to="{ path: '/confirmation' }" v-if="cartLength">Bekräfta</router-link>
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
        }
    }
    </script>

    <style scoped>
    .main-cont-all {
        width: 100%;
    }

    .product-container {
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        border-bottom: 1px solid black;
        width: 70%;
        justify-content: center;
    }

    .other-container {
        margin: 0 auto;        
        border-bottom: 1px solid black;
        width: 70%;
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
        font-size: 14px;
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