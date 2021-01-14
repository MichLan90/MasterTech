 <template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                <router-link :to="{name: 'home'}" class="navbar-brand">MasterTech.se</router-link>
                  <span v-if="isLoggedIn" class="isLoggedin">
                                <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 0"> Välkommen, {{name}}</router-link>
                                <router-link :to="{ name: 'admin' }" class="nav-link" v-if="user_type == 1"> Välkommen, {{name}}</router-link>
            
                            </span>
                   <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-link" v-if="isLoggedIn" style="display: flex; width: 15%; align-items: baseline;">
                                <router-link :to="{name: 'cart'}" style="color: white; width: 50px; display: flex; align-items:center:">
                                <img src="https://img.icons8.com/ios-glyphs/30/ffffff/buy--v2.png" style="width: 25px;"/>
                                
                                <span id="cartLength" style="width: 100px; text-align: left; margin-left: 5px;">0</span>
                                </router-link>
                                
                            </li>
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                            <li class="nav-link" v-if="isLoggedIn" @click="logout"> Logout</li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <router-view @loggedIn="change"></router-view>
            </main>


            <div class="pre-footer"><p><b>&copy; Ensar &amp; Michelle</b></p></div>
            <footer>

                <div class="column">
                    <h3>Om MasterTech</h3>
                    <hr>
                    <p>MasterTech erbjuder det senaste för gaming- och teknikentusiaster och säljer till privatpersoner 
                        och företag via Inet.se och butiker belägna i Stockholm, Göteborg och Malmö. <br>
                        På den här sidan hittar du allt du behöver veta om Inet och allt vi står för 
                        och längre ner på sidan hittar du vår historia.</p>
                </div>
                <div class="column">
                    <h3>Kontakt</h3>
                    <hr>
                    <p class="textbox-paragraph" itemprop="name">MasterTech AB.</p>
                    <p class="textbox-paragraph" itemprop="address">Stora Gatan 80, 422 35 Göteborg</p>
                    <p class="textbox-paragraph" itemprop="identifier" >Org.nr: 143 558 496</p>
                    <p class="textbox-paragraph" itemprop="email">E-post: <a href="mailto:mastertech@mail.se" class="textbox-contact">mastertech@mail.se </a></p>
                    <p class="textbox-paragraph" itemprop="telephone">Telefon: <a href="tel:+46 59 12 75 50" class="textbox-contact">+46 59 12 75 50</a></p>
                </div>
                <div class="column">
                    <h3>Sociala Medier</h3>
                    <hr>
                    <p>
                        <a href="https://www.facebook.com/">
                            <img src="https://cdn3.iconfinder.com/data/icons/glypho-social-and-other-logos/64/logo-facebook-512.png" style="width: 70px" class="social-link">
                        </a><br>
                        <a href="https://www.instagram.com/">
                            <img src="https://i0.wp.com/voxeuropae.com/wp-content/uploads/2019/02/SKq9yH-black-and-white-instagram-logo-png.png?fit=1200%2C1200&ssl=1&w=640" style="width: 70px" class="social-link">
                        </a>
                    </p>
                </div>
            </footer>

        </div>
    </template>
    <script>
export default {
    data() {
        return {
            name: null,
            user_type: 0,
            isLoggedIn: localStorage.getItem('bigStore.jwt') != null
        }
    },
    mounted() {
        this.setDefaults()
    },
    methods : {
        setDefaults() {
            if (this.isLoggedIn) {
                let user = JSON.parse(localStorage.getItem('bigStore.user'))
                this.name = user.name
                this.user_type = user.is_admin
            }
        },
        change() {
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
            this.setDefaults()
        },
        logout(){
            localStorage.removeItem('bigStore.jwt')
            localStorage.removeItem('bigStore.user')
            localStorage.removeItem('bigStore.cart')
            this.change()
            this.$router.push('/')
        },
        showItemsInCart() {
            localStorage.getItem('bigStore.cart')
             let showItemsNumber = document.getElementById('cartLength')
                 showItemsNumber.innerText = orderArray.length
        }
    }
}
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Potta+One&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');

.container {
    font-family: 'Roboto', sans-serif;
}

.isLoggedin a {
    color: white;
}

nav {
    width: 100%;
    background-color: black;
    color: white;
    margin: 0;
}

nav .container a {
    text-decoration: none;
    list-style: none;
}

#navbarSupportedContent {
    width: 100%;
    display: flex;
}

#cartLength {
    margin-bottom: 5px;
    font-size: 18px;
    margin-left: 10px;
}

#navbarSupportedContent .ml-auto {
    width: 50%;
    justify-content: flex-end;
    margin: 0;
    display: flex;
    padding: 0;
    color: white;
    background-color: #0c2a35;
}

#navbarSupportedContent .mr-auto {
    width: 50%;
    justify-content: flex-start;
    margin: 0;
    display: flex;
    padding: 0;
    color: white;
    background-color: #0c2a35;
}

.nav-link {
    width: 20%;
    height: 20px;
    text-align: center;
    color: white;
    padding: 10px;
    list-style: none;
}

.nav-link:hover {
    color: white;
    background-color: #3b6374;
    transition: 0.4s all cubic-bezier(0.445, 0.05, 0.55, 0.95);
    cursor: pointer;
}

.navbar-brand {
    font-family: 'Potta One', cursive;
    font-size: 24px;
    color: white;
    padding: 15px;
}

span {
    list-style: none;
}

.pre-footer { 
    text-align: center;
    font-family: 'Roboto', sans-serif;
    margin-top: 100px;
    background-color: #0c2a35;
    color: white;
    width: 100%;
    padding-top: 10px;
    padding-bottom: 10px;
}

footer {
    font-family: 'Roboto', sans-serif;
    background-color: #3b6374;
    color: #E6E6E6;
    width: 100%;
    height: fit-content;
    display: flex;
    justify-content: center;
    align-items: baseline;
    flex-direction: row;
    margin: 0;
}

.column {
    margin: 45px;
    width: 20%;
    height: fit-content;
}

.column a {
    color: white;
}

.social-link:hover {
    background-color: white;
}
</style>
