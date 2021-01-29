<template>
        <div class="container main-cont">
            <div class="row prod-img-name-container">
                        <h2 style="text-align: center; font-size: 24px;">Sammanfattning av din beställning</h2>

                        <div class="main-cont-all">
            <!-- KUNDVAGNEN -->
                            <div class="product-container titles" v-if="cartLength">                      
                                <div class="prod-child name"><b>Namn</b></div>
                                <div class="prod-child qnt"><b>Antal</b></div>
                                <div class="prod-child price"><b>Tot Pris</b></div>                              
                            </div>
                            <div class="product-container" v-if="cartLength" v-for="product in orderArray">                             
                                <div class="prod-child name">{{product.product_name}}</div>
                                <div class="prod-child qnt">{{product.quantity}}</div>
                                <div class="prod-child price">{{product.product_price * product.quantity}} :-</div>                                                              
                            </div>

                            <div class="product-container titles" v-if="cartLength" style="justify-content: flex-end">
                                <div v-ref="totPrice" class="totprice">Totalt: {{totPrice}} SEK</div>
                            </div>
                            <br><br>
            <!-- LEVERANS -->
                            <div class="other-container delivery" v-if="cartLength">
                            <h2 style="text-align: center; font-size: 24px;">Leveransalternativ:</h2>
                                <select class="options-deliv" v-model="product.selectedCarrier">
                                    <option class="options-deliv" 
                                        v-bind:value="{name: carrier.name, price: carrier.price, time: carrier.time}" v-for="carrier in carriers">
                                        {{ carrier.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="product-container" v-if="cartLength" style="flex-direction: column; align-items: right;">
                                <div style="font-size: 15px;">Förväntad leveranstid: {{ product.selectedCarrier.time }}</div><br>
                                <div class="totprice big">Leveranspris: {{ product.selectedCarrier.price }} SEK</div>
                            </div>
            <!-- TOT. ATT BETALA -->
                            <div class="topay" v-if="cartLength">
                            <p>Tot. att betala: <b>{{ totPrice + product.selectedCarrier.price }} SEK</b></p>
                            </div>

            <!-- BETALNING -->
                            <br><br>
                            <div class="other-container" v-if="cartLength">
                                <h2 style="text-align: center; font-size: 24px;">Betalningalternativ</h2>
                                 <p>Välj en alternativ:</p>
                                    <router-link :to="{ name: 'stripeCheckout' }">
                                        <input type="radio" id="stripe" name="payment" value="option2">
                                        <label for="stripe">Stripe</label>
                                    </router-link><br>
                                    <input type="radio" id="cash" name="payment" value="option3">
                                    <label for="cash">Kontakt vid leverans</label><br>   
                            </div>
                            </div>
                            <br><br>
                            <div class="proceed" v-if="cartLength">
                                <router-link :to="{ name: 'confirmation' }">Bekräfta!</router-link>
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
                arrayOfOrders: [],
                totPrice : this.totalPrice(),
                product: {
                        selectedCarrier: {
                            name: 'PostNord',
                            price: 49,
                            time: '5-6 arbetsdagar'
                        }
                    },                   
                    carriers: [
                        {name: 'PostNord', price: 49, time: '5-6 arbetsdagar'},
                        {name: 'DHL', price: 79, time: '2-3 arbetsdagar'},
                        {name: 'Hämta i butik', price: 0, time: 'Vi förbereder ditt paket inom 2 timmar'}  
                    ]
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
        },
        beforeMount(){
            this.totalPrice();
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
            totalPrice() {
                let orderArray = JSON.parse(localStorage.getItem('bigStore.cart'));
                let totalPrice = 0;
                for (let i = 0; i < orderArray.length; i++) {
                    totalPrice = totalPrice + orderArray[i].product_price * orderArray[i].quantity             
                } 
                return totalPrice;
                let print = document.getElementById("totprice");
                print.innerText = totalPrice
            },
            placeOrder(e) {
                    e.preventDefault()
                    let product_id = this.product.id
                    let quantity = this.quantity
                    //remark these lines, change with storing to arrayOfOrders data instead of doing post request
                    axios.post('api/orders/', {quantity, product_id})
                            .then(response => this.$router.push('/confirmation'))

                    /*this.arrayOfOrders.push({
                        product_id:product_id,
                        quantity:quantity, 
                    });*/
            },
            postData(){
                let instance = this;
                axios.post('api/orders/', {
                    data:instance.arrayOfOrders
                }).then(response => this.$router.push('/confirmation'))
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

    .proceed button {
        text-decoration: none;
        color: black;
        padding: 10px;
        background-color: #EAEAEA;
        border-radius: 10px;
    }

    .proceed button:hover {
        transition: 0.4s all cubic-bezier(0.445, 0.05, 0.55, 0.95);
        color: white;
        background-color: #0c2a35;
    }

    .totprice {
        text-align: right;
        font-size: 18px;
        font-weight: bolder;
        padding-right: 20px;
    }


    .delivery {
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
    .options-deliv {
        padding: 10px;
        text-align: center;
        border-radius: 10px;
        font-size: 15px;
    }

    .topay {
        margin: 0 auto;
        margin-top: 50px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        width: 70%;
        justify-content: flex-end;
        font-size: 24px;
    }
    </style>