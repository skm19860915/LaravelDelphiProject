@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
@endpush
@extends('layouts.master')
@section('title', 'Container')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">Containers</div>
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <span class="card-title">
                    <a href="#create_container_modal" class="modal-trigger waves-effect waves-light btn">Create New Container</a>
                    <a class="waves-effect waves-light btn" onclick="exportExcel()">Export Tracking Container</a>
                </span>
                <table id="all_containers" class="display responsive-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th >Name</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th >Name</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($containers as $container)
                            <tr>
                                <td>{{$container->id}}</td>
                                <td >{{$container->name}}</td>
                                <td>
                                    <a href="#edit_container_modal" data-perm-item="{{$container}}" onclick="showEditModal(this)" class="modal-trigger waves-effect waves-light btn">Edit</a>
                                    <a href="#remove_container_modal" data-perm-id="{{$container->id}}" onclick="showRemoveModal(this)" class="modal-trigger waves-effect waves-light btn">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="create_container_modal" class="modal modal-footer">
    <form id="create_container_form" class="col s12">
        <div class="modal-content">
            <h4>New Container</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="container_name" name="container_name" type="text" class="required">
                    <label for="container_name">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="createContainer()">Create</a>
        </div>
    </form>
</div>

<div id="edit_container_modal" class="modal modal-footer">
    <form id="edit_container_form" class="col s12">
        <div class="modal-content">
            <h4>Edit Container</h4>
            <div class="row">
                <input id="edit_container_id" type="hidden">
                <div class="input-field col s12">
                    <input id="edit_container_name" name="edit_container_name" type="text" class="required" placeholder="">
                    <label for="edit_container_name">Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action waves-effect waves-green btn-flat" onclick="editContainer()">Edit</a>
        </div>
    </form>
</div>

<div id="remove_container_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Remove Container</h4>
            <input id="remove_container_id" type="hidden">
            <p>Are you sure?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">No</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" onclick="removeContainer()">Yes</a>
        </div>
    </form>
</div>

@push('javascript')
<script>
$(document).ready(function() {
    var allClientTable = $('#all_containers').DataTable({
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

    $('#create_container_form').validate({
        rules:{
            container_name: "required",
        }
    });

    $('#edit_container_form').validate({
        rules:{
            edit_container_name: "required"
        }
    });
});
</script>
@endpush

@push('javascript')
<script>
function exportExcel()
{
    window.location.href = "{{route('container.export')}}";
}

function createContainer()
{
    if(!$('#create_container_form').valid()){
        return;
    }

    var container_name = $('#container_name').val();

    $.ajax({
        url: "{{url('container/create')}}",
        type: "POST",
        data: {container_name},
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

function editContainer()
{
    if(!$('#edit_container_form').valid()){
        return;
    }

    var edit_container_id = $('#edit_container_id').val();
    var edit_container_name = $('#edit_container_name').val();

    $.ajax({
        url: "{{url('container/edit')}}",
        type: "POST",
        data: {edit_container_id, edit_container_name},
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

function removeContainer()
{
    var remove_container_id = $('#remove_container_id').val();

    $.ajax({
        url: "{{url('container/remove')}}",
        type: "POST",
        data: {remove_container_id},
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
    $('#edit_container_id').val(item['id']);
    $('#edit_container_name').val(item['name']);
}
function showRemoveModal(obj)
{
    var id = $(obj).data('perm-id');
    $('#remove_container_id').val(id);
}
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
@endpush
@endsection
