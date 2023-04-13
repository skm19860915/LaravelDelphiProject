@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Order')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">All Orders</div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_order_modal" class="modal-trigger waves-effect waves-light btn">Create New Order</a>
                </span>
                <table id="orders" class="display responsive-table">
                    <thead>
                        <tr>
                            <th>UC Number</th>
                            <th>Extension</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Transporter</th>
                            <th>Commodity</th>
                            <th>Weight</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>UC Number</th>
                            <th>Extension</th>
                            <th>Date</th>
                            <th>Client</th>
                            <th>Transporter</th>
                            <th>Commodity</th>
                            <th>Weight</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($orderDetails as $orderDetail)
                            <tr>
                                @if($orderDetails[0]->oid == $orderDetail->oid)
                                    @if($orderDetail->oid < 10)
                                        <td><b style="color:black;">UC0{{$orderDetail->oid}}</b>&nbsp;&nbsp;<i class="tiny red-text material-icons">grade</i></td>
                                    @else
                                        <td><b style="color:black;">UC{{$orderDetail->oid}}</b>&nbsp;&nbsp;<i class="tiny red-text material-icons">grade</i></td>
                                    @endif
                                @else
                                    @if($orderDetail->oid < 10)
                                        <td><b style="color:black;">UC0{{$orderDetail->oid}}</b></td>
                                    @else
                                        <td><b style="color:black;">UC{{$orderDetail->oid}}</b></td>
                                    @endif
                                @endif
                                <td>{{$orderDetail->tex}}</td>
                                <td>{{date('d/m/Y', strtotime($orderDetail->date_created))}}</td>
                                <td>{{$orderDetail->cname}}</td>
                                <td>{{$orderDetail->tname}}</td>
                                <td>{{$orderDetail->commodity}}</td>
                                <td>{{!empty($orderDetail->weight) ? $orderDetail->weight.'Kg' : ''}}</td>
                                <!-- <td><a href="{{url('/transporter/detail/'.$orderDetail->tod)}}" class="waves-effect waves-light btn">Edit</a></td> -->
                                <td><a onclick="saveExtension({{$orderDetail->tod}}, '{{$orderDetail->tex}}')" class="waves-effect waves-light btn">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_order_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>New Order</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input placeholder="" id="date_mask" class="masked" value="{{date('d/m/Y')}}" type="text" data-inputmask="'alias': 'date'">
                    <label for="date_mask">Date Created</label>
                </div>
                <div class="input-field col s12 m-t-md m-b-md">
                    <select id="client_select" class="client-list js-states browser-default" style="width: 100%"></select>
                    <label for="client_no" class="active">Select Client Name</label>
                </div>
                <div class="input-field col s12 m-t-md m-b-md">
                    <select id="transporter_select" class="transporter-list js-states browser-default" style="width: 100%"></select>
                    <label for="transporter_no" class="active">Select Transporter Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="createOrder()">Create</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{url('client/all')}}",
            type: "GET",
            success: function(response) {
                if(response['success']){
                    var client_list = response['success'].map(item => { return { id:item.id, text:item.name }});
                    $(".client-list").select2({ data: client_list });
                }
                else{
                    $(".client-list").select2({ data: null });
                }
            }
        });

        $.ajax({
            url: "{{url('transporter/all')}}",
            type: "GET",
            success: function(response) {
                if(response['success']){
                    var transporter_list = response['success'].map(item => { return { id:item.id, text:item.name }});
                    $(".transporter-list").select2({ data: transporter_list });
                }
                else{
                    $(".transporter-list").select2({ data: null });
                }
            }
        });
    });

    function saveExtension(tod, tex)
    {
        console.log(tod, tex)

        $.ajax({
            url: "{{url('transporter/saveExtension')}}",
            type: "POST",
            data: { tex },
            success: function(response) {
                if(response['success'] > 0){
                    location.href = "/transporter/detail/" + tod;
                }
                else{
                    console.log('error');
                }
            }
        });
    }

    function createOrder()
    {
        var remarks = "test";
        var date_mask = $('#date_mask').val();
        var select_client_id = $("#client_select option:selected").val();
        var select_transporter_id = $("#transporter_select option:selected").val();

        var year = date_mask.split('/')[2];
        var month = date_mask.split('/')[1];
        var day = date_mask.split('/')[0];
        var created_date = year + '-' + month + '-' + day;

        $.ajax({
            url: "{{url('order/save')}}",
            type: "POST",
            data: { remarks, created_date, select_client_id, select_transporter_id},
            success: function(response) {
                if(response['success'] > 0){
                    Materialize.toast('Success- Created!!!', 2000, 'green rounded');
                    location.reload();
                }
                else{
                    Materialize.toast('Error- Not Updated!!!', 2000, 'red rounded');
                }
            }
        });
    }
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('js/tables/orders.js')}}"></script>
@endpush
@endsection
