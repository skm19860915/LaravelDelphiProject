@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Client')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">List All Clients</div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_client_modal" class="modal-trigger waves-effect waves-light btn">Create New Client</a>
                </span>
                <table id="all_clients" class="display responsive-table">
                    <thead>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Account No</th>
                            <th >Name</th>
                            <th>Street Address</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Account No</th>
                            <th >Name</th>
                            <th>Street Address</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td style="display:none;">{{$client->id}}</td>
                                <td>{{$client->account_no}}</td>
                                <td >{{$client->name}}</td>
                                <td>{{$client->address1}}</td>
                                <td>
                                    <a href="#edit_client_modal" data-perm-item="{{$client}}" onclick="showEditModal(this)" class="modal-trigger waves-effect waves-light btn">Edit</a>
                                    <a href="#remove_client_modal" data-perm-id="{{$client->id}}" onclick="showRemoveModal(this)" class="modal-trigger waves-effect waves-light btn">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_client_modal" class="modal modal-footer">
    <form id="create_client_form" class="col s12">
        <div class="modal-content">
            <h4>New Client</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="account_no" name="account_no" type="text" class="required">
                    <label for="account_no">Account No</label>
                </div>
                <div class="input-field col s12">
                    <input id="client_name" name="client_name" type="text" class="required">
                    <label for="client_name">Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="client_address1" name="client_address1" type="text" class="required">
                    <label for="client_address1">Street Address</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="createClient()">Create</a>
        </div>
    </form>
</div>

<div id="edit_client_modal" class="modal modal-footer">
    <form id="edit_client_form" class="col s12">
        <div class="modal-content">
            <h4>Edit Client</h4>
            <div class="row">
                <input id="edit_client_id" type="hidden">
                <div class="input-field col s12">
                    <input id="edit_account_no" name="edit_account_no" type="text" class="required" placeholder="">
                    <label for="edit_account_no">Account No</label>
                </div>
                <div class="input-field col s12">
                    <input id="edit_client_name" name="edit_client_name" type="text" class="required" placeholder="">
                    <label for="edit_client_name">Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="edit_client_address1" name="edit_client_address1" type="text" class="required" placeholder="">
                    <label for="edit_client_address1">Street Address</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="editClient()">Edit</a>
        </div>
    </form>
</div>

<div id="remove_client_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Remove Client</h4>
            <input id="remove_client_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="removeClient()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    var allClientTable = $('#all_clients').DataTable({
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

    $('#create_client_form').validate({
        rules:{
            account_no: "required",
            client_name: "required",
            client_address1: "required"
        }
    });

    $('#edit_client_form').validate({
        rules:{
            edit_account_no: "required",
            edit_client_name: "required",
            edit_client_address1: "required"
        }
    });
});
</script>
@endpush

@push('javascript')
<script>
function createClient()
{
    if(!$('#create_client_form').valid()){
        return;
    }

    var account_no = $('#account_no').val();
    var client_name = $('#client_name').val();
    var client_address1 = $('#client_address1').val();

    $.ajax({
        url: "{{url('client/create')}}",
        type: "POST",
        data: {account_no, client_name, client_address1},
        success: function(response) {
            if(response['success'] == 1){
                Materialize.toast('Success - Saved!!!', 2000, 'green rounded');
                location.reload();
            }
            else{
                Materialize.toast('Error- Not Saved!!!', 2000, 'red rounded');
            }
        }
    });
}

function editClient()
{
    if(!$('#edit_client_form').valid()){
        return;
    }

    var edit_client_id = $('#edit_client_id').val();
    var edit_account_no = $('#edit_account_no').val();
    var edit_client_name = $('#edit_client_name').val();
    var edit_client_address1 = $('#edit_client_address1').val();

    $.ajax({
        url: "{{url('client/edit')}}",
        type: "POST",
        data: {edit_client_id, edit_account_no, edit_client_name, edit_client_address1},
        success: function(response) {
            if(response['success'] == 1){
                Materialize.toast('Success - Edited!!!', 2000, 'green rounded');
                location.reload();
            }
            else{
                Materialize.toast('Error- Not Edited!!!', 2000, 'red rounded');
            }
        }
    });
}

function removeClient()
{
    var remove_client_id = $('#remove_client_id').val();

    $.ajax({
        url: "{{url('client/remove')}}",
        type: "POST",
        data: {remove_client_id},
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
    $('#edit_client_id').val(item['id']);
    $('#edit_account_no').val(item['account_no']);
    $('#edit_client_name').val(item['name']);
    $('#edit_client_address1').val(item['address1']);
}
function showRemoveModal(obj)
{
    var id = $(obj).data('perm-id');
    $('#remove_client_id').val(id);
}
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
@endpush
@endsection
