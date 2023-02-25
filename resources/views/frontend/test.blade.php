@foreach ($result as $item)
    {{-- @php
        $products = App\Models\Product::where('category_id',$item->id)->limit(5)->get();
    @endphp --}}
        <li>{{$item->name}}</li>
    @foreach ($item->product->take(2) as $product)
        <li>{{$product->product_name}}</li>
    @endforeach
@endforeach
