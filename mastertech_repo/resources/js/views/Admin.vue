  <template>
        <div>
            <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
                <h2 class="title">Admin Dashboard</h2>
                <hr>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <span class="option-container">
                            <div class="single-button">
                            <li><button class="btn-admin" @click="setComponent('main')">Dashboard</button></li>
                            </div>
                            <div class="single-button">
                            <li><button class="btn-admin" @click="setComponent('products')">Products</button></li>
                            </div>
                            <div class="single-button">
                            <li><button class="btn-admin" @click="setComponent('users')">Users</button></li>
                            </div>
                        </span><hr>
                    </div>
                    <div class="col-md-9">
                        <component :is="activeComponent"></component>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Products from '../components/admin/Products'

    export default {
        data() {
            return {
                user: null,
                activeComponent: null
            }
        },
        components: {
            Main, Users, Products
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('bigStore.  d fuser'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
    </script>

    <style scoped>
      .title {
        font-family: 'Roboto', sans-serif;
        font-size: 30px;
        text-align: center;
    }

    .option-container {
        list-style-type:none; 
        padding: 0; 
        display: flex;
        justify-content: center;
    }

    .btn-admin {
        border: none;
        background-color: white;
        width: 150px;
        transition: transform .2s; 
        padding: 10px;
    }

    .btn-admin:hover {
         transform: scale(1.2);
         background-color: #EAEAEA;
         color: black;
    }

     .btn-admin:active {
         background-color: grey;
    }

    .single-button {
        display: flex;
        width: 200px;
    }


    .hamburger-menu {
        width: 24px; 
        margin-left: 5px;

    }




    </style>