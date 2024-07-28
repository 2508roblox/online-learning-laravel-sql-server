@extends('inc.layout')
@section('content')

<!-- Breadcrumb Area Start-->
<section class="breadcrumb-area" style="background-color: #F9FAFD;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 align-self-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Learning</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Area End -->

<section class="enllor-courses-area pd-top-120 pd-bottom-140">
    <div class="container">
        <h2>Purchase History</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Payment Type</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentHistory as $payment)
                    <tr>
                        <td>{{ $payment->Title }}</td>
                        <td>{{ $payment->DateCreated }}</td>
                        <td>{{ $payment->TotalPrice }}</td>
                        <td>{{ $payment->PaymentMethod }}</td>
                        <td>{{ $payment->TotalDiscount ? $payment->TotalDiscount : 'No discount available' }}</td>
                        <td>{{ $payment->Status }}</td>
                        <td>
                            <a   class="btn btn-info">Receipt</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
