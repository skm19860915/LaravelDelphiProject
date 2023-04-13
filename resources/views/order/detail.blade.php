@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Order')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">Order Details</div>
    </div>
    <div class="col s6 m6 l6">
        <div class="page-title right"><a href="{{url('/order/all')}}">Back</a></div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <div class="row" style="margin-bottom:unset !important;">
                    <div class="input-field col s4">
                        @if($order->id < 10)
                            <input disabled id="order_no" style="color:black;" type="text" class="validate" value="UC0{{$order->id}}">
                        @else
                            <input disabled id="order_no" style="color:black;" type="text" class="validate" value="UC{{$order->id}}">
                        @endif
                        <label for="order_no" class="active">Order No</label>
                        <input id="order_id" type="hidden" value="{{$order->id}}">
                    </div>
                    <div class="input-field col s6">
                        <input disabled id="order_remarks" type="text" class="validate" value="{{$order->remarks}}">
                        <label for="order_remarks" class="active">Commodity</label>
                    </div>
                    <div class="input-field col s2">
                        @if ($order->cancelled == 1)
                            <p class="p-v-xs"><input type="checkbox" id="cancelled_order" checked><label for="cancelled_order">Cancelled</label></p>
                        @else
                            <p class="p-v-xs"><input type="checkbox" id="cancelled_order"><label for="cancelled_order">Cancelled</label></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 l6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Clients</span>
                <table id="order_clients" class="display responsive-table">
                    <thead>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Account No</th>
                            <th>Client Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        <tr>
                            <td style="display:none;">{{$client->id}}</td>
                            <td>{{$client->account_no}}</td>
                            <td>{{$client->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- <div class="card-action">
                <a href="#client_modal_1" id="client_btn_1" class="modal-trigger waves-effect waves-light btn">Add</a>
                <a href="#client_modal_2" id="client_btn_2" class="modal-trigger waves-effect waves-light btn">Change</a>
                <a href="#client_modal_3" id="client_btn_3" class="modal-trigger waves-effect waves-light btn">Delete</a>
            </div>
            <div class="card-action">
                <a href="#" class="waves-effect waves-light btn">Edit Client</a>
                <a href="#" class="waves-effect waves-light btn">Suppliers</a>
                <a href="#" class="waves-effect waves-light btn">Service Providers</a>
            </div> -->
        </div>
    </div>
    <div class="col s12 m6 l6">
        <div class="card">
            <div class="card-content">
                <span class="card-title">Transporters</span>
                <table id="order_transporters" class="display responsive-table">
                    <thead>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Account No</th>
                            <th>Transporter Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transporters as $transporter)
                        <tr>
                            <td style="display:none;">{{$transporter->id}}</td>
                            <td>{{$transporter->account_no}}</td>
                            <td>{{$transporter->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- <div class="card-action">
                <a href="#transporter_modal_1" id="transporter_btn_1" class="modal-trigger waves-effect waves-light btn">Add</a>
                <a href="#transporter_modal_2" id="transporter_btn_2" class="modal-trigger waves-effect waves-light btn">Change</a>
                <a href="#transporter_modal_3" id="transporter_btn_3" class="modal-trigger waves-effect waves-light btn">Delete</a>
            </div>
            <div class="card-action">
                <a id="transporter_btn_4" class="waves-effect waves-light btn">Edit Transporter</a>
            </div> -->
            <div class="card-action">
                @if (count($transporters) > 0)
                <a href="#transporter_modal_2" id="transporter_btn_2" class="modal-trigger waves-effect waves-light btn">Change</a>
                <a id="transporter_btn_4" class="waves-effect waves-light btn">Edit</a>
                @else
                <a href="#transporter_modal_1" id="transporter_btn_1" class="modal-trigger waves-effect waves-light btn">Add</a>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="client_modal_1" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>New Client</h4>
            <div class="row">
                <div class="input-field col s12">
                    <select id="client_select_1" class="client-list js-states browser-default" tabindex="-1" style="width: 100%"></select>
                    <label for="select_account_no_1" class="active">Name</label>
                </div>
                <div class="input-field col s7" style="display:none;">
                    <input placeholder="" id="select_name_1" type="text" class="validate" readonly>
                    <label for="select_name_1" class="active">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="addClient()">Add</a>
        </div>
    </form>
</div>

<div id="client_modal_2" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Change Client</h4>
            <div class="row">
                <div class="input-field col s5">
                    <select id="client_select_2" class="client-list js-states browser-default" tabindex="-1" style="width: 100%"></select>
                    <label for="select_account_no_2" class="active">Account No</label>
                </div>
                <div class="input-field col s7">
                    <input placeholder="" id="select_name_2" type="text" class="validate" readonly>
                    <label for="select_name_2" class="active">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="changeClient()">Update</a>
        </div>
    </form>
</div>

<div id="client_modal_3" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Delete Client</h4>
            <input id="delete_client_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="deleteClient()">Yes</a>
        </div>
    </form>
</div>

<div id="transporter_modal_1" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Add Transporter</h4>
            <p><i>Choose the transporter that you wish to add from the transporter list</i></p><br>
            <div class="row">
                <div class="input-field col s12">
                    <select id="transporter_select_1" class="transporter-list js-states browser-default" tabindex="-1" style="width: 100%"></select>
                    <label for="t_name_1" class="active">Name</label>
                </div>
                <div class="input-field col s7" style="display:none">
                    <input placeholder="" id="t_select_name_1" type="text" class="validate" readonly>
                    <label for="t_select_name_1" class="active">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="addTransporter()">Add</a>
        </div>
    </form>
</div>

<div id="transporter_modal_2" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Change Transporter</h4>
            <p><i>Choose the transporter that you wish to change from the transporter list</i></p><br>
            <div class="row">
                <div class="input-field col s12">
                    <select id="transporter_select_2" class="transporter-list js-states browser-default" tabindex="-1" style="width: 100%"></select>
                    <label for="t_account_no_2" class="active">Account No</label>
                </div>
                <div class="input-field col s7" style="display:none">
                    <input placeholder="" id="t_select_name_2" type="text" class="validate" readonly>
                    <label for="t_select_name_2" class="active">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="changeTransporter()">Update</a>
        </div>
    </form>
</div>

<div id="transporter_modal_3" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Delete Transporter</h4>
            <input id="delete_transporter_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="deleteTransporter()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
    function addClient()
    {
        var order_id = $('#order_id').val();
        var add_client_id = $('#client_select_1').val();

        $.ajax({
            url: "{{url('client/add')}}",
            type: "POST",
            data: {order_id, add_client_id},
            success: function(response) {
                if(response['success'] == 1){
                    Materialize.toast('Success- Added!!!', 2000, 'green rounded');
                    location.reload();
                }
                else{
                    Materialize.toast('Error- Not Added!!!', 2000, 'red rounded');
                }
            }
        });
    }

    function changeClient()
    {

    }

    function deleteClient()
    {
        var order_id = $('#order_id').val();
        var delete_client_id = $('#delete_client_id').val();

        $.ajax({
            url: "{{url('client/delete')}}",
            type: "POST",
            data: {order_id, delete_client_id},
            success: function(response) {
                if(response['success'] == 1){
                    Materialize.toast('Success- Deleted!!!', 2000, 'green rounded');
                    location.reload();
                }
                else{
                    Materialize.toast('Error- Not Deleted!!!', 2000, 'red rounded');
                }
            }
        });
    }

    function addTransporter()
    {
        var order_id = $('#order_id').val();
        var add_transporter_id = $('#transporter_select_1').val();

        $.ajax({
            url: "{{url('transporter/add')}}",
            type: "POST",
            data: {order_id, add_transporter_id},
            success: function(response) {
                if(response['success'] > 0){
                    Materialize.toast('Success- Added!!!', 2000, 'green rounded');
                    location.href = "/transporter/detail/" + response['success'];
                }
                else{
                    Materialize.toast('Error- Not Added!!!', 2000, 'red rounded');
                }
            }
        });
    }

    function changeTransporter()
    {
        var order_id = $('#order_id').val();
        var change_transporter_id = $('#transporter_select_2').val();
        console.log(order_id,  change_transporter_id)

        $.ajax({
            url: "{{url('transporter/change')}}",
            type: "POST",
            data: {order_id, change_transporter_id},
            success: function(response) {
                if(response['success'] > 0){
                    Materialize.toast('Success- Changed!!!', 2000, 'green rounded');
                    location.reload();
                }
                else{
                    Materialize.toast('Error- Not Changed!!!', 2000, 'red rounded');
                }
            }
        });
    }

    function deleteTransporter()
    {
        var order_id = $('#order_id').val();
        var delete_transporter_id = $('#delete_transporter_id').val();

        $.ajax({
            url: "{{url('transporter/delete')}}",
            type: "POST",
            data: {order_id, delete_transporter_id},
            success: function(response) {
                if(response['success'] == 1){
                    Materialize.toast('Success- Deleted!!!', 2000, 'green rounded');
                    location.reload();
                }
                else{
                    Materialize.toast('Error- Not Deleted!!!', 2000, 'red rounded');
                }
            }
        });
    }
</script>
@endpush

@push('javascript')
<script>
$(document).ready(function() {
    var clientTable = $('#order_clients').DataTable({
        scrollY: '280px',
        scrollCollapse: true,
        paging: false,
        "searching": false,
    });

    var transporterTable = $('#order_transporters').DataTable({
        scrollY: '280px',
        scrollCollapse: true,
        paging: false,
        "searching": false
    });

    $('.dataTables_length select').addClass('browser-default');

    var client_data = [];
    $.ajax({
        url: "{{url('client/all')}}",
        type: "GET",
        success: function(response) {
            if(response['success']){
                var client_list = response['success'].map(item => { return { id:item.id, text:item.name }});
                client_data = response['success'];
                $(".client-list").select2({ data: client_list });
            }
            else{
                $(".client-list").select2({ data: null });
            }
        }
    });

    var transporter_data = [];
    $.ajax({
        url: "{{url('transporter/all')}}",
        type: "GET",
        success: function(response) {
            if(response['success']){
                var transporter_list = response['success'].map(item => { return { id:item.id, text:item.name }});
                transporter_data = response['success'];
                $(".transporter-list").select2({ data: transporter_list });
            }
            else{
                $(".transporter-list").select2({ data: null });
            }
        }
    });

    $('#order_clients tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            clientTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#client_select_1').change(function() {
        var select_id = $("#client_select_1").val();
        var name = client_data.find(x => x.id == select_id).name;
        $('#select_name_1').val(name);
    });

    $('#client_select_2').change(function() {
        var select_id = $("#client_select_2").val();
        var name = client_data.find(x => x.id == select_id).name;
        $('#select_name_2').val(name);
    });

    $('#client_btn_1').click(function () {
        $('#client_select_1').select2().select2("val", client_data[0]['id']);
        $('#select_name_1').val(client_data[0]['name']);
    });

    $('#client_btn_2').click(function () {
        var record = $.map(clientTable.rows('.selected').data(), function (item) { return item; });
        $('#client_select_2').select2().select2("val", record[0]);
        $('#select_name_2').val(record[2]);
    });

    $('#client_btn_3').click(function () {
        var record = $.map(clientTable.rows('.selected').data(), function (item) {
            return item;
        });
        $('#delete_client_id').val(record[0]);
    });

    $('#order_transporters tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            transporterTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#transporter_select_1').change(function() {
        var select_id = $("#transporter_select_1").val();
        var name = transporter_data.find(x => x.id == select_id).name;
        $('#t_select_name_1').val(name);
    });

    $('#transporter_select_2').change(function() {
        var select_id = $("#transporter_select_2").val();
        var name = transporter_data.find(x => x.id == select_id).name;
        $('#t_select_name_2').val(name);
    });

    $('#transporter_btn_1').click(function () {
        $('#transporter_select_1').select2().select2("val", transporter_data[0]['id']);
        $('#t_select_name_1').val(transporter_data[0]['name']);
    });

    $('#transporter_btn_2').click(function () {
        // var record = $.map(transporterTable.rows('.selected').data(), function (item) { return item; });
        // $('#transporter_select_2').select2().select2("val", record[0]);
        // $('#t_select_name_2').val(record[2]);
        $('#transporter_select_2').select2().select2("val", transporter_data[0]['id']);
        $('#t_select_name_2').val(transporter_data[0]['name']);
    });

    $('#transporter_btn_3').click(function () {
        var record = $.map(transporterTable.rows('.selected').data(), function (item) {
            return item;
        });
        $('#delete_transporter_id').val(record[0]);
    });

    $('#transporter_btn_4').click(function () {
        var record = $.map(transporterTable.rows('.selected').data(), function (item) { return item; });
        var transporter_id = record[0];
        var order_id = $('#order_id').val();

        $.ajax({
            url: "{{url('order/getTransporterOrder')}}",
            type: "POST",
            data: {order_id, transporter_id},
            success: function(response) {
                if(response['success'] > 0){
                    location.href = "/transporter/detail/" + response['success'];
                }
                else{
                    Materialize.toast('Error- Not Found Page!!!', 2000, 'red rounded');
                }
            }
        });
    });
});
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
@endpush
@endsection
