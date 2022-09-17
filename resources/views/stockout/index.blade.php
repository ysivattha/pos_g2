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
       <table class="table table-sm table-bordered" style="width: 100%" id="stock_out_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.date')}}</th>
                    <th>{{__('lb.customer')}}</th>
                    <th>{{__('lb.amount')}}</th>
                    <th>{{__('lb.discount')}}</th>
                    <th>{{__('lb.total')}}</th>
                    <th>{{__('lb.tax')}}</th>
                    <th>{{__('lb.total-tax')}}</th>
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

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="POST" id='create_form'  accept="{{ route('stockin.store') }}" >
          @csrf
 
          <input type="hidden" name="tbl" value="stock_in">
          <input type="hidden" name="per" value="stock_in">
          <div class="modal-content">
            <div class="modal-header bg-success">
                <strong class="modal-title">{{ __('lb.create_stock_in') }}</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
              <div class="modal-body">


                <div id="sms">
                </div>

                <div class="row d-flex justify-content-between">
                    <div class="col-md-6">
                                <div class="form-group row">
                        
                                    <label class="col-md-3 " for="supplier_id">
                                        {{__('lb.supplier')}} <span class="text-danger">*</span>
                                    </label>
                                
                                    <div class="col-md-9">
                                        <select name="supplier_id" id="supplier_id" class="chosen-select">
                                            <option value="">{{__('lb.select_one')}}</option>
                                            <option value="1">123</option>
                                            @foreach ($suppliers as $s)
                                            <option value="{{ $s->id }}">{{ $s->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                    
                                    <label class="col-md-3" for="amount">
                                        {{__('lb.amount')}} <span class="text-danger">*</span>
                                    </label>
                        
                                    <div class="col-md-9">
                                        <input type="number" min="0"  step="any" name="amount" id="amount" class="form-control input-xs" required>
                                    </div>
                            </div>

                            <div class="form-group row">
                            
                                    <label class="col-md-3" for="discount">
                                        {{__('lb.discount')}}  <span class="text-danger">*</span>
                                    </label>
                            
                                    <div class="col-md-9">
                                        <input type="number" min="0"  step="any" name="discount" class="form-control input-xs">
                                    </div>
                            </div>

                            
                            <div class="form-group row">
                            
                                <label class="col-md-3" for="total">
                                    {{__('lb.total')}} 
                                </label>
                        
                                <div class="col-md-9">
                                    <input type="number" min="0"  step="any" name="total" id="total" class="form-control input-xs" required>
                                </div>

                            </div>

                            <div class="form-group row">
                        
                                <label class="col-md-3" for="tax">
                                    {{__('lb.tax')}} 
                                </label>
                        
                                <div class="col-md-9">
                                    <input type="number" min="0"  step="any" name="tax"  id="tax" class="form-control input-xs" required>
                                </div>
            
                            </div>

                            

                            <div class="form-group row">
                            
                                <label class="col-md-3" for="total_with_tax">
                                    {{__('lb.total_with_tax')}} 
                                </label>
                        
                                <div class="col-md-9">
                                    <input type="number" min="0"  step="any" name="total_with_tax" id="total_with" class="form-control input-xs" required>
                                </div>

                            </div>






                    </div>



                    <div class="col-md-6 ">
                        <div class="form-group row">
                 
                            <label class="col-md-3 text-right " for="seller_id">
                                {{__('lb.seller')}} 
                            </label>
                      
                            <div class="col-md-9">
                                <select name="seller_id" id="seller_id" class="chosen-select">
                                    <option value="">{{__('lb.select_one')}}</option>
                                    
                                    @foreach ($suppliers as $s)
                                     <option value="{{ $s->id }}">{{ $s->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
        
                         </div>
        
                         <div class="form-group row">
                         
                            <label class="col-md-3 text-right" for="paid">
                                {{__('lb.paid')}} 
                            </label>
                      
                            <div class="col-md-9">
                                <input type="number"  name="paid" id="paid" class="form-control input-xs" required>
                            </div>
        
                         </div>
        
                         <div class="form-group row">
                         
                            <label class="col-md-3 text-right" for="rest">
                                {{__('lb.rest')}} 
                            </label>
                      
                            <div class="col-md-9">
                                <input type="number"  name="rest" id="rest" class="form-control input-xs" >
                            </div>
        
                         </div>
        
                         <div class="form-group row">
                         
                            <label class="col-md-3 text-right" for="note">
                                {{__('lb.note')}} 
                            </label>
                      
                            <div class="col-md-9">
                                <input type="text"  name="note" id="note" class="form-control input-xs" >
                            </div>
        
                         </div>
                     </div>
                </div>

           
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm" >
                    <i class="fa fa-save"></i> {{__('lb.save')}}
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" 
                    onclick="reset('#create_form')">
                    <i class="fa fa-times"></i> {{__('lb.close')}}
                </button>
              </div>
          </div>
      </form>
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
    var table = $('#stock_out_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('stockout.index') }}",
            type: 'GET'
        },
        columns: [
            {
                data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false
            },
            {
                data: 'date',
                name: 'date'
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
    });

    $("#create_form").submit(function(e) {
    e.preventDefault(); // prevent actual form submit
    var form = $(this);
    var url = form.attr('action'); //get submit url [replace url here if desired]
    $.ajax({
         type: "POST",
         url: url,
         data: form.serialize(), // serializes form input
         success: function(sms){
           
            if(sms>0)
            {
                let txt = `<div class='alert alert-success p-2' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <div>
                        Data has been saved successfully!
                    </div>
                </div>`;
                $('#sms').html(txt);
                $("#create_form")[0].reset();
                $('#stock_in_table').DataTable().ajax.reload();
                // update all chosen select
                $('#create_form .chosen-select').trigger("chosen:updated");
                setTimeout(function() { 
                    $('#createModal').modal('hide');
                    $('#sms').html("");
                }, 500);
       
            }
            else{
                let txt = `<div class='alert alert-danger p-2' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                    <div>
                        Fail to save data, please check again!
                    </div>
                </div>
                `;
                $('#sms').html(txt);
            }
        }
    });
});
       

</script>
@endsection