<template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div><img src="https://img.icons8.com/ios-filled/50/000000/user-male-circle.png"/></div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Lösenord</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" v-model="password" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary button-style" @click="handleSubmit">
                                            Login
                                        </button>
                                        <div id="errormsg"><p id="errtext" style="font-size: 14px; margin-top: 30px;"></p></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
      <script>
        export default {
            data() {
                return {
                    email: "",
                    password: ""
                }
            },
            methods: {
                handleSubmit(e) {
                    e.preventDefault()
                    if (this.password.length > 0 && this.email.length > 0) {
                        let email = this.email
                        let password = this.password

                        axios.post('api/login', {email, password}).then(response => {
                            console.log(response)
                            
                                let user = response.data.user
                                let is_admin = user.is_admin 

                                localStorage.setItem('bigStore.user', JSON.stringify(user))
                                localStorage.setItem('bigStore.jwt', response.data.token)

                                    if (localStorage.getItem('bigStore.jwt') != null) {
                                        this.$emit('loggedIn')
                                        if (this.$route.params.nextUrl != null) { 
                                            this.$router.push(this.$route.params.nextUrl)
                                        } else { 
                                            this.$router.push((is_admin == 1 ? 'admin' : '/'))
                                        }
                                    }                           
                        });
                    } else {
                        let p = document.getElementById('errtext')
                        p.innerText = "Vänligen fyll i ditt email och lösenord"
                    }
                }
            }
        }
    </script>

    <style>
    .card {
        width: 100%;
        height: 450px;
        text-align: center;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: 0 auto;
        background-color: #0c2a35;
        color: white;
        padding-top: 45px;
    }

    .form-group {
        margin-top: 20px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .col-md-8 {
        margin-bottom: 150px;
    }

    .button-style {
        border: none;
        background-color: black;
        color: white;
        width: 100px;
        height: 50px;
        border-radius: 10px;
    }

    .button-style:hover {
        transition: 0.4s all cubic-bezier(0.445, 0.05, 0.55, 0.95);
        background-color: white;
        color: black;
    }

    .button-style:active {
        font-size: 10px;
    }

    input {
        border-radius: 5px;
    }
    </style>