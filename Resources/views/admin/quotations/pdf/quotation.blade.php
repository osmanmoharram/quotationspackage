<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="page-header">
        <h1>QUOTATION</h1>
    </div>

<div class="table">
    <table class="table">
        <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $quotation->id }}</td>
            </tr>
            <tr>
                <td>{{ __('doquot::app.quotations.fields.client') }}</td>
                <td>{{ $quotation->client->name }}</td>
            </tr>
            <tr>
                <td>{{ __('doquot::app.quotations.fields.tax') }}</td>
                <td>{{ $quotation->tax }}</td>
            </tr>
            <tr>
                <td>{{ __('doquot::app.quotations.fields.created_at') }}</td>
                <td>{{ $quotation->created_at }}</td>
            </tr>
            <tr>
                <td>{{ __('doquot::app.quotations.fields.validity') }}</td>
                <td>{{ $quotation->validity }}</td>
            </tr>
            <tr>
                <td>{{ __('doquot::app.quotations.fields.status') }}</td>
                <td>{{ $quotation->status }}</td>
            </tr>
            @if ($quotation->status === 'rejected')
                <tr>
                    <td>{{ __('doquot::app.quotations.fields.rejection_reason') }}</td>
                    <td>{{ $quotation->rejection_reason }}</td>
                </tr>
            @endif
            <tr>
                <td><strong>{{ __('doquot::app.quotations.fields.products.total') }}</strong></td>
                <td><strong>{{ $quotation->total }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<br>
<div class="table">
    <table class="table data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Tax Rate</th>
                <th>Subtotal</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($quotation->products as $product)
                <tr>
                    <td>
                        <p>{{ $product->name }}</p>
                    </td>
    
                    <td>
                        <p>{{ $product->pivot->unit_price }}</p>
                    </td>
                    <td>
                        <p>{{ $product->pivot->quantity }}</p>
                    </td>
                    <td>
                        <p>{{ $quotation->tax }}</p>
                    </td>
                    <td>
                        <p>{{ $product->pivot->unit_price * $product->pivot->quantity }}</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>