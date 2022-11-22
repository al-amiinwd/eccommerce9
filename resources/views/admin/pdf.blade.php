<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Print</title>
</head>
<body>

                              <h1>Order Details :</h1>
                    Customer Name  : <h2>{{$order->name}}</h2>
                    Customer Email :  <h2>{{$order->email}}</h2>
                    Customer Phone : <h2>{{$order->phone}}</h2>
                    Customer Address : <h2>{{$order->address}}</h2>
                    Product Name   :   <h2>{{$order->product_title}}</h2>
                    Product Price  :   <h2>{{$order->price}}</h2>
                    Product Quantity : <h2>{{$order->quantity}}</h2>
                    Product Image   :
                    <br><br>
                    <img style="width: 450px; height:250px;" src="product/{{$order->image}}" alt="">
                    <br>
                    Payment Status  :     <h2>{{$order->payment_status}}</h2>




</body>
</html>
