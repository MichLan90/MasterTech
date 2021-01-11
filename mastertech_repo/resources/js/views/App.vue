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
            this.change()
            this.$router.push('/')
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

#navbarSupportedContent ul {
    width: 50%;
    justify-content: flex-end;
    margin: 0;
    display: flex;
    padding: 0;
    background-color: white;
}

.nav-link {
    width: 20%;
    height: 20px;
    text-align: center;
    color: black;
    padding: 10px;
    list-style: none;
}

.nav-link:hover {
    color: white;
    background-color: #0c2a35;
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
</style>
