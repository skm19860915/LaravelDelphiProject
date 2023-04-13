@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Tracking Report')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">Tracking Report</div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a class="waves-effect waves-light btn" onclick="exportExcel()">Export Tracking Report</a>
                </span>
                <table id="xe_requests" class="display responsive-table">
                    <thead>
                        <tr>
                            <th>Manifest Number</th>
                            <th>Ex Container</th>
                            <th>Weight</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Manifest Number</th>
                            <th>Ex Container</th>
                            <th>Weight</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($xerequests as $xerequest)
                            <tr>
                                <td>
                                    <input type="checkbox" id="{{$xerequest->id}}" value="{{$xerequest->id}}" name="order_id">
                                    <label style="color:black;" for="{{$xerequest->id}}">UC{{$xerequest->id}}</label>
                                </td>
                                <td>CAIU {{$xerequest->id}}</td>
                                <td>{{$xerequest->weight}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    var allClientTable = $('#xe_requests').DataTable({
        language: {
            searchPlaceholder: 'Search records',
            sSearch: '',
            sLengthMenu: 'Show _MENU_',
            sLength: 'dataTables_length',
            oPaginate: {
                sFirst: '<i class="material-icons">chevron_left</i>',
                sPrevious: '<i class="material-icons">chevron_left</i>',
                sNext: '<i class="material-icons">chevron_right</i>',
                sLast: '<i class="material-icons">chevron_right</i>'
            }
        }
    });
    $('.dataTables_length select').addClass('browser-default');
});

function exportExcel()
{
    var ids = [];
    $.each($("input[name='order_id']:checked"), function(){
        ids.push($(this).val());
    });

    if (ids.length === 0) {
        Materialize.toast('Error- Select a record!!!', 2000, 'red rounded');
        return;
    }

    $.ajax({
        url: "{{route('tracking-report.filter')}}",
        type: "POST",
        data: JSON.stringify(ids),
        contentType: "application/json",
        dataType: "json",
        success: function(response) {
            if(response['success'] > 0){
                window.location.href = "{{route('tracking-report.export')}}";
            }
        }
    });
}
</script>
@endpush

@push('javascript')
<script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
@endpush
@endsection
