function getAllTransporters(url, id)
{
    $.ajax({
        url: url + '/all',
        type: "GET",
        success: function(response) {
            if(response['success']){
                var transporter_list = response['success'].map(item => { return { id:item.id, text:item.name }});
                $(".transporter-list").select2({ data: transporter_list });
                $('#gi_to').select2().select2("val", id);
            }
            else{
                $(".transporter-list").select2({ data: null });
            }
        }
    });
}

function getAllVehicleTypes(url, type_id)
{
    $(".vehicle-type-list").empty();

    $.ajax({
        url: url + '/get',
        type: "GET",
        success: function(response) {
            if(response){
                var vehicle_types = response.map(item => { return { id:item.id, text:item.name }});
                $(".vehicle-type-list").select2({ data: vehicle_types });
                $('#v_type_id').select2().select2("val", type_id);
            }
        }
    });
}

function showVehicleTypeList(ele)
{
    var api_url = $(ele).data('url');
    var html = '';

    $.ajax({
        url: api_url + '/get',
        type: "GET",
        success: function(response) {
            if(response){
                $.each(response, function(index, value){
                    //console.log(index, value);
                    html += '<div style="display: flex; justify-content: space-between;" class="vehicle-elements">' +
                        '<input id="' + value.id + '" name="vehtype_name" type="text" value="' + value.name + '">' +
                        '<a onclick="deleteVehicleType(this, \'' + api_url + '\', \'' + value.id + '\')" class="waves-effect waves-light btn">Delete</a></div>'
                });

                $('#vehtypes').html(html);
            }
        }
    });
}

function createVehicleType(ele)
{
    if(!$('#vehtype_form').valid()){
        return;
    }

    var vehicle_type_name = $('#vehicle_type_name').val();
    var api_url = $(ele).data('url');

    $.ajax({
        url: api_url + '/create',
        type: "POST",
        data: {vehicle_type_name},
        success: function(response) {
            if(response > 1){
                Materialize.toast('Success - Saved!!!', 2000, 'green rounded');
                getAllVehicleTypes(api_url, response);
            }
            else{
                Materialize.toast('Error- Not Saved!!!', 2000, 'red rounded');
            }
        }
    });
}

function updateVehicleTypes(ele)
{
    var obj = {};

    $('div[id="vehtypes"]>div[class="vehicle-elements"]>input').each(function(){
        var value = $(this).val();
        var id = $(this).attr('id');
        obj[id] = value;
    });

    var current_vehtype_id = $("#v_type_id option:selected").val();
    var api_url = $(ele).attr('data-url');

    $.ajax({
        url: api_url + '/update',
        type: "POST",
        data: JSON.stringify(obj),
        contentType: "application/json",
        dataType: "json",
        success: function(response) {
            getAllVehicleTypes(api_url, current_vehtype_id);
        }
    });
}

function deleteVehicleType(ele, url, id)
{
    var current_vehtype_id = $("#v_type_id option:selected").val();
    if(current_vehtype_id == id){
        Materialize.toast("Can't delete this vehicle type because it has been already used in order.", 2000, 'red');
        return;
    }

    $.ajax({
        url: url + '/delete/' + id,
        type: "DELETE",
        success: function(response) {
            Materialize.toast(response.message, 2000, response.style);

            if(response.status == 'success'){
                $(ele).parent().empty();
                getAllVehicleTypes(url, current_vehtype_id);
            }
        },
        error: function(error) {
        }
    });
}

function showEquipmentList(ele)
{
    var api_url = $(ele).data('url');
    var html = '';

    $.ajax({
        url: api_url + '/get',
        type: "GET",
        success: function(response) {
            if(response){
                $.each(response, function(index, value){
                    //console.log(index, value);
                    html += '<div style="display: flex; justify-content: space-between;" class="equipment-elements">' +
                        '<input id="' + value.id + '" name="equipment_name" type="text" value="' + value.name + '">' +
                        '<a onclick="deleteEquipment(this, \'' + api_url + '\', \'' + value.id + '\')" class="waves-effect waves-light btn">Delete</a></div>'
                });

                $('#equipments').html(html);
            }
        }
    });
}

function createEquipment(ele)
{
    if(!$('#equipment_form').valid()){
        return;
    }

    var equipment_name = $('#equipment_name').val();
    var api_url = $(ele).data('url');

    $.ajax({
        url: api_url + '/create',
        type: "POST",
        data: {equipment_name},
        success: function(response) {
            if(response){
                Materialize.toast('Success - Saved!!!', 2000, 'green rounded');

                var new_ele = '<div class="input-field col s12 l1"><p class="p-v-xs"><input type="checkbox" id="gi_' +
                response.id + '" value="' + response.id + '" name="equipment">' +
                '<label for="gi_' + response.id +'">' + response.name + '</label></p></div>';

                $('#equipment_list').append(new_ele);
            }
            else{
                Materialize.toast('Error- Not Saved!!!', 2000, 'red rounded');
            }
        }
    });
}

