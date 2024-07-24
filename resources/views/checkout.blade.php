@extends('inc.layout')
@section('content')

<section class="enllor-courses-area pd-top-120 pd-bottom-140">
    <div class="container">
        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Left Column: Billing and Payment Information -->
                <div class="col-md-7">
                    <h2>Checkout</h2>
                    <div class="billing-address p-3 mb-3" style="background-color: #f9f9f9; border-radius: 5px;">
                        <h4>Billing address</h4>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="Vietnam">Vietnam</option>
                                <!-- Add other countries as needed -->
                            </select>
                        </div>
                        <small style="font-size: .6rem" class="text-sm">Udemy is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.</small>
                    </div>

                    <div class="payment-method p-3 mb-3" style="background-color: #f9f9f9; border-radius: 5px;">
                        <h4>Payment method</h4>
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <img src="https://i.gyazo.com/4914b35ab9381a3b5a1e7e998ee9550c.png" alt="VNPAY Logo" style="width: 40px; height: auto; margin-right: 15px;">
                                <div>
                                    <h5 style="font-size: 1rem" class="card-title">VNPAY</h5>
                                    <small class="card-text">Secure online payment via VNPAY</small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="payment_method" value="VNPAY">
                    </div>

                    <div class="order-details p-3 mb-3" style="background-color: #f9f9f9; border-radius: 5px;">
                        <h4>Order details</h4>
                        <div class="order-item d-flex align-items-center">
                            <img src="{{ asset('storage/' . $course->ImageURL) }}" alt="Course Image" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 15px;">
                            <div>
                                <p>{{ $course->Title }}</p>
                                <p>{{ number_format($course->Price, 2) }}$</p>
                            </div>
                        </div>
                        <input type="hidden" name="course_id" value="{{ $course->CourseID }}">
                        <input type="hidden" name="course_price" value="{{ $course->Price }}">
                    </div>
                </div>

                <!-- Right Column: Summary and Checkout Button -->
                <div class="col-md-5">
                    <h2>Summary</h2>
                    <div class="summary-item">
                        <p>Original Price:</p>
                        <p>{{ number_format($course->Price, 2) }}$</p>
                    </div>
                    <hr>
                    <div class="summary-item">
                        <p>Total:</p>
                        <p>{{ number_format($course->Price, 2) }}$</p>
                    </div>
                    <hr>
                    <p>By completing your purchase you agree to these Terms of Service.</p>
                    <button type="submit" class="btn btn-primary btn-block mb-3">Checkout</button>
                    <p class="money-back-guarantee">30-Day Money-Back Guarantee</p>
                </div>
                <style>
                    .billing-address, .payment-method, .order-details {
                        border: 1px solid #ddd;
                        border-radius: 5px;
                    }
                    .summary-item {
                        display: flex;
                        justify-content: space-between;
                    }
                    .money-back-guarantee {
                        font-style: italic;
                        color: #666;
                    }
                    hr {
                        border-top: 1px solid #ddd;
                    }
                </style>
            </div>
        </form>
    </div>
</section>

@endsection
