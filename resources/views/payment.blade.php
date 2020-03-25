@extends('layouts.app')
@section('content')
<script
    src="https://www.paypal.com/sdk/js?client-id=ASnMVy-Y7Lkt77djzs2A-MeMcyNbL2Lalap0Z4mZuq0o3YK2lCRlpnrP3SOFPT2BvIirMbNpB-masXdy"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            purchase_units: [{
            amount: {
                value: 
            }
            }]
        });
        },
        onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            alert('Transaction completed by ' + details.payer.name.given_name);
        });
        }
    }).render('#paypal-button-container');
    //This function displays Smart Payment Buttons on your web page.
</script>
@endsection