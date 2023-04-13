@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Administrator')
@section('content')
<div class="row">
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_admin_modal" class="modal-trigger waves-effect waves-light btn">Create New User</a>
                </span>
                <table id="admins" class="display responsive-table">
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
                        @foreach ($admins as $admin)
                            <tr>
                                <td style="display:none">{{$admin->id}}</td>
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->email}}</td>
                                <td>{{$admin->level}}</td>
                                <td>
                                    <a href="#remove_admin_modal" data-perm-id="{{$admin->id}}" onclick="showRemoveModal(this)" class="modal-trigger waves-effect waves-light btn">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_admin_modal" class="modal modal-footer">
    <form id="new_user_form" class="col s12">
        <div class="modal-content">
            <h4>New User</h4>
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
            <a class="modal-action waves-effect waves-green btn-flat" onclick="createUser()">Create</a>
        </div>
    </form>
</div>

<div id="remove_admin_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Remove User</h4>
            <input id="remove_user_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="removeUser()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    $("#new_user_form").validate({
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
});

function showRemoveModal(obj)
{
    var id = $(obj).data('perm-id');
    $('#remove_user_id').val(id);
}

function createUser()
{
    if ($('#new_user_form').valid())
    {
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: "{{url('user/newUser')}}",
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

function removeUser()
{
    var remove_user_id = $('#remove_user_id').val();

    $.ajax({
        url: "{{url('user/removeUser')}}",
        type: "POST",
        data: {remove_user_id},
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
@endpush
@endsection
