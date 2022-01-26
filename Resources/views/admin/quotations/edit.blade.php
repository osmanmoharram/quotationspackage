@extends('admin::layouts.content')

@section('page_title')
    Edit Quotation 
@stop

@section('content')
    <div class="content">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif

        <form id="form" method="POST" action="{{ route('admin.doquot.quotations.update', $quotation->id) }}">
            @csrf
            @method('PATCH')

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        {{ __('doquot::app.quotations.edit') }} {{ $quotation->id }}
                    </h1>
                </div>
                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                </div>
            </div>

            <div class="page-content">
                <div class="control-group {{ $errors->has('client_id') ? 'has-error' : '' }}">
                    <label for="client_id" class="required">{{ __('doquot::app.quotations.fields.client') }}</label>
                    <select  name="client_id" id="client_id" class="control" required>
                        <option value="0">Select client...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->client_id }}" {{ $client->client_id === $quotation->client->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>

                    {!! $errors->first('client_id', '<span class="control-error">:message</span>') !!}
                </div>

                <div class="control-group {{ $errors->has('tax') ? 'has-error' : ''}}">
                    <label for="tax" class="required">{{ __('doquot::app.quotations.fields.tax') }}</label>
                    <input id="tax" name="tax" class="control" value="{{ $quotation->tax }}">

                    {!! $errors->first('tax', '<span class="control-error">:message</span>') !!}
                </div>

                @if ($quotation->products->count() > 0)
                    <br>
                    <h3>Products</h3>
                    <br>
                    
                    <table class="table products-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Subtotal <span class="h6 text-danger">(without tax rate)</span></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="productsTbody">
                            @foreach ($quotation->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <input type="hidden" name="products[{{ $product->id}}]['product_id']" value="{{ $product->id }}">
                                    <td><input type="text" name="products[{{ $product->id}}]['unit_price']" value="{{ $product->pivot->unit_price }}"></td>
                                    <td><input type="text" name="products[{{ $product->id }}]['quantity']" value="{{ $product->pivot->quantity }}"></td>
                                    <td>{{ $product->pivot->unit_price * $product->pivot->quantity }}</td>
                                    <td>
                                        <a href="#" class="btnRemoveProduct" data-product-id="${product_id}">
                                            <span class="icon trash-icon"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                @endif
                
                <br>
                <br>
                
                <p><strong>{{ __('doquot::app.quotations.fields.total') }} <span class="h6 text-danger">(with tax)</span>: </strong>
                    <span id="total">{{ $quotation->total }}</span>
                    <input type="hidden" name="total" id="total_input" value="{{ $quotation->total }}">
                </p>
                
                <br>
                <br>
                
                <div class="control-group {{ $errors->has('product_id') ? 'has-error' : '' }}">
                    <label for="product" class="required">{{ __('doquot::app.quotations.fields.products.title') }}</label>
                    <select id="product" class="control">
                        <option value="0">Select product...</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <label for="unit_price" class="required">{{ __('doquot::app.quotations.fields.products.unit_price') }}</label>
                    <input id="unit_price" class="control">

                    <label for="qty" class="required">{{ __('doquot::app.quotations.fields.products.quantity') }}</label>
                    <input type="text" id="qty" class="control">

                    <button type="button" class="btn btn-sm btn-success" id="btnAddProduct"><i class="fas fa-plus mr-2"></i>Add Product</button>

                    {!! $errors->first('product_id', '<span class="control-error">:message</span>') !!}
                    {!! $errors->first('unit_price', '<span class="control-error">:message</span>') !!}
                    {!! $errors->first('quantity', '<span class="control-error">:message</span>') !!}
                </div>

                <div class="control-group {{ $errors->has('validity') ? 'has-error' : ''}}">
                    <label for="validity" class="">{{ __('doquot::app.quotations.fields.validity') }}</label>
                    <input class="control" name="validity" id="validity" value="{{ $quotation->validity }}">

                    {!! $errors->first('validity', '<span class="control-error">:message</span>') !!}
                </div>
            </div>
        </form>
    </div>
@stop

@push('scripts')
<script>
    $(document).ready(function() {
        function getSubtotal(unit_price, quantity) {
            return unit_price * quantity;
        }

        function getTotal() {
            let tax = parseFloat($('#tax').val());
            let leng = $('#productsTbody').children('tr').length;
            let subtotal = 0.00;
            let maxTotal = 0.00;

            for(let i=0; i < leng; i++) {
                subtotal = $('#productsTbody').children('tr').eq(i).children('td').eq(3).html();
                maxTotal += parseFloat(subtotal);
            }

            let equation = maxTotal * tax;

            $('#total').html(equation);
            $('#total_input').val(equation);
        }

        $('#btnAddProduct').click(function(e) {
            e.preventDefault();

            /* get fields values */
            let tax = parseFloat($('#tax').val());
            let product_name = $('#product option:selected').text();
            let product_id = $('#product').val();
            let quantity = parseFloat($('#qty').val());
            let unit_price = parseFloat($('#unit_price').val());
            let validation_errors = [];

            /* validate fields values */
            if(! tax) {
                // alert('Tax Rate is required');
                validation_errors.push('Tax Rate is required');
            } else if(isNaN(tax)) {
                // alert('Tax Rate should be a number');
                validation_errors.push('Tax Rate should be a number');
            }

            if(! product_id) {
                // alert('Product is required');
                validation_errors.push('Product is required');
            }

            if(! quantity) {
                // alert('Quantity is required');
                validation_errors.push('Quantity is required');
            } else if(isNaN(quantity)) {
                // alert('Quantity should be a number');
                validation_errors.push('Quantity should be a number');
            }

            if(! unit_price) {
                // alert('Unit price is required');
                validation_errors.push('Unit price is required');
            } else if(isNaN(unit_price)) {
                // alert('Unit price should be a number');
                validation_errors.push('Unit price should be a number');
            }

            // calculate subtotal
            let subtotal = getSubtotal(unit_price, quantity);

            let row = `
            <tr>
                <td>${product_name}</td>
                <td> <input type="text" name="products[${product_id}][unit_price]" value="${unit_price}"> </td>
                <td> <input type="text" name="products[${product_id}][quantity]" value="${quantity}"> </td>
                <td>${subtotal}</td>
                <td>
                    <a href="#" class="btnRemoveProduct" data-product-id="${product_id}">
                        <span class="icon trash-icon"></span>
                    </a>
                </td>

                <input type="hidden" name="products[${product_id}][product_id]" value="${product_id}">
                <input type="hidden" name="products[${product_id}][unit_price]" value="${unit_price}">
                <input type="hidden" name="products[${product_id}][quantity]" value="${quantity}">
            </tr>
            `;

            if(! Array.isArray(validation_errors) || ! validation_errors.length) {
                // create a row in the table
                $(".products-table tbody").append(row);

                // calculate total
                getTotal();

                // clear fields
                $('#product').val('0');
                $('#qty').val('');
                $('#unit_price').val('');
            } else {
                let errors = '';

                for (i = 0; i < validation_errors.length; i++) {
                    errors += validation_errors[i] + '\n';
                }

                alert('Correct the following errors: \n\n' + errors);
            }
        });

        $('.products-table tbody').on('click', 'a', function(e) {
            e.preventDefault();
            $(this).parents('tr').remove();

            getTotal();
        });
    });
</script>
@endpush