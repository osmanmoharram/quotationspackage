@extends('admin::layouts.content')

@section('page_title')
    {{ __('doquot::app.quotations.show') }}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title"><h1>{{ __('doquot::app.quotations.show') }} {{ $quotation->id }}</h1> </div>
        </div>

        <div class="page-content">
            <br>
            <a href="{{ route('quotation.print-pdf', $quotation->id) }}" target="_blank">
                <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-printer" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 2H5a1 1 0 0 0-1 1v2H3V3a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h-1V3a1 1 0 0 0-1-1zm3 4H2a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h1v1H2a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1z"/>
                    <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM5 8a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H5z"/>
                    <path d="M3 7.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                </svg>
            </a>
            <br><br>
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

            <br><br><br>

            <h3 class="mt-4">{{ __('doquot::app.quotations.fields.products.title') }}</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($quotation->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->unit_price }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->subtotal }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop