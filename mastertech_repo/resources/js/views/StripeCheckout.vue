<template>
  <!-- stripe-checkout -->
  <div>
    <stripe-checkout
      ref="checkoutRef"
      mode="payment"
      :pk="publishableKey"
      :line-items="lineItems"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />
    <button @click="submit">Pay now!</button>
  </div>
</template>

<script>
import { StripeCheckout } from '@vue-stripe/vue-stripe';
export default {
  components: {
    StripeCheckout,
  },
  data () {
    this.publishableKey = 'pk_test_51HMTldKEUIKsCRFh6xC4GVU96lW0bbRsLDsYszzZEJUwLsSgNK3pOYv1RLWfBHHkVHONcNQdtJkB6mhXvQBkmdxw00nd03I4rP';
    let orderArray = JSON.parse(localStorage.getItem('bigStore.cart'));
    let formattedProducts = orderArray.map((product) => {
            return {
                price: product.product_api, // The id of the one-time price you created in your Stripe dashboard
                quantity: product.quantity,
            }
            
        })
    return {
      loading: false,
      lineItems: formattedProducts,
      successURL: 'http://localhost:8000/confirmation',
      cancelURL: 'https://google.se',
    };
  },
    methods: {
        // You will be redirected to Stripe's secure checkout page
     submit () {
         this.$refs.checkoutRef.redirectToCheckout();
    },  
    },
};


</script>