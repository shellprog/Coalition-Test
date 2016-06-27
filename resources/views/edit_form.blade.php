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
    <form action="/product/{{$product->id}}" method="post" class="jumbotron">

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
                   value="{{old('name',$product->name)}}">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity in stock</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity"
                   value="{{old('quantity',$product->quantity)}}">
        </div>
        <div class="form-group">
            <label for="price">Price per item</label>
            <input type="number" class="form-control" name="price" id="price" placeholder="Enter price per item"
                   value="{{old('price',$product->price)}}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</body>
</html>
