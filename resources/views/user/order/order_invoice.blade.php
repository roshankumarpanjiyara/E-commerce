<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
        /*text-align: center;*/
        float: right
    }
    .authority h5 {
        margin-top: -10px;
        color: #3bb77e;
        /*text-align: center;*/
        margin-left: 35px;
    }
    .thanks p {
        color: #3bb77e;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
            <img src="{{public_path('logos/new-logo-bg.png')}}" alt="" width="200"/> 
            {{-- <h2 style="color: green; font-size: 26px;"><strong>Ecommerce</strong></h2> --}}
            </td>
            <td align="right">
                <pre class="font" >
                    Ecommerce Head Office
                    Email:support@ecommerce.com
                    Mob: 1245454545
                    Kolkata, West Bengal.
                </pre>
            </td>
        </tr>

    </table>


    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Name:</strong> {{ $order->name }}<br>
                    <strong>Email:</strong> {{ $order->email }} <br>
                    <strong>Phone:</strong> {{ $order->phone }} <br>
                    <strong>Address:</strong> {{$order->address}} <br>
                                                    {{$order->district->name}}- {{ $order->pincode->pincode }} <br>
                    <strong>State:</strong> {{ $order->state->name }}
                </p>
            </td>
            <td align="right">
                <p class="font">
                    <h3><span style="color: #3bb77e;">Invoice:</span> #{{ $order->invoice_no}}</h3>
                    <div>
                        Order Date: {{ $order->order_date }} <br>
                        Payment Type : {{ $order->payment_type }}
                    </div>
                </p>
            </td>
        </tr>
    </table>
    <br>
    <h3>Products</h3>


    <table width="100%">
        <thead style="background-color: #3bb77e; color:#FFFFFF;">
        <tr class="font">
            <th>Image</th>
            <th>Product Name</th>
            <th>Size</th>
            <th>Code</th>
            <th>Quantity</th>
            <th>Unit Price </th>
            <th>Total </th>
        </tr>
        </thead>
        <tbody>

            @foreach($orderItems as $item)
            <tr class="font">
                <td align="center">
                    <img src="{{public_path($item->product->product_thumbnail)}}" height="60px;" width="60px;" alt="">
                </td>
                <td align="center"> {{ $item->product->product_name }}</td>
                <td align="center">

                @if($item->size == NULL)
                ----
                @else
                    {{ $item->size }}
                @endif
                    
                </td>
                <td align="center">{{ $item->product->product_sku }}</td>
                <td align="center">{{ $item->qty }}</td>
                <td align="center">${{ $item->price }}</td>
                <td align="center">${{ $item->price * $item->qty }} </td>
            </tr>
            @endforeach
        
        </tbody>
     </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right" >
                <h2><span style="color: #3bb77e;">SubTotal:</span>${{ $order->subtotal }}</h2>
            </td>
        </tr>
        <tr>
            <td align="right" >
                <h2><span style="color: #3bb77e;">Tax:</span>+${{ $order->tax }}</h2>
            </td>
        </tr>
        @if ($order->discount != 0 || $order->discount != NULL)
            <tr>
                <td align="right" >
                    <h2><span style="color: #3bb77e;">Discount:</span>-${{ $order->discount }}</h2>
                </td>
            </tr>
        @endif
        <tr>
            <td align="right" >
                <h2><span style="color: #3bb77e;">Total:</span>${{ $order->amount }}</h2>
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
    <p>Thanks For Shopping!!</p>
    </div>
    <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>
</body>
</html>