<template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Mina beställningar</h2>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <div class="row ub-container">
                            <div class="col-md-4 product-box ub-productb" v-for="(order,index) in orders" @key="index">
                                <img :src="order.product.image" :alt="order.product.name" class="ub-img">
                                <h5><span v-html="order.product.name" class="ub-title"></span><br>
                                    <span class="small-text text-muted ub-price">{{order.product.price}} sek</span>
                                </h5>
                                <hr>
                                <span class="ub-quant"><b>Antal</b>: {{order.quantity}}
                                    <p class="ub-delivery"><strong>Adress:</strong> <br>{{order.address}}</p>
                                </span>
                                <span class="float-right ub-quant"><b>Leveransstatus:</b><br> {{order.is_delivered == 1? "Levererad" : "Ej levererad"}}</span>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Potta+One&display=swap');
    .ub-container {
        border: 1px solid black;
        margin: 20px;
    }

    .ub-productb {
        padding: 15px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        border-bottom: 1px solid black;
    }

    .ub-img {
        width: 80px;
    }

    .ub-title, .ub-price {
        padding: 15px;
        min-width: 150px;
    }

    .ub-quant {
        font-size: 12px;
           min-width: 150px;
    }

    .title {
        font-family: 'Roboto', sans-serif;
        font-size: 30px;
        text-align: center;
    }

    span {
        padding: 10px;
    }

    </style>
     <script>
    export default {
        data() {
            return {
                user : null,
                orders : []
            }
        },
        beforeMount() {
            this.user = JSON.parse(localStorage.getItem('bigStore.user'))

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')

            axios.get(`api/users/${this.user.id}/orders`)
                 .then(response => this.orders = response.data)
        }
    }
    </script>