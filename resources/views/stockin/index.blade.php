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
       <table class="table table-sm table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <
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
            <tbody>			
                <?php
                    $pagex = @$_GET['page'];
                    if(!$pagex)
                        $pagex = 1;
                    $i = config('app.row') * ($pagex - 1) + 1;
                    
                ?>
                @foreach($ins as $in)
                    <tr>
                        <td>{{$i++}}</td>
                       <td>{{ $in->supplier_id }}</td>
                       <td>{{ $in->amount }}</td>
                       <td>{{ $in->discount }}</td>
                       <td>{{ $in->total }}</td>
                       <td>{{ $in->tax }}</td>
                       <td>{{ $in->total_with_tax }}</td>
                       <td>{{ $in->seller_id }}</td>
                       <td>{{ $in->paid }}</td>
                       <td>{{ $in->rest }}</td>
                       <td>{{ $in->note }}</td>
                       <td>{{ $in->user_id }}</td>
                        <td class="text-left">
                            <a href="#" title="{{__('lb.edit')}}" data-toggle='modal' data-target='#editModal' class='btn btn-success btn-xs'
                             >
                                <i class="fa fa-edit"></i>
                            </a>
                             @candelete('request')
                            
                            <a href="" class="btn btn-danger btn-xs" onclick="return confirm('You want to delete?')" title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                            @endcandelete
                        </td>
                    </tr>
                  
                @endforeach
             
            </tbody>
        </table> <br>
        {{-- {{$ins->links('pagination::bootstrap-4')}} --}}
        </table>
	</div>
</div>




@endsection

@section('js')

@endsection