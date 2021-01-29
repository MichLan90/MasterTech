<template>
        <div class="row dashboard">
        <h2>Översikt:</h2>
            <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
                <p>Produkter: ({{products.length}})</p>
            </div>
            <div class="col-md-4 product-box d-flex align-content-center justify-content-center flex-wrap big-text">
                <p>Registrerade användare: ({{users.length}})</p>
            </div>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                user : null,
                orders : [],
                products : [],
                users : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/products/').then(response => this.products = response.data)
        }
    }
    </script>

    <style scoped>
    .dashboard {
        margin: 30px;
    }
    </style>