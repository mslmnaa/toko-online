@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-auto">
        </div>
        <div class="w-full md:w-1/2 md:pl-8">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-xl mb-4">${{ number_format($product->price, 2) }}</p>
            <p class="mb-4">{{ $product->description }}</p>
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection