  <template>
    <div>
        <div class="main-container-admin">
            <table>
                <thead>
                    <tr>
                        <td></td>
                        <td>Produkt</td>
                        <td>Antal</td>
                        <td>Pris</td>
                        <td>Beskrivning</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product,index) in products" @key="index" @dblclick="editingItem = product">
                        <td>{{index+1}}</td>
                        <td v-html="product.name"></td>
                        <td v-model="product.units">{{product.units}}</td>
                        <td v-model="product.price">{{product.price}}</td>
                        <td v-model="product.description">{{product.description}}</td>
                        <td> <button @click="editingItem = product">Ändra</button></td>
                    </tr>
                </tbody>
            </table>
            <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
            <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
            <br>
        </div>
        <div style="width: 100%; text-align: center;">
            <button class="btn-admin btn-primary" @click="newProduct">Lägg till en produkt</button>
        </div>
    </div>
    </template>
    <script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                products: [],
                editingItem: null,
                addingProduct: null
            }
        },
        components: {Modal},
        beforeMount() {
            axios.get('/api/products/').then(response => this.products = response.data)
        },
        methods: {
            newProduct() {
                this.addingProduct = {
                    name: null,
                    units: null,
                    price: null,
                    image: null,
                    description: null,
                    category: null,
                }
            },
            endEditing(product) {
                this.editingItem = null

                let index = this.products.indexOf(product)
                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let category = product.category

                axios.put(`/api/products/${product.id}`, {name, units, price, description, category})
                     .then(response => this.products[index] = product)
            },
            addProduct(product) {
                this.addingProduct = null

                let name = product.name
                let units = product.units
                let price = product.price
                let description = product.description
                let image = product.image 
                let category = product.category

                axios.post("/api/products/", {name, units, price, description, category, image})
                     .then(response => this.products.push(product))
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

    
    .btn-admin {
        margin: 10px;
        border: none;
        background-color: #EAEAEA;
        width: 150px;
        padding: 10px;
    }

    .btn-admin:hover {
         background-color: #CECECE;
    }
    </style>