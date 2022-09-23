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
            <table class="table table-sm table-bordered datatable" id='data_employee' style="width: 100%">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>
                            <input type="checkbox" onclick="check(this)" value="off">
                        </th> --}}
                       
                        <th>{{__('lb.id')}}</th>
                        <th>{{__('lb.date')}}</th>
                        <th>{{__('lb.name_khmer')}}</th>
                        <th>{{__('lb.name_english')}}</th>
                        <th>{{__('lb.sex')}}</th>
                        <th>{{__('lb.position')}}</th>
                        <th>{{__('lb.department')}}</th>
                        <th>{{__('lb.status')}}</th>
                        <th>{{__('lb.login_id')}}</th>
                        <th>{{__('lb.note')}}</th>
                        <th>{{__('lb.user')}}</th>
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
           $("#employee").addClass('myactive');
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

			var table = $('#data_employee').DataTable({
                pageLength: 50,
                processing: true,
                serverSide: true,
                // scrollX: true,
                ajax: {
                    url: "{{ route('hr_employ.index') }}",
                    type: 'GET'
                },
                columns: [
               
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'date', name: 'date'},
                    {data: 'name_kh', name: 'name_kh'},
                    {data: 'name_en', name: 'name_en'},
                    {data: 'sex', name: 'sex'},
                    {data: 'position', name: 'position'},
                    {data: 'department', name: 'department'},  
                    {data: 'status', name: 'status'},
                    {data: 'login_id', name: 'login_id'},
                    {data: 'note', name: 'note'},  
                    {data: 'username', name: 'username'},
                 
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