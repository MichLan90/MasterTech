 <template>
        <div class="main-container-admin">
            <table>
                <thead>
                    <tr>
                        <td></td>
                        <td>Produkt</td>
                        <td>Antal</td>
                        <td>Pris</td>
                        <td>Levereras till</td>
                        <td>Leveranstatus</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(order,index) in orders" @key="index">
                        <td>{{index+1}}</td>
                        <td v-html="order.product.name"></td>
                        <td>{{order.quantity}}</td>
                        <td>{{order.quantity * order.product.price}}</td>
                        <td>{{order.address}}</td>
                        <td>{{order.is_delivered == 1? "Levererad" : "Ej levererad"}}</td>
                        <td v-if="order.is_delivered == 0"><button class="btn btn-success" @click="deliver(index)">Skicka</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                orders : []
            }
        },
        beforeMount(){
            axios.get('/api/orders/').then(response => this.orders = response.data)
        },
        methods: {
            deliver(index) {
                let order = this.orders[index]
                axios.patch(`/api/orders/${order.id}/deliver`).then(response => {
                    this.orders[index].is_delivered = 1
                    this.$forceUpdate()
                })
            }
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