  <template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">MasterTech</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 product-box" v-for="(product,index) in products" @key="index" v-bind:key="product">
                                <router-link :to="{ path: '/products/'+product.id}">
                                    <img :src="product.image" :alt="product.name">
                                    <h5><span v-html="product.name"></span>
                                        <span class="small-text text-muted float-right">$ {{product.price}}</span>
                                    </h5>
                                    <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                                </router-link>
                            </div>
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
                    products : []
                }
            },
            mounted(){
                axios.get("api/products/").then(response => this.products = response.data)      
            }
        }
    </script>
    <style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');

    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: fit-content;
        align-items: center;
    }
    .title {
        font-family: 'Roboto', sans-serif;
        font-size: 60px;
    }

    .row {
        display: flex;
        width: 100%;
        flex-wrap: wrap;
    }
    </style>