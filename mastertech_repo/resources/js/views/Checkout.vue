<template>
        <div class="container main-cont">
            <div class="row prod-img-name-container">
                        <img :src="product.image" :alt="product.name" class="single-img">
                        <div class="title-descr">
                            <h2 class="title" v-html="product.name"></h2>
                            <p class="small-text text-muted"><b>Pris</b>: {{product.price}} SEK</p>
                            <p class="small-text text-muted"><b>Lagerstatus</b>: {{product.units}}</p>
                            <p class="small-text text-muted">Antal:
                            <input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="quantity" @change="checkUnits">
                            </p>
                            <div>
                                <div class="row">
                                    <label for="address" class="col-md-3 col-form-label">Delivery Address</label>
                                    <div class="col-md-9">
                                        <input id="address" type="text" class="form-control" v-model="address" required>
                                    </div>
                                </div>
                            <br>
                            <button class="col-md-4 btn btn-sm btn-success float-right"@click="placeOrder">Continue</button>

                        </div>

                                <br>
 
                    <br>


                   <!-- <div>
                        <div v-if="!isLoggedIn">
                            <h2>You need to login to continue</h2>
                            <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                            <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </template>

    <style scoped>
   .main-cont {
        width: 100%;
        height: fit-content;
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
    </style>
     <script>
    export default {
        props : ['pid'],
        data(){
            return {
                address : "",
                quantity : 1,
                isLoggedIn : null,
                product : [],
                arrayOfOrders:[]
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
        },
        beforeMount() {
            axios.get(`/api/products/${this.pid}`).then(response => this.product = response.data)

            if (localStorage.getItem('bigStore.jwt') != null) {
                this.user = JSON.parse(localStorage.getItem('bigStore.user'))
                axios.defaults.headers.common['Content-Type'] = 'application/json'
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
            }
        },
        methods : {
            login() {
                this.$router.push({name: 'login', params: {nextUrl: this.$route.fullPath}})
            },
            register() {
                this.$router.push({name: 'register', params: {nextUrl: this.$route.fullPath}})
            },
            placeOrder(e) {
                    e.preventDefault()

                    let address = this.address
                    let product_id = this.product.id
                    let quantity = this.quantity
                    //remark these lines, change with storing to arrayOfOrders data instead of doing post request
                    //axios.post('api/orders/', {address, quantity, product_id})
                            //.then(response => this.$router.push('/confirmation'))

                    this.arrayOfOrders.push({
                        product_id:product_id,
                        quantity:quantity, 
                        address:address
                    });
            },
                //create new function to make post request and call it from your button
                postData(){
                    let instance = this;
                    axios.post('api/orders/', {
                        data:instance.arrayOfOrders
                    }).then(response => this.$router.push('/confirmation'))
                }
            },
            checkUnits(e){
                if (this.quantity > this.product.units) {
                    this.quantity = this.product.units
                }
            }
        }
    </script>