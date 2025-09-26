@extends('admin.app.layout')

@section('body')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Summary -->
        <div class="col-md-5">
            <div class="card shadow-sm p-3">
                <h4 class="mb-3">Payment Summary</h4>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Plan</td>
                            <td>Writer Post Access</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>$5.00</td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="text-end">Total:
                    <strong>$5.00</strong>
                </h5>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="col-md-7">
            <div class="card shadow-sm p-4">
                <h4 class="mb-3">Payment</h4>
                <div id="payment-message" style="display: none" class="alert alert-info"></div>

                <form id="payment-form" method="POST">
                    @csrf
                    <div id="payment-element"></div>
                    <button id="submit" class="btn btn-primary mt-3 w-100">
                        <span id="button-text">Pay $5.00</span>
                        <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            style="display:none"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.publishable_key') }}");
    let elements;

    initialize();

    async function initialize() {
        const response = await fetch("{{ route('stripe.paymentIntent.create') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: "{{ csrf_token() }}"
            })
        });

        const { clientSecret } = await response.json();

        elements = stripe.elements({ clientSecret });
        const paymentElement = elements.create("payment");
        paymentElement.mount("#payment-element");
    }

    document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);

        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: "{{ route('stripe.return') }}",
            },
        });

        if (error) {
            showMessage(error.message);
            setLoading(false);
        }
    }

    function showMessage(messageText) {
        const messageContainer = document.querySelector("#payment-message");
        messageContainer.style.display = "block";
        messageContainer.textContent = messageText;

        setTimeout(() => {
            messageContainer.style.display = "none";
            messageContainer.textContent = "";
        }, 5000);
    }

    function setLoading(isLoading) {
        if (isLoading) {
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").style.display = "inline-block";
            document.querySelector("#button-text").style.display = "none";
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").style.display = "none";
            document.querySelector("#button-text").style.display = "inline-block";
        }
    }
</script>
@endsection
