@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Customer')
@section('content')
<div class="row">
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_customer_modal" class="modal-trigger waves-effect waves-light btn">Create New Supplier</a>
                </span>
                <table id="customers" class="display responsive-table">
                    <thead>
                        <tr>
                            <th style="display:none">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Authorization</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="display:none">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Authorization</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td style="display:none">{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->level}}</td>
                                <td>
                                    <a href="#edit_customer_modal" data-perm-item="{{$customer}}" onclick="showEditModal(this)" class="modal-trigger waves-effect waves-light btn">Edit</a>
                                    <a href="#remove_customer_modal" data-perm-id="{{$customer->id}}" onclick="showRemoveModal(this)" class="modal-trigger waves-effect waves-light btn">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_customer_modal" class="modal modal-footer">
    <form id="new_customer_form" class="col s12">
        <div class="modal-content">
            <h4>New Supplier</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" class="requiredvalidate">
                    <label for="name">Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="email" name="email" type="text" class="required validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="required validate">
                </div>
                <div class="input-field col s12">
                    <label for="confirm">Confirm password</label>
                    <input id="confirm" name="confirm" type="password" class="required validate">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="createCustomer()">Create</a>
        </div>
    </form>
</div>

<div id="edit_customer_modal" class="modal modal-footer">
    <form id="edit_customer_form" class="col s12">
        <div class="modal-content">
            <h4>Edit Supplier</h4>
            <div class="row">
                <input id="edit_user_id" type="hidden">
                <div class="input-field col s12">
                    <input id="edit_name" name="edit_name" type="text" class="required validate" placeholder="">
                    <label for="edit_name">Name</label>
                </div>
                <div class="input-field col s12">
                    <input id="edit_email" name="edit_email" type="text" class="required validate" placeholder="">
                    <label for="edit_email">Email</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="editCustomer()">Edit</a>
        </div>
    </form>
</div>

<div id="remove_customer_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Remove Supplier</h4>
            <input id="remove_customer_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="removeCustomer()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    $("#new_customer_form").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            confirm: {
                equalTo: "#password"
            }
        }
    });

    $("#edit_customer_form").validate({
        rules: {
            edit_name: {
                required: true
            },
            edit_email: {
                required: true,
                email: true
            }
        }
    });
});
</script>
@endpush

@push('javascript')
<script>
function showEditModal(obj)
{
    var item = $(obj).data('perm-item');
    $('#edit_user_id').val(item['id']);
    $('#edit_name').val(item['name']);
    $('#edit_email').val(item['email']);
}

function showRemoveModal(obj)
{
    var id = $(obj).data('perm-id');
    $('#remove_customer_id').val(id);
}

function createCustomer()
{
    if ($('#new_customer_form').valid())
    {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: "{{url('user/newCustomer')}}",
            type: "POST",
            data: {name, email, password},
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
}

function editCustomer()
{
    if ($('#edit_customer_form').valid())
    {
        var edit_user_id = $('#edit_user_id').val();
        var edit_name = $('#edit_name').val();
        var edit_email = $('#edit_email').val();

        $.ajax({
            url: "{{url('user/editCustomer')}}",
            type: "POST",
            data: {edit_user_id, edit_name, edit_email},
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
}

function removeCustomer()
{
    var remove_customer_id = $('#remove_customer_id').val();

    $.ajax({
        url: "{{url('user/removeCustomer')}}",
        type: "POST",
        data: {remove_customer_id},
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
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/tables/users.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
    <script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
@endpush
@endsection
