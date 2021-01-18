 <template>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot name="header" v-html="data.name"></slot>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            Namn: <br><input type="text" v-model="data.name"><br>
                            Antal: <br><input type="text" v-model="data.units"><br>
                            Pris: <br><input type="text" v-model="data.price"><br>
                            Beskrivning: <br><textarea v-model="data.description" placeholder="description"></textarea><br>
                            <span style="width:280px">Ladd upp en bild:<br>
                                <img :src="data.image" v-show="data.image != null" style="width: 100%"><br>
                                <input type="file" id="file" @change="attachFile"><br>
                            </span>
                        </slot>
                        <slot name="footer">
                            <button class="modal-default-button" @click="uploadFile">
                                Bekräfta
                            </button>
                        </slot>
                    </div>
                    <!--<div class="modal-footer">
                        <slot name="footer">
                            <button style="border: none; background-color: white; font-size: 18px;" class="modal-default-button" @click="uploadFile">
                                Bekräfta
                            </button>
                        </slot>
                    </div>-->
                </div>
            </div>
        </div>
    </template>

    <style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 300px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
        border: none; 
        background-color: #EAEAEA; 
        font-size: 14px;
        padding: 5px;
    }
    .modal-default-button:hover {
        background-color: #CECECE;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    </style>
      <script>
    export default {
        props: ['product'],
        data() {
            return {
                attachment: null
            }
        },
        computed: {
            data: function() {
                if (this.product != null) {
                    return this.product
                }
                return {
                    name: "",
                    units: "",
                    price: "",
                    description: "",
                    category: "",
                    image: false
                }
            }
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            uploadFile(event) {
                if (this.attachment != null) {
                    var formData = new FormData();
                    formData.append("image", this.attachment)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file", formData, {headers}).then(response => {
                        this.product.image = response.data
                        this.$emit('close', this.product)
                    })
                } else {
                    this.$emit('close', this.product)
                }
            }
        }
    }
    </script>