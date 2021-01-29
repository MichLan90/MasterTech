 <template>
        <div class="main-container-admin">
            <table>
                <thead>
                    <tr>
                        <td></td>
                        <td>Namn</td>
                        <td>E-post</td>
                        <td>Användare skapades</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user,index) in users" @key="index">
                        <td>{{index+1}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.created_at}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                users : []
            }
        },
        beforeMount() {
            axios.get('/api/users/').then(response => this.users = response.data)
        }
    }
    </script>

      <style scoped>
    .main-container-admin {
        display: flex; 
        justify-content: center;
    }

    td {
        padding: 10px;
        border: solid 1px black;
    }

    thead td {
        font-weight: bold;
    }
    </style>