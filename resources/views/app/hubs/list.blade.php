@extends('vendor.manchesterTemplate.template')


@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h4>Administration / List Hub</h4>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel" style="height:600px;">
                    <div class="x_title">
                        <h2>List Hub</h2>
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
                            <tr class="even pointer">
                                <td>1</td>
                                <td>Standard-A-1</td>
                                <td>Northern Rail</td>
                                <td><a href="{{ URL::to('hubs/1') }}">View</a></td>
                                <td><a href="{{ URL::to('hubs/1/edit') }}">Edit</a></td>
                                <td class="last"><a href="#">Delete</a></td>
                            </tr>
                            <tr class="even pointer">
                                <td>2</td>
                                <td>Deluxe-D-55</td>
                                <td>Virgin Trains</td>
                                <td><a href="{{ URL::to('hubs/1') }}">View</a></td>
                                <td><a href="{{ URL::to('hubs/1/edit') }}">Edit</a></td>
                                <td class="last"><a href="#">Delete</a></td>
                            </tr>
                            <tr class="even pointer">
                                <td>3</td>
                                <td>Mid-C-11</td>
                                <td>Pennine Express</td>
                                <td><a href="{{ URL::to('hubs/1') }}">View</a></td>
                                <td><a href="{{ URL::to('hubs/1/edit') }}">Edit</a></td>
                                <td class="last"><a href="#">Delete</a></td>
                            </tr>
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
                    "sSwfPath": "{{ URL::to('vendor/manchesterTemplate/js/datatables/tools/swf/copy_csv_xls_pdf.swf') }}}"
                }
            });
        });
    </script>
@stop