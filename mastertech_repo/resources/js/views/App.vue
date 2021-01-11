 <template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                <router-link :to="{name: 'home'}" class="navbar-brand">MasterTech</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                            <span v-if="isLoggedIn">
                                <router-link :to="{ name: 'userboard' }" class="nav-link" v-if="user_type == 0"> Hi, {{name}}</router-link>
                                <router-link :to="{ name: 'admin' }" class="nav-link" v-if="user_type == 1"> Hi, {{name}}</router-link>
                            </span>
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
nav {
    width: 100%;
    background-color: black;
    color: white;
    margin: 0;
}

nav .container a {
    text-decoration: none;
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
    background-color: #999999;
}

.nav-link {
    width: 20%;
    height: 20px;
    text-align: center;
    color: white;
    padding: 20px;
}

.nav-link:hover {
    color: grey;
    background-color: white;
}

.navbar-brand {
    font-family: 'Potta One', cursive;
    font-size: 24px;
    color: white;
    padding: 15px;
}
</style>
