<template>

    <div class="container">
        <div style="display: flex; justify-content: space-between;">
            <h4 class="mb-4">Create Purchase</h4>
            <div>
                <a class="btn btn-primary" href="/purchases">Purchases</a>
            </div>
        </div>

        <div v-if="message" class="card my-2" :class="message.type === 'error' ? 'bg-danger' : 'bg-success'">
            <div class="card-header">
                <div v-for="msg in message.data" style="color: #ddd">
                    {{ msg[0] }}
                </div>
            </div>
        </div>

        <form>
            <div class="form-group">
                <label for="offering">Offering</label>
                <select id="offering" class="form-control" v-model="purchase.offering_id">
                    <option v-for="offering in offerings" :value="offering.id">
                        {{ offering.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="customer">Customer name</label>
                <input type="text" class="form-control" v-model="purchase.customer_name" id="customer">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" min="0" class="form-control" v-model.number="purchase.quantity" id="quantity">
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input class="form-control" type="text" :placeholder="total" readonly id="total">
            </div>

            <button type="button" class="btn btn-success" @click="save">
                Create
            </button>
        </form>
    </div>

</template>

<script>
    export default {
        name: 'create-purchase-form',
        components: {},
        data() {
            return {
                purchase: {},
                offerings: [],
                message: null
            }
        },
        created() {
            this.initData()
        },
        computed: {
            total() {
                if (this.purchase.offering_id === null) {
                    return 0
                }
                if (!this.purchase.quantity) {
                    return 0
                }
                if (!this.offerings.some(o => o.id === this.purchase.offering_id)) {
                    return 0
                }

                return this.offerings.find(o => o.id === this.purchase.offering_id).price * Number(this.purchase.quantity);
            }
        },
        methods: {
            initData() {
                return axios
                    .get('/offerings')
                    .then(response => {
                        this.offerings = response.data;
                    })
                    .catch(response => {
                        console.error(response)
                    })
            },
            save() {
                this.message = null

                let data = _.cloneDeep(this.purchase)
                return axios
                    .post('/purchases', data)
                    .then(response => {
                        window.location.href = '/purchases'
                    })
                    .catch(response => {
                        this.message = {
                            type: 'error',
                            data: response.response.data.errors
                        }
                        // this.message = response.data.join('<br>')
                    })
            }
        }
    }
</script>
