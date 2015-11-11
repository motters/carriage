@extends('vendor.manchesterTemplate.template')


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h5>Administration / List Hub</h5>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                    <div class="x_title">
                        <h2>List Hub</h2>
                        <a href="{{ URL::to('hubs/add') }}" class="btn btn-primary btn-sm" style="float: right;">Add New</a>
                        <div class="clearfix"></div>
                    </div>
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                        <tr class="headings">
                            <th>Carriage System ID </th>
                            <th>Carriage Name </th>
                            <th>Carriage Lease</th>
                            <th class="no-link last"><span class="nobr">View</span></th>
                            <th class="no-link last"><span class="nobr">Edit</span></th>
                            <th class="no-link last"><span class="nobr">Delete</span></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Database\Hubs::with('client')->get() as $hub)
                                <tr class="even pointer">
                                    <td>{{ $hub->id }}</td>
                                    <td>{{ $hub->carriage_name }}</td>
                                    <td>{{ $hub->client->client }}</td>
                                    <td><a href="{{ URL::to('hubs/'.$hub->id.'/view') }}">View</a></td>
                                    <td><a href="{{ URL::to('hubs/'.$hub->id.'/edit') }}">Edit</a></td>
                                    <td class="last">
                                        <a data-toggle="modal" data-target=".delete-{{ $hub->id }}">Delete</a>


                                        <div class="modal fade delete-{{ $hub->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    {!! Form::open(['url'=>'hubs/'.$hub->id, 'method'=>'delete']) !!}
                                                    <div class="modal-header btn-danger">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel2">Delete {{ $hub->carriage_name }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete this carriage? There's no going back!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            {!! Form::hidden('id', $hub->id) !!}
                                                            <button type="submit" class="btn btn-danger">DELETE FOREVER</button>
                                                    </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@stop


@section('js_bottom')
    <script>
        $(document).ready(function () {
            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [3]
                    },
                    {
                        'bSortable': false,
                        'aTargets': [4]
                    },
                    {
                        'bSortable': false,
                        'aTargets': [5]
                    }
                ],
                'iDisplayLength': 12,
                "sPaginationType": "full_numbers",
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "{{ URL::to('vendor/manchesterTemplate/js/datatables/tools/swf/copy_csv_xls_pdf.swf') }}"
                }
            });
        });
    </script>
@stop