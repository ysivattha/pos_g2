@extends('layouts.master')
@section('title')
    {{__('lb.item')}}
@endsection
@section('header')
    {{__('lb.item')}}
@endsection
@section('content')  
    <div class="toolbox pt-1 pb-1">
        @cancreate('item')
        <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal'>
            <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
        </button>
        @endcancreate
        @candelete('item')
        <button class="btn btn-danger btn-sm" title="Delete selected users" id='btnDelete' 
            table='roles' permission='role' token="{{csrf_token()}}">
            <i class="fa fa-trash"></i> {{__('lb.delete')}}
        </button>
        @endcandelete
    </div>   
    <div class="card">
        <div class="card-body">
            @component('coms.alert')
            @endcomponent
            <table class="table table-sm table-bordered datatable" id='DataTable' style="width: 100%">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>
                            <input type="checkbox" onclick="check(this)" value="off">
                        </th> --}}
                       
                        <th>No</th>
                     
                        <th>Result</th>
                        <th>Note</th>
                        <th>Username</th>
                        <th>{{__('lb.action')}}</th>

                    </tr>
                </thead>
              
            </table>
        </div>
    </div>
          
@endsection

@section('js')

<script src="{{asset('chosen/chosen.jquery.min.js')}}"></script>
	<script>
        $(document).ready(function () {
           $("#menu_hr").addClass('menu-open');
           $("#sub_hr").addClass('active');
           $("#hr_result_type").addClass('myactive');
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

			var table = $('#DataTable').DataTable({
                pageLength: 50,
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: {
                    url: "{{ route('hr_result_type.index') }}",
                    type: 'GET'
                },
                columns: [
               
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                   
                    {data: 'result_type_name', name: 'result_type_name'},
                    {data: 'note', name: 'note'},
                    {data: 'fname', name:'fname'},  
                   
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ],
                "initComplete" : function () {
                $('.dataTables_scrollBody thead tr').addClass('hidden');
            }
                        
          });
        });
        // function edit(id, obj)
        // {
        //     $('#esms').html('');
        //     let tbl = $(obj).attr('table');
        //     $.ajax({
        //         type: 'GET',
        //         url: burl + '/bulk/get/' + id + '?tbl=' + tbl,
        //         success: function(sms)
        //         {
        //             let data = JSON.parse(sms);
        //             $('#eid').val(data.id);
        //             $('#ename').val(data.name);
        //         }
        //     });
        // }
    </script>
@endsection