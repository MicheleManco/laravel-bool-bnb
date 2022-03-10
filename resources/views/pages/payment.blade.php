@extends('layouts.main-layout')

@section('content')


<div id="payment-container">
        <h2>Completa il pagamento per la sponsorizzazione</h2>
        <div id="dropin-container"></div>
        <button id="submit-button">Sponsorizza</button>
    </div>
 
@endsection

@section('scripts')
    <script type="text/javascript">
        function callRoute(instance) {
            instance.requestPaymentMethod(function(err, payload) {
                const idsFromUrl = window.location.pathname.split("/sponsor/store/").pop();
                const endpoint = `/payment/store/${idsFromUrl}`;

                fetch(endpoint, {
                    method: 'POST',
                    data: {'paymentMethodNonce': payload.nonce},
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="_token"]').content
                    }
                }).then(data => {                
                    document.location.href = '/';
                }).catch(err => {
                    console.log('error: ', err);
                })
            });
        }

        braintree.dropin.create({
            authorization: 'sandbox_7bnqq2q7_pyrgtjvdzbsc6q9x',
            selector: '#dropin-container',
            // see https://developer.paypal.com/braintree/articles/control-panel/important-gateway-credentials#api-credentials
            // paypal: {
            //     flow: 'checkout',
            //     amount: '10.00',
            //     currency: 'USD'
            // },
            // paypalCredit: {
            //     flow: 'checkout',
            //     amount: '10.00',
            //     currency: 'USD'
            // },
            // applePay: {
            //     displayName: 'Merchant Name',
            //     paymentRequest: {
            //         label: 'Localized Name',
            //         total: '10.00'
            //     }
            // },
        }, function(err, instance) {
            document.querySelector('#submit-button').addEventListener('click', () => callRoute(instance))
        });
    </script>
@endsection
