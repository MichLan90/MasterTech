  <template>
        <div>
            <div class="container">
                <div class="rea">
                    <marquee direction="left" height="28" width="100%" bgcolor="black">
                    Mellandagsrea 2020 - Mellandagsrea har för många blivit en lika självklar tradition precis som julhandeln. 
                    Det gäller givetvis även för oss på MasterTech. På vår mellandagsrea kan du runda av 
                    året med att köpa det där som du verkligen ville ha men kanske inte fick i jul.
                    </marquee>
                </div>
              <img src="https://nextshop.pk/wp-content/uploads/2018/08/New-Refurbished-Banner.jpg" class="banner" alt="tech-banner" border="0">
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Våra produkter</h2>
                <hr>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 product-box" v-for="(product,index) in products" @key="index" v-bind:key="product">
                                <div class="product-info-container">
                                  <router-link :to="{ path: '/products/'+product.id}">
                                    <div class="prod-img-container">
                                    <img :src="product.image" :alt="product.name" class="product-img">
                                    </div>
                                    <h5><span v-html="product.name"></span>
                                        <span class="small-text text-muted float-right">{{product.price}} SEK</span>
                                    </h5>
                                    <button class="col-md-4 btn btn-sm btn-primary float-right buynow">Visa mer >>></button>
                                 </router-link>
                                </div>
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
    @import url('https://fonts.googleapis.com/css2?family=Potta+One&display=swap');
    
    a {
        text-decoration: none;
    }

    .small-text {
        font-size: 14px;
    }

    .prod-img-container {
        width: 300px;
        height: fit-content;
        margin: 0 auto;
    }

    .product-img {
        width: 100%;
        object-fit: contain;
        transition: transform .2s; 
    }

    .product-img:hover {
        transform: scale(1.1);
    }

    .hero-section {
        height: fit-content;
        align-items: center;
    }
    .title {
        font-family: 'Roboto', sans-serif;
        font-size: 30px;
        text-align: center;
    }

    .col-md-12 {
        padding-left: 5vw;
        padding-right: 5vw;
    }

    .row {
        display: flex;
        width: 100%;
        justify-content: space-between;
        flex-wrap: wrap;
        font-family: 'Roboto', sans-serif;
    }

    .banner {
        width: 100%;
    }
    
    .product-box {
        min-width: 350px;
        height: 650px;
        display: flex;
        align-items: center;
        margin: 25px;
    }

    .product-box h5 {
        width: 100%;
        margin: 0;
        color: black;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        font-size: 16px;
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .product-box h5 span {
        text-decoration: none;
        font-size: 16px;
        padding: 5px;
    }

    .product-info-container {
        width: 100%;
        height: 100%;
    }

    .product-info-container a {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        height: 100%;

    }


    .buynow {
        width: 100%;
        border: none;
        height: 5vh;
        background-color: #0c2a35;
        color: white;
        font-weight: 300;
        transition: transform .2s; 
    }

    .buynow:hover {
        transition: scale(1.2);
        cursor: pointer;
    }

    .rea {
        background-color: black;
        color:white;
        font-family: 'Roboto', sans-serif;
        font-size: 24px;
        text-align: center;

    }

    .cat-container {
        background-color: black;
        color: white;
        display: flex;
        align-items: center;
    }

    .category-menu {
        text-align: center;
        width: 13%;
        padding: 15px;
        border-right: 1px solid white;
    }

    @media only screen and (max-width: 768px) {
        .product-box {
            width: 350px;
            height: fit-content;
            display: flex;
            align-items: center;
            margin: 25px;
        }
        .row {
            justify-content: center;
        }
        .col-md-12 {
            padding: 0;
        }
    }

    @media only screen and (max-width: 412px) {
      .product-box {
            margin: 20px 0 20px 0;
        }
}


    </style>