@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Transporter')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">List All Transporters</div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_transporter_modal" class="modal-trigger waves-effect waves-light btn">Create New Transporter</a>
                </span>
                <table id="all_transporters" class="display responsive-table">
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
                        @foreach ($transporters as $transporter)
                            <tr>
                                <td style="display:none;">{{$transporter->id}}</td>
                                <td>{{$transporter->account_no}}</td>
                                <td >{{$transporter->name}}</td>
                                <td>{{$transporter->address1}}</td>
                                <td>
                                    <a href="#edit_transporter_modal" data-perm-item="{{$transporter}}" onclick="showEditModal(this)" class="modal-trigger waves-effect waves-light btn">Edit</a>
                                    <a href="#remove_transporter_modal" data-perm-id="{{$transporter->id}}" onclick="showRemoveModal(this)" class="modal-trigger waves-effect waves-light btn">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_transporter_modal" class="modal modal-footer">
    <form id="create_transporter_form" class="col s12">
        <div class="modal-content">
            <h4>New Transporter</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="account_no" name="account_no" type="text" class="required">
                    <label for="account_no">Account No</label>
                </div>
                <div class="input-field col s12">
                    <input id="transporter_name" name="transporter_name" type="text" class="required">
                    <label for="transporter_name">Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="transporter_address1" name="transporter_address1" type="text" class="required">
                    <label for="transporter_address1">Street Address</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="createTransporter()">Create</a>
        </div>
    </form>
</div>

<div id="edit_transporter_modal" class="modal modal-footer">
    <form id="edit_transporter_form" class="col s12">
        <div class="modal-content">
            <h4>Edit Transporter</h4>
            <div class="row">
                <input id="edit_transporter_id" type="hidden">
                <div class="input-field col s12">
                    <input id="edit_account_no" name="edit_account_no" type="text" class="required" placeholder="">
                    <label for="edit_account_no">Account No</label>
                </div>
                <div class="input-field col s12">
                    <input id="edit_transporter_name" name="edit_transporter_name" type="text" class="required" placeholder="">
                    <label for="edit_transporter_name">Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="edit_transporter_address1" name="edit_transporter_address1" type="text" class="required" placeholder="">
                    <label for="edit_transporter_address1">Street Address</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="editTransporter()">Edit</a>
        </div>
    </form>
</div>

<div id="remove_transporter_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Remove Transporter</h4>
            <input id="remove_transporter_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="removeTransporter()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    var allTransporterTable = $('#all_transporters').DataTable({
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

    $('#create_transporter_form').validate({
        rules:{
            account_no: "required",
            transporter_name: "required",
            transporter_address1: "required"
        }
    });

    $('#edit_transporter_form').validate({
        rules:{
            edit_account_no: "required",
            edit_transporter_name: "required",
            edit_transporter_address1: "required"
        }
    });
});
</script>
@endpush

@push('javascript')
<script>
function createTransporter()
{
    if(!$('#create_transporter_form').valid()){
        return;
    }

    var account_no = $('#account_no').val();
    var transporter_name = $('#transporter_name').val();
    var transporter_address1 = $('#transporter_address1').val();

    $.ajax({
        url: "{{url('transporter/create')}}",
        type: "POST",
        data: {account_no, transporter_name, transporter_address1},
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

function editTransporter()
{
    if(!$('#edit_transporter_form').valid()){
        return;
    }

    var edit_transporter_id = $('#edit_transporter_id').val();
    var edit_account_no = $('#edit_account_no').val();
    var edit_transporter_name = $('#edit_transporter_name').val();
    var edit_transporter_address1 = $('#edit_transporter_address1').val();

    $.ajax({
        url: "{{url('transporter/edit')}}",
        type: "POST",
        data: {edit_transporter_id, edit_account_no, edit_transporter_name, edit_transporter_address1},
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

function removeTransporter()
{
    var remove_transporter_id = $('#remove_transporter_id').val();

    $.ajax({
        url: "{{url('transporter/remove')}}",
        type: "POST",
        data: {remove_transporter_id},
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
    $('#edit_transporter_id').val(item['id']);
    $('#edit_account_no').val(item['account_no']);
    $('#edit_transporter_name').val(item['name']);
    $('#edit_transporter_address1').val(item['address1']);
}

function showRemoveModal(obj)
{
    var id = $(obj).data('perm-id');
    $('#remove_transporter_id').val(id);
}
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
@endpush
@endsection
