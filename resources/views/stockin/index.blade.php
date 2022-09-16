@extends('layouts.master')
@section('title')
    {{__('lb.items')}}
@endsection
@section('header')
    {{__('lb.items')}}
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}">
<div class="toolbox pt-1 pb-1">

    <div class="row">
    <div class="col-md-2">
    @cancreate('item')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate
</div>


</form>
</div>  
</div>   
<div class="card">
	
	<div class="card-body">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered" style="width: 100%" id="stock_in_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.supplier')}}</th>
                    <th>{{__('lb.amount')}}</th>
                    <th>{{__('lb.discount')}}</th>
                    <th>{{__('lb.total')}}</th>
                    <th>{{__('lb.tax')}}</th>
                    <th>{{__('lb.total_with_tax')}}</th>
                    <th>{{__('lb.seller')}}</th>
                   
                    <th>{{__('lb.paid')}}</th>
                    <th>{{__('lb.rest')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.username')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
        </table>
	</div>
</div>




@endsection

@section('js')
<script>
         
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // get unit
    var table = $('#stock_in_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('stockin.index') }}",
            type: 'GET'
        },
        columns: [
            {
                data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false
            },
            {
                data: 'contact_name',
                name: 'contact_name'
            },
            {
                data: 'amount',
                name: 'amount'
            },
            {
                data: 'discount',
                name: 'discount'
            },
            {
                data: 'total',
                name: 'total'
            },
            {
                data: 'tax',
                name: 'tax'
            },
            {
                data: 'total_with_tax',
                name: 'total_with_tax'
            },
            {
                data: 'seller_id',
                name: 'seller_id'
            },

            {
                data: 'paid',
                name: 'paid'
            },
            {
                data: 'rest',
                name: 'rest'
            },
            {
                data: 'note',
                name: 'note'
            },
            {
                data: 'username',
                name: 'username'
            },
           
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    })

</script>
@endsection