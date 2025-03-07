@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Database Cart Contents</h2>
    @if($cartItems->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->product->price * $item->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your database cart is empty.</p>
    @endif
</div>
@endsection