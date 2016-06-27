<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

</head>
<body>

<div class="container">
    <form action="/form_submit" method="post" class="jumbotron">

        {{csrf_field()}}

        @if(Session::has('error_msg'))
            <p class="alert alert-danger">{!! Session::get('error_msg') !!}</p>
        @endif

        @if(Session::has('success_msg'))
            <p class="alert alert-success">{!! Session::get('success_msg') !!}</p>
        @endif

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name"
                   value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity in stock</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity"
                   value="{{old('quantity')}}">
        </div>
        <div class="form-group">
            <label for="price">Price per item</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Enter price per item"
                   value="{{old('price')}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @if(sizeof($products) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity in stock</th>
                <th>Price per item</th>
                <th>Datetime submitted</th>
                <th>Total value</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>


            <tbody>

            @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->price}} $</td>
                    <td>{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $product->created_at)->format("l jS F Y")}}</td>
                    <td>{{$product->total_value}} $</td>
                    <td><a class="btn btn-info" href="/product/{{$product->id}}">Edit</a></td>
                    <td><a class="btn btn-danger" href="/product/delete/{{$product->id}}">Delete</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif

</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
