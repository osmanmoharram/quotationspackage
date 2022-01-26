@extends('admin::layouts.content')

@section('page_title')
    {{ __('doquot::app.quotations.title') }}
@stop

@section('content')
@if ($errors->any())
   @error('products')
       {{ $message }}
   @enderror 
@endif
    <div class="content">
        <div class="page-header">
            <div class="page-title"><h1 class="text-uppercase">{{ __('doquot::app.quotations.title') }}</h1></div>
            <div class="page-action">
                <a href="{{ route('admin.doquot.quotations.create') }}" class="btn btn-lg btn-primary" title="Add New Quotation">New Quotation</a>
            </div>
        </div>

        <div class="page-content">
            <div class="table">
                <div class="grid-container">
                    <div class="filter-row-one" id="datagrid-filters">
                        <div class="search-filter">
                            <form method="GET" action="{{ route('admin.doquot.quotations.index') }}" accept-charset="UTF-8" class="" style="display: contents;" role="search">
                                <input type="search" id="search-field" name="search" class="control" placeholder="{{ __('ui::app.datagrid.search') }}" />
                                <div class="icon-wrapper"><button class="icon search-icon search-btn" type="submit" style="border: 0px; background-color: inherit;"></button></div>
                            </form>
                        </div>

                        <div class="dropdown-filters per-page">
                            <form method="GET" action="{{ url()->current() }}">
                                <div class="control-group">
                                    <label class="per-page-label" for="perPage">{{ __('ui::app.datagrid.items-per-page') }}</label>

                                    <select id="perPage" name="perPage" class="control" onchange="this.form.submit();">
                                        <option value="10"{{ request()->get('perPage') == 10 ? ' selected' : '' }}> 10 </option>
                                        <option value="20"{{ request()->get('perPage') == 20 ? ' selected' : '' }}> 20 </option>
                                        <option value="30"{{ request()->get('perPage') == 30 ? ' selected' : '' }}> 30 </option>
                                        <option value="40"{{ request()->get('perPage') == 40 ? ' selected' : '' }}> 40 </option>
                                        <option value="50"{{ request()->get('perPage') == 50 ? ' selected' : '' }}> 50 </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="filter-row-two"></div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('doquot::app.quotations.fields.client') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.products.number') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.tax') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.total') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.validity') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.created_at') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.status') }}</th>
                                <th>{{ __('doquot::app.quotations.fields.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($quotations as $quotation)
                                <tr>
                                    <td>{{ $quotation->id }}</td>
                                    <td>{{ $quotation->client->name }}</td>
                                    <td>{{ $quotation->products->count() }}</td>
                                    <td>{{ $quotation->tax }}</td>
                                    <td>{{ $quotation->total }}</td>
                                    <td>{{ $quotation->validity }}</td>
                                    <td>{{ $quotation->created_at }}</td>
                                    <td>{{ $quotation->status }}</td>
                                    <td class="actions" style="white-space: nowrap; width: 100px;">
                                        <div class="action">
                                            <a href="{{ route('admin.doquot.quotations.show', $quotation->id) }}" title="View Quotation">
                                                <button style="border: none; background-color: inherit;"><span class="icon eye-icon"></span></button>
                                            </a>

                                            <a href="{{ route('admin.doquot.quotations.edit', $quotation->id) }}" title="Edit Quotation">
                                                <button style="border: none; background-color: inherit;">
                                                    <span class="icon pencil-lg-icon"></span>
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ route('admin.doquot.quotations.destroy', $quotation->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" style="border: none; background-color: inherit;" title="Delete Quotation" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    <span class="icon trash-icon"></span>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.doquot.status.update', $quotation->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                
                                                <input type="hidden" name="action" value="approve">
                                                @if (auth('admin')->id() === 2)
                                                    <button type="submit" {{ $quotation->status === 'approved' ? 'disabled' : '' }} title="Approve Quotation">Approve</button>
                                                @else
                                                    <button type="submit" {{ (($quotation->total >= session('applied_require_approval_total')) || ($quotation->status === 'approved')) ? 'disabled' : '' }} title="Approve Quotation">Approve</button>
                                                @endif
                                            </form>

                                            <form action="{{ route('admin.doquot.status.update', $quotation->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                @if (auth('admin')->id())
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rejectReasonModal" title="Reject Quotation" {{ $quotation->status === 'rejected' ? 'diabled' : '' }}>
                                                        Reject
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rejectReasonModal" title="Reject Quotation" {{ (($quotation->total >= session('applied_require_approval_total')) || ($quotation->status === 'rejected')) ? 'disabled' : '' }}>
                                                        Reject
                                                    </button>
                                                @endif

                                                <!-- Modal -->
                                                <div class="modal fade" id="rejectReasonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rejectionReasonModalLabel">Rejection Reason</h5>

                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <input type="hidden" name="action" value="reject">
                                                                <textarea name="rejection_reason"></textarea>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="sumbit" class="btn btn-primary">Confirm</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination"> {!! $quotations->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>
            </div>
        </div>
    </div>
@stop
