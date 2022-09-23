@extends('layouts.master')
@section('title')
    {{__('lb.categories')}}
@endsection
@section('header')
    {{__('lb.categories')}}
@endsection
@section('content')
<div class="toolbox pt-1 pb-1">
    @cancreate('category')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate
    @candelete('category')
    <button class="btn btn-danger btn-sm" title="Delete selected users" id='btnDelete' 
        table='categories' permission='category' token="{{csrf_token()}}">
        <i class="fa fa-trash"></i> {{__('lb.delete')}}
    </button>
    @endcandelete
</div>   
<div class="card">
	
	<div class="card-body">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered datatable" id='data_cate' style="width: 100%">
            <thead>
                <tr>
                   
                    <th>#</th>
                    <th>{{__('lb.category')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.user')}}</th>
                    <th>{{__('lb.action')}}</th>
                </tr>
            </thead>
        </table>
	</div>
</div>




@section('js')
<script>
    $(document).ready(function () {
        $("#menu_stock").addClass('menu-open');
        $("#item").addClass('active');
        $("#categories").addClass('myactive');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        var table = $('#data_cate').DataTable({
            pageLength: 50,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: {
                url: "{{ route('category.index') }}",
                type: 'GET'
            },
            columns: [
           
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                {data: 'category', name: 'category'},
                {data: 'note', name: 'sto_item.note'},
              
                {data: 'username', name: 'users.username'},
             
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























	{{-- <script>
        $(document).ready(function () {
            $("#sidebar li a").removeClass("active");
            $("#menu_config>a").addClass("active");
            $("#menu_config").addClass("menu-open");
            $("#menu_category").addClass("myactive");

			var table = $('#dataTable').DataTable({
                pageLength: 50,
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('category.index') }}",
                columns: [
                    {
                        data: 'check', 
                        name: 'check', 
                        orderable: false, 
                        searchable: false
                    },
                    {data: 'DT_RowIndex', name: 'id', orderable: false},
                    {data: 'name', name: 'name'},
                
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false
                    },
                ],
                columnDefs: [{
                    targets: 3,
                    className: 'action'
                }]
            });
        });
        function edit(id, obj)
        {
            $('#esms').html('');
            let tbl = $(obj).attr('table');
            $.ajax({
                type: 'GET',
                url: burl + '/bulk/get/' + id + '?tbl=' + tbl,
                success: function(sms)
                {
                    let data = JSON.parse(sms);
                    $('#eid').val(data.id);
                    $('#ename').val(data.name);
                }
            });
        }
    </script> --}}
@endsection