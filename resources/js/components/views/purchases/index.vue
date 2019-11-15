<template>

    <div class="container">
        <div style="display: flex; justify-content: space-between;">
            <h4 class="mb-4">Purchases</h4>
            <div>
                <a class="btn btn-primary" href="/purchases/create">Create</a>
            </div>
        </div>

        <div>
            <div class="card my-2" v-for="purchase in purchases">
                <div class="card-header">
                    Purchase #{{ purchase.id }} for {{ purchase.offering.title }}
                </div>
                <div class="card-body">
                    <p>Quantity: {{ purchase.quantity }}</p>
                    <p>Unit price: {{ purchase.offering.price }}</p>
                    <p>Total: {{ purchase.total }}</p>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: 'purchases',
        components: {},
        data() {
            return {
                purchases: []
            }
        },
        created() {
            this.initData()
        },
        methods: {
            initData() {
                return axios
                    .get('/purchases')
                    .then(response => {
                        this.purchases = response.data
                    })
                    .catch(response => {
                        console.error(response)
                    })
            }
        }
    }
</script>