function updateEquipments(ele)
{
    var obj = {};

    $('div[id="equipments"]>div[class="equipment-elements"]>input').each(function(){
        var value = $(this).val();
        var id = $(this).attr('id');
        obj[id] = value;
    });

    var api_url = $(ele).data('url');

    $.ajax({
        url: api_url + '/update',
        type: "POST",
        data: JSON.stringify(obj),
        contentType: "application/json",
        dataType: "json",
        success: function(response) {
            $.each(response, function(index, value){
                //console.log(index);
                $('div[id="equipment_list"]>div>table>tbody>tr>td[class="p-h-sm"]>p>label').each(function(){
                    var id = $(this).attr('id');
                    if(id == index){
                        $(this).text(value);
                    }
                });
            });
        }
    });
}

function deleteEquipment(ele, url, id)
{
    $.ajax({
        url: url + '/delete/' + id,
        type: "DELETE",
        success: function(response) {
            Materialize.toast(response.message, 2000, response.style);

            if(response.status == 'success'){
                $(ele).parent().empty();

                var del_label = $('div[id="equipment_list"]>div>table>tbody>tr>td[class="p-h-sm"]>p>label[id=' + id + ']');
                del_label.closest('td').remove();
            }
        },
        error: function(error) {
        }
    });
}

function updateLoadAddress(ele)
{
    var old_info = $(ele).data('info');
    var api_url = $(ele).data('url');

    var l_name = $('#l_name').val();
    var l_address1 = $('#l_address1').val();
    var l_address2 = $('#l_address2').val();
    var l_address3 = $('#l_address3').val();
    var l_city = $('#l_city').val();
    var l_province1 = $('#l_province1').val();
    var l_province2 = $('#l_province2').val();

    var is_changed = false;

    if(old_info.name){
        if(old_info.name !== l_name){
            is_changed = true;
        }
    }
    else{
        if(l_name){
            is_changed = true;
        }
    }

    if(old_info.address1){
        if(old_info.address1 !== l_address1){
            is_changed = true;
        }
    }
    else{
        if(l_address1){
            is_changed = true;
        }
    }

    if(old_info.address2){
        if(old_info.address2 !== l_address2){
            is_changed = true;
        }
    }
    else{
        if(l_address2){
            is_changed = true;
        }
    }

    if(old_info.address3){
        if(old_info.address3 !== l_address3){
            is_changed = true;
        }
    }
    else{
        if(l_address3){
            is_changed = true;
        }
    }

    if(old_info.city){
        if(old_info.city !== l_city){
            is_changed = true;
        }
    }
    else{
        if(l_city){
            is_changed = true;
        }
    }

    if(old_info.province1){
        if(old_info.province1 !== l_province1){
            is_changed = true;
        }
    }
    else{
        if(l_province1){
            is_changed = true;
        }
    }

    if(old_info.province2){
        if(old_info.province2 !== l_province2){
            is_changed = true;
        }
    }
    else{
        if(l_province2){
            is_changed = true;
        }
    }

    if(is_changed){
        var url = '';
        var data = null;
        if (confirm("Your address has been changed. Do you want to save this as new address?")) {
            var n_load_name = l_name;
            var n_address_1 = l_address1;
            var n_address_2 = l_address2;
            var n_address_3 = l_address3;
            var n_city = l_city;
            var n_province_1 = l_province1;
            var n_province_2 = l_province2;

            url = api_url + '/create';
            data = {n_load_name, n_address_1, n_address_2, n_address_3, n_city, n_province_1, n_province_2};
        }
        else {
            var e_loadAddr_id = old_info.id;
            var e_load_name = l_name;
            var e_address_1 = l_address1;
            var e_address_2 = l_address2;
            var e_address_3 = l_address3;
            var e_city = l_city;
            var e_province_1 = l_province1;
            var e_province_2 = l_province2;

            url = api_url + '/edit';
            data = {e_loadAddr_id, e_load_name, e_address_1, e_address_2, e_address_3, e_city, e_province_1, e_province_2};
        }

        postLoadAddress(url, data);
    }
    else{
        console.log('not changed load address')
    }
}

function postLoadAddress(url, obj)
{
    $.ajax({
        url: url,
        type: "POST",
        data: obj,
        success: function(response) {
            if(response['success'] == 1){
                Materialize.toast('Success - Saved!!!', 2000, 'green rounded');
            }
            else{
                Materialize.toast('Error- Not Saved!!!', 2000, 'red rounded');
            }
        }
    });
}
