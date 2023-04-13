@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Order')
@section('content')
<div class="row">
    <div class="col s12">
        <div class="page-title">Offload Address List</div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_addr_modal" class="modal-trigger waves-effect waves-light btn">Create New Offload Address</a>
                </span>
                <table id="offloadAddressList" class="display responsive-table">
                    <thead>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Offload Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Date</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Offload Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Date</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($addrs as $addr)
                            <tr>
                                <td style="display:none;">{{$addr->id}}</td>
                                <td>{{$addr->name}}</td>
                                <td >{{$addr->address1}} {{$addr->address2}} {{$addr->address3}}</td>
                                <td>{{$addr->city}}</td>
                                <td>{{$addr->province1}} {{$addr->province2}}</td>
                                <td>{{$addr->created_at}}</td>
                                <td>
                                    <a href="#edit_addr_modal" data-perm-item="{{$addr}}" onclick="showEditModal(this)" class="modal-trigger waves-effect waves-light btn">Edit</a>
                                    <a href="#remove_addr_modal" data-perm-id="{{$addr->id}}" onclick="showRemoveModal(this)" class="modal-trigger waves-effect waves-light btn">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_addr_modal" class="modal modal-footer">
    <form id="create_offaddr_form" class="col s12">
        <div class="modal-content">
            <h4>New Offload Address</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="n_offload_name" name="n_offload_name" type="text" class="required">
                    <label for="n_offload_name">Offload Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="n_address_1" name="n_address_1" type="text" class="required">
                    <label for="n_address_1">Address</label>
                </div>
                <div class="input-field col s12">
                    <input id="n_address_2" name="n_address_2" type="text">
                    <label for="n_address_2">Address (Optional)</label>
                </div>
                <div class="input-field col s12">
                    <input id="n_address_3" name="n_address_3" type="text">
                    <label for="n_address_3">Address (Optional)</label>
                </div>
                <div class="input-field col s12">
                    <input id="n_city" name="n_city" type="text" class="required">
                    <label for="n_city">City</label>
                </div>
                <div class="input-field col s6">
                    <input id="n_province_1" name="n_province_1" type="text" class="required">
                    <label for="n_province_1">Province</label>
                </div>
                <div class="input-field col s6">
                    <input id="n_province_2" name="n_province_2" type="text">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="createOffloadAddress()">Create</a>
        </div>
    </form>
</div>

<div id="edit_addr_modal" class="modal modal-footer">
    <form id="edit_offaddr_form" class="col s12">
        <div class="modal-content">
            <h4>Edit Offload Address</h4>
            <div class="row">
                <input id="e_offloadAddr_id" type="hidden">
                <div class="input-field col s12">
                    <input id="e_offload_name" name="e_offload_name" type="text" class="required" placeholder="">
                    <label for="e_offload_name">Offload Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="e_address_1" name="e_address_1" type="text" class="required" placeholder="">
                    <label for="e_address_1">Address</label>
                </div>
                <div class="input-field col s12">
                    <input id="e_address_2" name="e_address_2" type="text" placeholder="">
                    <label for="e_address_2">Address (Optional)</label>
                </div>
                <div class="input-field col s12">
                    <input id="e_address_3" name="e_address_3" type="text" placeholder="">
                    <label for="e_address_3">Address (Optional)</label>
                </div>
                <div class="input-field col s12">
                    <input id="e_city" name="e_city" type="text" class="required" placeholder="">
                    <label for="e_city">City</label>
                </div>
                <div class="input-field col s6">
                    <input id="e_province_1" name="e_province_1" type="text" class="required" placeholder="">
                    <label for="e_province_1">Province</label>
                </div>
                <div class="input-field col s6">
                    <input id="e_province_2" name="e_province_2" type="text" placeholder="">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="editOffloadAddress()">Edit</a>
        </div>
    </form>
</div>

<div id="remove_addr_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Remove Offload Address</h4>
            <input id="remove_offloadAddr_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="removeOffloadAddress()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    var loadAddressTable = $('#offloadAddressList').DataTable({
        language: {
            searchPlaceholder: 'Search Addresses',
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

    $('#create_offaddr_form').validate({
        rules:{
            n_offload_name: "required",
            n_address_1: "required",
            n_city: "required",
            n_province_1: "required"
        }
    });

    $('#edit_offaddr_form').validate({
        rules:{
            e_offload_name: "required",
            e_address_1: "required",
            e_city: "required",
            e_province_1: "required"
        }
    });
});
</script>
@endpush

@push('javascript')
<script>
function createOffloadAddress()
{
    if(!$('#create_offaddr_form').valid()){
        return;
    }

    var n_offload_name = $('#n_offload_name').val();
    var n_address_1 = $('#n_address_1').val();
    var n_address_2 = $('#n_address_2').val();
    var n_address_3 = $('#n_address_3').val();
    var n_city = $('#n_city').val();
    var n_province_1 = $('#n_province_1').val();
    var n_province_2 = $('#n_province_2').val();

    $.ajax({
        url: "{{url('offloadAddrs/create')}}",
        type: "POST",
        data: {n_offload_name, n_address_1, n_address_2, n_address_3, n_city, n_province_1, n_province_2},
        success: function(response) {
            if(response['success'] > 0){
                Materialize.toast('Success - Saved!!!', 2000, 'green rounded');
                location.reload();
            }
            else{
                Materialize.toast('Error- Not Saved!!!', 2000, 'red rounded');
            }
        }
    });
}

function editOffloadAddress()
{
    if(!$('#edit_offaddr_form').valid()){
        return;
    }

    var e_offloadAddr_id = $('#e_offloadAddr_id').val();
    var e_offload_name = $('#e_offload_name').val();
    var e_address_1 = $('#e_address_1').val();
    var e_address_2 = $('#e_address_2').val();
    var e_address_3 = $('#e_address_3').val();
    var e_city = $('#e_city').val();
    var e_province_1 = $('#e_province_1').val();
    var e_province_2 = $('#e_province_2').val();

    $.ajax({
        url: "{{url('offloadAddrs/edit')}}",
        type: "POST",
        data: {e_offloadAddr_id, e_offload_name, e_address_1, e_address_2, e_address_3, e_city, e_province_1, e_province_2},
        success: function(response) {
            if(response['success'] > 0){
                Materialize.toast('Success - Edited!!!', 2000, 'green rounded');
                location.reload();
            }
            else{
                Materialize.toast('Error- Not Edited!!!', 2000, 'red rounded');
            }
        }
    });
}

function removeOffloadAddress()
{
    var remove_offloadAddr_id = $('#remove_offloadAddr_id').val();

    $.ajax({
        url: "{{url('offloadAddrs/remove')}}",
        type: "POST",
        data: {remove_offloadAddr_id},
        success: function(response) {
            if(response['success'] == 1){
                Materialize.toast('Success- Removed!!!', 2000, 'green rounded');
                location.reload();
            }
            else{
                Materialize.toast('Error- Not Removed!!!', 2000, 'red rounded');
            }
        }
    });
}


function showEditModal(obj)
{
    var item = $(obj).data('perm-item');
    $('#e_offloadAddr_id').val(item['id']);
    $('#e_offload_name').val(item['name']);
    $('#e_address_1').val(item['address1']);
    $('#e_address_2').val(item['address2']);
    $('#e_address_3').val(item['address3']);
    $('#e_city').val(item['city']);
    $('#e_province_1').val(item['province1']);
    $('#e_province_2').val(item['province2']);
}

function showRemoveModal(obj)
{
    var id = $(obj).data('perm-id');
    $('#remove_offloadAddr_id').val(id);
}
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
@endpush
@endsection
