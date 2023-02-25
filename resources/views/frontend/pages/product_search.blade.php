@forelse ($products as $product)
    <p>
        <a href="{{Route('product.details',[$product->product_sku,$product->id,$product->product_slug])}}?category={{$product->category->slug}}&subcategory={{$product->subcategory->slug}}&subsubcategory={{$product->subsubcategory->slug}}" target="_blank">
            {!! Str::limit($product->product_name,50) !!}
        </a>
    </p>    
@empty
    <p>No data found</p>
@endforelse