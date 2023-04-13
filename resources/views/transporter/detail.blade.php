@push('styles')
    <link href="{{asset('plugins/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/select2/css/select2.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/google-code-prettify/prettify.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #confirmationTable thead{
            visibility: collapse;
        }
    </style>
@endpush
@extends('layouts.master')
@section('title', 'Tranporter')
@section('content')
<div class="row">
    <div class="col s6 m6 l6">
        <div class="page-title">UC Transporter Details</div>
        <input id="transporter_order_id" type="hidden" value="{{$id}}">
    </div>
    <div class="col s6 m6 l6">
        <!-- <div class="page-title right"><a href="{{url('/order/detail/'.$order->id)}}">Back</a></div> -->
        <div class="page-title right"><a href="{{url('/order/all')}}">Back</a></div>
    </div>
</div>
<div class="row">
    <div class="col s12 l12">
        <a href="#load_confirmation_modal" class="modal-trigger waves-effect waves-light btn">
            <i class="material-icons left" style="margin-right:10px !important;">visibility</i>Load Confirmation
        </a>
        <!-- <div class="card">
            <div class="card-content">
                <span class="card-title">Load Confirmation</span>
                <table id="confirmationTable" class="cell-border" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Load At</th>
                            <th>Offload At</th>
                            <th>Att</th>
                            <th>Description</th>
                            <th>Weight</th>
                            <th>Abnormal</th>
                            <th>Additional Instruction</th>
                            <th>Reqd</th>
                            <th>Insurance</th>
                            <th>Rate</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Dimension</th>
                            <th>Vehicle Name</th>
                            <th>Transporter Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($confirmationList as $confirmation)
                        <tr>
                            <td>UC {{$confirmation->order_id}}</td>
                            <td>{{$confirmation->l_name}}</td>
                            <td>{{$confirmation->o_name}}</td>
                            <td>{{$confirmation->gi_att}}</td>
                            <td>{{$confirmation->gi_desc}}</td>
                            <td>{{$confirmation->gi_tons}} kg</td>
                            <td>{{($confirmation->gi_abnormal == 1) ? 'true' : 'false'}}</td>
                            <td>{{$confirmation->gi_instruction}}</td>
                            <td>{{($confirmation->gi_reqd == 1) ? 'true' : 'false'}}</td>
                            <td>{{$confirmation->gi_value}} {{$confirmation->gi_currency}}</td>
                            <td>{{$confirmation->gi_rate}} {{$confirmation->gi_terms}}</td>
                            <td>{{$confirmation->v_l}}</td>
                            <td>{{$confirmation->v_w}}</td>
                            <td>{{$confirmation->v_h}}</td>
                            <td>{{$confirmation->v_add_dimension}}</td>
                            <td>{{$confirmation->v_name}}</td>
                            <td>{{$confirmation->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
</div>
<div class="row">
    <div class="col s12">
        <ul class="tabs z-depth-1">
            <li id="general_info_tab" class="tab"><a href="#general_info_div" id="general_info_link" class="active">General Info</a></li>
            <li id="vehicle_tab" class="tab disabled"><a href="#vehicle_div" id="vehicle_link">Vehicle</a></li>
            <li id="load_at_tab" class="tab disabled"><a href="#load_at_div" id="load_at_link">Load At</a></li>
            <li id="offload_at_tab" class="tab disabled"><a href="#offload_at_div" id="offload_at_link">Offload At</a></li>
        </ul>
    </div>
    <div id="general_info_div" class="col s12">
        <form id="general_info_form" class="row grey lighten-2">
            <div class="col s12 l7">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="gi_to" class="transporter-list js-states browser-default" tabindex="-1" style="width: 100%"></select>
                                <label for="gi_to" class="active">To</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="gi_from" name="gi_from" type="text" value="{{Auth::user()->name}}">
                                <input id="gi_from_id" name="gi_from_id" type="hidden" value="{{Auth::user()->id}}">
                                <label for="gi_from">From</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="gi_att" name="gi_att" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->gi_att : ''}}">
                                <label for="gi_att">Att</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Commodity</span>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="gi_desc" name="gi_desc" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->gi_desc : ''}}">
                                <label for="gi_desc">Desc</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="gi_tons" name="gi_tons" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->gi_tons : ''}}">
                                <label for="gi_tons">Tons</label>
                            </div>
                            <div class="input-field col s4">
                                <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
                            </div>
                            <div class="input-field col s7">
                                <p class="p-v-xs">
                                @if (!empty($transporter_order_detail) && $transporter_order_detail->gi_abnormal == 1)
                                    <input type="checkbox" id="gi_abnormal" name="gi_abnormal" checked>
                                @else
                                    <input type="checkbox" id="gi_abnormal" name="gi_abnormal">
                                @endif
                                    <label for="gi_abnormal">Abnormal Load</label>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Note</span>
                        <div class="row">
                            <div class="input-field col s12 m-b-sm">
                                <input id="gi_instruction" name="gi_instruction" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->gi_instruction : ''}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l5">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s6">
                                <input disabled id="gi_order_no" name="gi_order_no" type="text" style="color:black;" value="{{$order->id}}">
                                <label for="gi_order_no" class="active">Order No</label>
                            </div>
                            <div class="input-field col s6">
                                <select id="gi_extension" name="gi_extension" class="browser-default" tabindex="-1">
                                    @if (!empty($transporter_order_detail))
                                    <option value="A" {{( $transporter_order_detail->gi_extension == 'A') ? 'selected' : '' }}>A</option>
                                    <option value="B" {{( $transporter_order_detail->gi_extension == 'B') ? 'selected' : '' }}>B</option>
                                    <option value="C" {{( $transporter_order_detail->gi_extension == 'C') ? 'selected' : '' }}>C</option>
                                    <option value="D" {{( $transporter_order_detail->gi_extension == 'D') ? 'selected' : '' }}>D</option>
                                    <option value="E" {{( $transporter_order_detail->gi_extension == 'E') ? 'selected' : '' }}>E</option>
                                    @else
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    @endif
                                </select>
                                <label for="gi_extension" class="active">Extension</label>
                            </div>
                            @if (!empty($transporter_order_detail))
                            <input type="hidden" id="gi_extension_original" value="{{$transporter_order_detail->gi_extension}}">
                            @else
                            <input type="hidden" id="gi_extension_original" value="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Goods in Transit Insurance</span>
                        <div class="row">
                            <div class="input-field col s4">
                                <p class="p-v-xs">
                                    @if (!empty($transporter_order_detail) && $transporter_order_detail->gi_reqd == 1)
                                    <input type="checkbox" id="gi_reqd" name="gi_reqd" checked>
                                    @else
                                    <input type="checkbox" id="gi_reqd" name="gi_reqd">
                                    @endif
                                    <label for="gi_reqd">Reqd</label>
                                </p>
                            </div>
                            <div class="input-field col s6">
                                <input id="gi_value" name="gi_value" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->gi_value : ''}}">
                                <label for="gi_value">Value</label>
                            </div>
                            <div class="input-field col s2">
                                <select id="gi_currency" name="gi_currency" class="browser-default" tabindex="-1">
                                    @if (!empty($transporter_order_detail))
                                    <option value="ZAR" {{( $transporter_order_detail->gi_currency == 'ZAR') ? 'selected' : '' }}>ZAR</option>
                                    <option value="USD" {{( $transporter_order_detail->gi_currency == 'USD') ? 'selected' : '' }}>USD</option>
                                    @else
                                    <option value="ZAR" selected>ZAR</option>
                                    <option value="USD">USD</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Transporter Rate</span>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="gi_rate" name="gi_rate" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->gi_rate : ''}}">
                                <label for="gi_rate">Rate (Excl VAT)</label>
                            </div>
                            <div class="input-field col s4">
                                <select id="gi_terms" name="gi_terms" class="browser-default" tabindex="-1">
                                    @if (!empty($transporter_order_detail))
                                    <option value="30 Days" {{( $transporter_order_detail->gi_terms == '30 Days') ? 'selected' : '' }}>30 Days</option>
                                    <option value="COD" {{( $transporter_order_detail->gi_terms == 'COD') ? 'selected' : '' }}>COD</option>
                                    <option value="BI MONTHLY" {{( $transporter_order_detail->gi_terms == 'BI MONTHLY') ? 'selected' : '' }}>BI MONTHLY</option>
                                    @else
                                    <option value="30 Days" selected>30 Days</option>
                                    <option value="COD">COD</option>
                                    @endif
                                </select>
                                <label for="gi_terms" class="active">Terms of payment</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="gi_authorised" name="gi_authorised" type="text" value="{{Auth::user()->name}}">
                                <input id="gi_authorised_id" name="gi_authorised_id" type="hidden" value="{{Auth::user()->id}}">
                                <label for="gi_authorised">Authorised By</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="vehicle_div" class="col s12">
        <form id="vehicle_form" class="row grey lighten-2">
            <div class="col s5">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Vehicle Requirements</span>
                        <div class="row">
                            <div class="col s12 m-b-lg">
                                <a href="#create_vehtype_modal" class="modal-trigger waves-effect waves-light btn">Add New Vehicle Type</a>
                                <a href="#control_vehtype_modal" class="modal-trigger waves-effect waves-light btn" data-url="{{url('vehicleType')}}" onclick="showVehicleTypeList(this)">Edit/Delete</a>
                            </div>
                            <div class="input-field col s12" style="margin-bottom:34px;">
                                <select id="v_type_id" name="v_type_id" class="vehicle-type-list js-states browser-default" tabindex="-1" style="width: 100%"></select>
                                <label for="v_type_id" class="active">Type Of Vehicle</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s7">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Dimensions</span>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="v_l" name="v_l" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_l : ''}}">
                                <label for="v_l">L (m)</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="v_w" name="v_w" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_w : ''}}">
                                <label for="v_w">W (m)</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="v_h" name="v_h" type="text" class="required" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_h : ''}}">
                                <label for="v_h">H (m)</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="v_add_dimension" name="v_add_dimension" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_add_dimension : ''}}">
                                <label for="v_add_dimension">Additional dimensions</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Equipment Required</span>
                        <div id="equipment_list" class="row">
                            <div class="col s12">
                                <a href="#create_equipment_modal" class="modal-trigger waves-effect waves-light btn">Add New Equipment</a>
                                <a href="#control_equipment_modal" class="modal-trigger waves-effect waves-light btn" data-url="{{url('equipment')}}" onclick="showEquipmentList(this)">Edit/Delete</a>
                            </div>
                            <div>
                                <table style="width:fit-content">
                                    <tbody>
                                        <tr>
                                        @if (!empty($transporter_order_detail) && !empty($select_equipments))
                                            @foreach ($equipments as $equipment)
                                                <td class="p-h-sm">
                                                    <p class="p-v-xs">
                                                        <input type="checkbox" id="gi_{{$equipment->id}}" value="{{$equipment->id}}" name="equipment"
                                                        {{!in_array($equipment->id, $select_equipments) ? '' : 'checked'}}>
                                                        <label id="{{$equipment->id}}" for="gi_{{$equipment->id}}">{{$equipment->name}}</label>
                                                    </p>
                                                </td>
                                            @endforeach
                                        @else
                                            @foreach ($equipments as $equipment)
                                            <td class="p-h-sm">
                                                <p class="p-v-xs">
                                                    <input type="checkbox" id="gi_{{$equipment->id}}" value="{{$equipment->id}}" name="equipment">
                                                    <label id="{{$equipment->id}}" for="gi_{{$equipment->id}}">{{$equipment->name}}</label>
                                                </p>
                                            </td>
                                            @endforeach
                                        @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Additional Instruction</span>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="v_container_number" name="v_container_number" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_container_number : ''}}">
                                <label for="v_container_number">Container Number</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="v_driver_name" name="v_driver_name" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_driver_name : ''}}">
                                <label for="v_driver_name">Driver Name</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="v_vessel_name" name="v_vessel_name" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_vessel_name : ''}}">
                                <label for="v_vessel_name">Vessel Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="v_truck" name="v_truck" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_truck : ''}}">
                                <label for="v_truck">Truck Registration</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="v_trailer" name="v_trailer" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_trailer : ''}}">
                                <label for="v_trailer">Trailer Registration</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="v_trailer2" name="v_trailer2" type="text" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->v_trailer2 : ''}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="load_at_div" class="col s12">
        <form id="load_at_form" class="row grey lighten-2">
            <div class="col s12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Load Address</span>
                        <div class="row">
                            <div class="input-field col s8">
                                <input id="load_addr_id" type="hidden" value="{{!empty($select_loadAddr) ? $select_loadAddr->id : ''}}">
                                <input id="l_name" name="l_name" type="text" class="required" value="{{!empty($select_loadAddr) ? $select_loadAddr->name : ''}}" placeholder="">
                                <label for="l_name">Load Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s5">
                                <input id="l_address1" name="l_address1" type="text" class="required" value="{{!empty($select_loadAddr) ? $select_loadAddr->address1 : ''}}" placeholder="">
                                <label for="l_address1">Address</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="l_address2" name="l_address2" type="text" value="{{!empty($select_loadAddr) ? $select_loadAddr->address2 : ''}}" placeholder="">
                            </div>
                            <div class="input-field col s2">
                                <input id="l_address3" name="l_address3" type="text" value="{{!empty($select_loadAddr) ? $select_loadAddr->address3 : ''}}" placeholder="">
                            </div>
                            <div class="input-field col s2">
                                <a href="#load_at_modal" class="modal-trigger waves-effect waves-light btn">
                                    <i class="material-icons">search</i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s5">
                                <input id="l_city" name="l_city" type="text" class="required" value="{{!empty($select_loadAddr) ? $select_loadAddr->city : ''}}" placeholder="">
                                <label for="l_city">City</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="l_province1" name="l_province1" type="text" class="required" value="{{!empty($select_loadAddr) ? $select_loadAddr->province1 : ''}}" placeholder="">
                                <label for="l_province1">Province</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="l_province2" name="l_province2" type="text" value="{{!empty($select_loadAddr) ? $select_loadAddr->province2 : ''}}" placeholder="">
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="input-field col s4">
                                <input placeholder="" id="l_date" name="l_date" class="masked" value="{{$transporter_order_detail->l_date}}" type="text" >
                                <label for="l_date">Load Date</label>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col s4">
                                <label for="l_date2">Load Date</label>
                                <input id="l_date2" type="text" class="datepicker" value="{{$transporter_order_detail->l_date}}">
                            </div>
                            <!-- <div class="col s2">
                                <a class="waves-effect waves-light btn" data-info="{{$select_loadAddr}}" data-url="{{url('loadAddrs')}}" onclick="updateLoadAddress(this)">Save</a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Contact person at Load Address</span>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="l_contact" type="text" class="validate" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->l_contact : ''}}">
                                <label for="l_contact">Contact</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="l_telephone" type="text" class="validate" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->l_telephone : ''}}">
                                <label for="l_telephone">Telephone</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="l_email" type="text" class="validate">
                                <label for="l_email">Email</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="offload_at_div" class="col s12">
        <form id="offload_at_form" class="row grey lighten-2">
            <div class="col s12 l8">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Offload Address</span>
                        <div class="row">
                            <div class="input-field col s10">
                                <input id="offload_addr_id" name="offload_addr_id" type="hidden" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->id : ''}}">
                                <input id="o_name" name="o_name" type="text" class="required" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->name : ''}}" placeholder="">
                                <label for="o_name">Offload Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="o_address1" name="o_address1" type="text" class="required" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->address1 : ''}}" placeholder="">
                                <label for="o_address1">Address</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="o_address2" name="o_address2" type="text" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->address2 : ''}}" placeholder="">
                            </div>
                            <div class="input-field col s3">
                                <input id="o_address3" name="o_address3" type="text" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->address3 : ''}}" placeholder="">
                            </div>
                            <div class="input-field col s2">
                                <a href="#offload_at_modal" class="modal-trigger waves-effect waves-light btn">
                                    <i class="material-icons">search</i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s5">
                                <input id="o_city" name="o_city" type="text" class="required" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->city : ''}}" placeholder="">
                                <label for="o_city">City</label>
                            </div>
                            <div class="input-field col s4">
                                <input id="o_province1" name="o_province1" type="text" class="required" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->province1 : ''}}" placeholder="">
                                <label for="o_province1">Province</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="o_province2" name="o_province2" type="text" value="{{!empty($select_offloadAddr) ? $select_offloadAddr->province2 : ''}}" placeholder="">
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="input-field col s4">
                                <input placeholder="" id="o_date" name="o_date" class="masked" value="{{$transporter_order_detail->o_date}}" type="text" >
                                <label for="o_date">Offload Date</label>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col s4">
                                <label for="o_date2">Offload Date</label>
                                <input id="o_date2" type="text" class="datepicker" value="{{$transporter_order_detail->o_date}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Contact person at Offload Address</span>
                        <div class="row">
                            <div class="input-field col s4">
                                <input id="o_contact" type="text" class="validate" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->o_contact : ''}}">
                                <label for="o_contact">Contact</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="o_telephone" type="text" class="validate" value="{{!empty($transporter_order_detail) ? $transporter_order_detail->o_telephone : ''}}">
                                <label for="o_telephone">Telephone</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="o_email" type="text" class="validate">
                                <label for="o_email">Email</label>
                            </div>
                            <div class="input-field col s2">
                                <a class="waves-effect waves-light btn"><i class="material-icons">search</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">POD Received</span>
                        <div class="row">
                            <div class="input-field col s12">
                                <p class="p-v-xxl"><input type="checkbox" id="o_recd"><label for="o_recd">POD Recd</label></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="input-field col s6 center-align">
                                <a class="waves-effect waves-light btn" onclick="previewPDF()">
                                    <i class="material-icons left" style="margin-right:5px !important;">visibility</i>Preview
                                </a>
                            </div>
                            <div class="input-field col s6 center-align">
                                <a class="waves-effect waves-light btn" onclick="savePDF()">
                                    <i class="material-icons left" style="margin-right:5px !important;">save</i>Save
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6 center-align">
                                <a class="waves-effect waves-light btn" onclick="downloadPDF()">
                                    <i class="material-icons left" style="margin-right:5px !important;">print</i>Print
                                </a>
                            </div>
                            <div class="input-field col s6 center-align">
                                <a class="waves-effect waves-light btn" onclick="emailPDF()">
                                    <i class="material-icons left" style="margin-right:5px !important;">email</i>Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="create_vehtype_modal" class="modal modal-footer">
    <form id="vehtype_form" class="col s12">
        <div class="modal-content">
            <h4>New Vehicle Type</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="vehicle_type_name" name="vehicle_type_name" type="text" class="required">
                    <label for="vehicle_type_name">Type Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" data-url="{{url('vehicleType')}}" onclick="createVehicleType(this)">Create</a>
        </div>
    </form>
</div>

<div id="create_equipment_modal" class="modal modal-footer">
    <form id="equipment_form" class="col s12">
        <div class="modal-content">
            <h4>New Equipment</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input id="equipment_name" name="equipment_name" type="text" class="required">
                    <label for="equipment_name">Equipment Name</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" data-url="{{url('equipment')}}" onclick="createEquipment(this)">Create</a>
        </div>
    </form>
</div>

<div id="control_vehtype_modal" class="modal modal-footer">
    <form id="vehtypelist_form" class="col s12">
        <div class="modal-content">
            <h4>Vehicle Types</h4>
            <div class="row">
                <div id="vehtypes" class="col s12"></div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" data-url="{{url('vehicleType')}}" onclick="updateVehicleTypes(this)">Update</a>
        </div>
    </form>
</div>

<div id="control_equipment_modal" class="modal modal-footer">
    <form id="equipmentlist_form" class="col s12">
        <div class="modal-content">
            <h4>Equipments</h4>
            <div class="row">
                <div id="equipments" class="col s12"></div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" data-url="{{url('equipment')}}" onclick="updateEquipments(this)">Update</a>
        </div>
    </form>
</div>

<div id="load_at_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Load At List</h4>
            <div class="row">
                <div class="col s12 m12 l12">
                    <table id="loadAddrTable" class="display responsive-table">
                        <thead>
                            <tr>
                                <th style="display:none;">Id</th>
                                <th style="display:none;">address1</th>
                                <th style="display:none;">address2</th>
                                <th style="display:none;">address3</th>
                                <th style="display:none;">province1</th>
                                <th style="display:none;">province2</th>
                                <th>Load Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Province</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loadAddrs as $loadAddr)
                                <tr>
                                    <td style="display:none;">{{$loadAddr->id}}</td>
                                    <td style="display:none;">{{$loadAddr->address1}}</td>
                                    <td style="display:none;">{{$loadAddr->address2}}</td>
                                    <td style="display:none;">{{$loadAddr->address3}}</td>
                                    <td style="display:none;">{{$loadAddr->province1}}</td>
                                    <td style="display:none;">{{$loadAddr->province2}}</td>
                                    <td>{{$loadAddr->name}}</td>
                                    <td>{{$loadAddr->address1}} {{$loadAddr->address2}} {{$loadAddr->address3}}</td>
                                    <td>{{$loadAddr->city}}</td>
                                    <td>{{$loadAddr->province1}} {{$loadAddr->province2}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a id="load_loadAddr" class="modal-action modal-close waves-effect waves-green btn-flat">Load</a>
        </div>
    </form>
</div>

<div id="offload_at_modal" class="modal modal-footer">
    <form class="col s12">
        <div class="modal-content">
            <h4>Offload At List</h4>
            <div class="row">
                <div class="col s12 m12 l12">
                    <table id="offloadAddrTable" class="display responsive-table">
                        <thead>
                            <tr>
                                <th style="display:none;">Id</th>
                                <th style="display:none;">address1</th>
                                <th style="display:none;">address2</th>
                                <th style="display:none;">address3</th>
                                <th style="display:none;">province1</th>
                                <th style="display:none;">province2</th>
                                <th>Offload Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Province</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offLoadAddrs as $offLoadAddr)
                                <tr>
                                    <td style="display:none;">{{$offLoadAddr->id}}</td>
                                    <td style="display:none;">{{$offLoadAddr->address1}}</td>
                                    <td style="display:none;">{{$offLoadAddr->address2}}</td>
                                    <td style="display:none;">{{$offLoadAddr->address3}}</td>
                                    <td style="display:none;">{{$offLoadAddr->province1}}</td>
                                    <td style="display:none;">{{$offLoadAddr->province2}}</td>
                                    <td>{{$offLoadAddr->name}}</td>
                                    <td>{{$offLoadAddr->address1}} {{$offLoadAddr->address2}} {{$offLoadAddr->address3}}</td>
                                    <td>{{$offLoadAddr->city}}</td>
                                    <td>{{$offLoadAddr->province1}} {{$offLoadAddr->province2}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a id="offload_loadAddr" class="modal-action modal-close waves-effect waves-green btn-flat">Load</a>
        </div>
    </form>
</div>

<div id="load_confirmation_modal" class="modal bottom-sheet">
    <form class="col s12">
        <div class="modal-content">
            <div class="row">
                <div class="col s12 m12 l12">
                <table id="confirmationTable2" class="cell-border" style="width:100%;">
                    <thead style="background-color:darkgray;">
                        <tr>
                            <th>Order Number</th>
                            <th>Load At</th>
                            <th>Offload At</th>
                            <th>Att</th>
                            <th>Description</th>
                            <th>Weight</th>
                            <th>Abnormal</th>
                            <th>Additional Instruction</th>
                            <th>Reqd</th>
                            <th>Insurance</th>
                            <th>Rate</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Dimension</th>
                            <th>Vehicle Name</th>
                            <th>Transporter Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($confirmationList as $confirmation)
                        <tr>
                            <td>UC {{$confirmation->order_id}}</td>
                            <td>{{$confirmation->l_name}}</td>
                            <td>{{$confirmation->o_name}}</td>
                            <td>{{$confirmation->gi_att}}</td>
                            <td>{{$confirmation->gi_desc}}</td>
                            <td>{{$confirmation->gi_tons}} kg</td>
                            <td>{{($confirmation->gi_abnormal == 1) ? 'true' : 'false'}}</td>
                            <td>{{$confirmation->gi_instruction}}</td>
                            <td>{{($confirmation->gi_reqd == 1) ? 'true' : 'false'}}</td>
                            <td>{{$confirmation->gi_value}} {{$confirmation->gi_currency}}</td>
                            <td>{{$confirmation->gi_rate}}/{{$confirmation->gi_terms}}</td>
                            <td>{{$confirmation->v_l}}</td>
                            <td>{{$confirmation->v_w}}</td>
                            <td>{{$confirmation->v_h}}</td>
                            <td>{{$confirmation->v_add_dimension}}</td>
                            <td>{{$confirmation->v_name}}</td>
                            <td>{{$confirmation->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </form>
</div>

@push('javascript')
<script>
$("body").click(function(event) {
    var target = $(event.target);

    if (target.is("a#general_info_link")) {
        console.log('general tag is active.........')
    }
    else if(target.is("a#vehicle_link")){
        console.log('vehicle tag is active........')
    }
    else if(target.is("a#load_at_link")){
        console.log('load tag is active.........')
    }
    else if(target.is("a#offload_at_link")){
        console.log('offload tag is active.........')
    }
});

$(document).ready(function() {
    var confirmationTable = $('#confirmationTable').DataTable({
        scrollY: '100px',
        scrollCollapse: true,
        paging: false,
        searching: false,
        scrollX: true,
        ordering: false
    });

    $('#confirmationTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            confirmationTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    var confirmationTable2 = $('#confirmationTable2').DataTable({
        ordering: false
    });

    $('#confirmationTable2 tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            confirmationTable2.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#gi_value').inputmask("Regex", { regex: "^[0-9]{0,9}(\.[0-9]{1,2})?$" });
    $('#gi_rate').inputmask("Regex", { regex: "^[0-9]{0,9}(\.[0-9]{1,2})?$" });
    $('#l_date').inputmask("date",{ inputFormat:"dd/mm/yyyy", placeholder: "DD/MM/YYYY"});
    $('#o_date').inputmask("date",{ inputFormat:"dd/mm/yyyy", placeholder: "DD/MM/YYYY"});

    $('#general_info_form').validate({
        rules:{
            gi_att: "required",
            gi_desc: "required",
            gi_tons: {required:true, number:true},
            gi_value: {required:true, number:true},
            gi_rate: {required:true, number:true}
        }
    });

    $('#vehicle_form').validate({
        rules:{
            v_l: {required:true, number:true},
            v_w: {required:true, number:true},
            v_h: {required:true, number:true}
        }
    });

    $('#load_at_form').validate({
        rules:{
            l_name: "required",
            l_address1: "required",
            l_city: "required",
            l_province1: "required"
        }
    });

    $('#offload_at_form').validate({
        rules:{
            o_name: "required",
            o_address1: "required",
            o_city: "required",
            o_province1: "required",
            o_date: "required"
        }
    });

    $('#vehtype_form').validate({
        rules:{
            vehicle_type_name: "required",
        }
    });

    $('#equipment_form').validate({
        rules:{
            equipment_name: "required",
        }
    });

    $('#vehicle_tab').click(function(){
        if($('#general_info_form').valid()){
            $('#vehicle_tab').removeClass('disabled');
        }
    });

    $('#load_at_tab').click(function(){
        // if($('#vehicle_div').css('display') == 'block' && $('#vehicle_form').valid()){
        //     $('#load_at_tab').removeClass('disabled');
        // }
        if($('#vehicle_form').valid()){
            $('#load_at_tab').removeClass('disabled');
        }
    });

    $('#offload_at_tab').click(function(){
        // if($('#load_at_div').css('display') == 'block' && $('#load_at_form').valid()){
        //     $('#offload_at_tab').removeClass('disabled');
        // }
        if($('#load_at_form').valid()){
            $('#offload_at_tab').removeClass('disabled');
        }
    });

    var load_confirmation_table = $('#load_confirmation_table').DataTable({
        scrollY: '100px',
        scrollCollapse: true,
        paging: false,
        "searching": false,
    });

    var loadAddrTable = $('#loadAddrTable').DataTable({
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

    var offloadAddrTable = $('#offloadAddrTable').DataTable({
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

    $('#loadAddrTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            loadAddrTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#offloadAddrTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            offloadAddrTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#load_loadAddr').click(function () {
        var record = $.map(loadAddrTable.rows('.selected').data(), function (item) { return item; });
        $('#load_addr_id').val(record[0]);
        $('#l_name').val(record[6]);
        $('#l_address1').val(record[1]);
        $('#l_address2').val(record[2]);
        $('#l_address3').val(record[3]);
        $('#l_city').val(record[8]);
        $('#l_province1').val(record[4]);
        $('#l_province2').val(record[5]);
    });

    $('#offload_loadAddr').click(function () {
        var record = $.map(offloadAddrTable.rows('.selected').data(), function (item) { return item; });
        $('#offload_addr_id').val(record[0]);
        $('#o_name').val(record[6]);
        $('#o_address1').val(record[1]);
        $('#o_address2').val(record[2]);
        $('#o_address3').val(record[3]);
        $('#o_city').val(record[8]);
        $('#o_province1').val(record[4]);
        $('#o_province2').val(record[5]);
    });

    getAllVehicleTypes("{{url('vehicleType')}}", {{!empty($transporter_order_detail) ? $transporter_order_detail->v_type_id : 1}});
    getAllTransporters("{{url('transporter')}}", {{!empty($transporter_order_detail) ? $transporter_order_detail->transporter_id : 1}});

    $('select#gi_extension').on('change', function() {
        initializePage({{$id}});
    });

    $('select#gi_to').on('change', function() {
        var transporter_id = this.value;
        var transporter_order_id = {{$id}};
        var extension = $("#gi_extension option:selected").val();
        console.log(transporter_id, transporter_order_id, extension);

        $.ajax({
            url: "{{url('transporter/changeTransporter')}}",
            type: "POST",
            data: {transporter_order_id, transporter_id, extension},
            success: function(response) {
                if(response > 0){
                    console.log('success');
                }
                else{
                    console.log('error');
                }
            }
        });
    });
});

function initializePage(id)
{
    console.log(id);

    var ext = $("#gi_extension option:selected").val();

    $.ajax({
        url: "{{url('transporter/getExitingTransporterDetails')}}",
        type: "POST",
        data: { id, ext },
        success: function(response) {
            if(response['success'] > 0){
                var gi_extension_original = $('#gi_extension_original').val();
                if(gi_extension_original != ext){
                    Materialize.toast('There is already data with ' + ext + ' option.', 2000, 'red');
                    var tex = ext;

                    $.ajax({
                        url: "{{url('transporter/saveExtension')}}",
                        type: "POST",
                        data: { tex },
                        success: function(response) {
                            if(response['success'] > 0){
                                location.href = "/transporter/detail/" + id;
                            }
                            else{
                                console.log('error');
                            }
                        }
                    });
                }
            }
            else{
                initializeData();
            }
        }
    });
}

function initializeData()
{
    // general tab
    $('#gi_att').val('');
    $('#gi_desc').val('');
    $('#gi_tons').val('');
    if ($('#gi_abnormal').is(":checked"))
    {
        $("#gi_abnormal").removeAttr('checked');
    }
    $('#gi_instruction').val('');
    if ($('#gi_reqd').is(":checked"))
    {
        $("#gi_reqd").removeAttr('checked');
    }
    $('#gi_value').val('');
    if ($("#gi_currency option:selected").val() == "USD")
    {
        $("select#gi_currency option[value='USD']").removeAttr("selected");
        $("select#gi_currency option[value='ZAR']").attr("selected", true);
    }
    $('#gi_rate').val('');

    $("select#gi_terms option[value='30 Days']").attr("selected", true);
    $("select#gi_terms option[value='COD']").removeAttr("selected");
    $("select#gi_terms option[value='BI MONTHLY']").removeAttr("selected");

    // vehicle tab
    if($("#v_type_id option:selected").val() != 1)
    {
        $('#v_type_id').select2().select2("val", 1);
    }
    $('#v_l').val('');
    $('#v_w').val('');
    $('#v_h').val('');
    $('#v_add_dimension').val('');
    $.each($("input[name='equipment']:checked"), function(){
        $(this).attr('checked', false);
    });
    $('#v_container_number').val('');
    $('#v_driver_name').val('');
    $('#v_vessel_name').val('');
    $('#v_truck').val('');
    $('#v_trailer').val('');
    $('#v_trailer2').val('');

    // load at tab
    $('#l_name').val('');
    $('#l_address1').val('');
    $('#l_address2').val('');
    $('#l_address3').val('');
    $('#l_city').val('');
    $('#l_province1').val('');
    $('#l_province2').val('');
    $('#l_date2').val('');
    $('#l_contact').val('');
    $('#l_telephone').val('');

    // offload at tab
    $('#o_name').val('');
    $('#o_address1').val('');
    $('#o_address2').val('');
    $('#o_address3').val('');
    $('#o_city').val('');
    $('#o_province1').val('');
    $('#o_province2').val('');
    $('#o_date2').val('');
    $('#o_contact').val('');
    $('#o_telephone').val('');

    Materialize.toast('It has been created new form!', 2000, 'indigo');
}

function getPdfData()
{
    if(!$('#offload_at_form').valid())
    {
        return null;
    }

    var info = [];
    var transporter_order_id = $('#transporter_order_id').val();

    var gi_att = $('#gi_att').val();
    var gi_desc = $('#gi_desc').val();
    var gi_tons = $('#gi_tons').val();
    var gi_abnormal = 0;
    if ($('#gi_abnormal').is(":checked"))
    {
        gi_abnormal = 1;
    }
    var gi_instruction = $('#gi_instruction').val();
    var gi_reqd = 0;
    if ($('#gi_reqd').is(":checked"))
    {
        gi_reqd = 1;
    }
    var gi_value = $('#gi_value').val();
    var gi_currency = $("#gi_currency option:selected").val();

    var gi_rate = $('#gi_rate').val();
    var gi_terms = $("#gi_terms option:selected").val();

    var v_type_id = $("#v_type_id option:selected").val();
    var v_l = $('#v_l').val();
    var v_w = $('#v_w').val();
    var v_h = $('#v_h').val();
    var v_add_dimension = $('#v_add_dimension').val();

    var load_addr_id = $('#load_addr_id').val();
    var offload_addr_id = $('#offload_addr_id').val();

    var equipment_arr = [];
    $.each($("input[name='equipment']:checked"), function(){
        equipment_arr.push($(this).val());
    });
    var v_equipments = equipment_arr.join(",");

    var v_container_number = $('#v_container_number').val();
    var v_driver_name = $('#v_driver_name').val();
    var v_vessel_name = $('#v_vessel_name').val();
    var v_truck = $('#v_truck').val();
    var v_trailer = $('#v_trailer').val();

    //var l_date = getDateFormat($('#l_date').val());
    var l_date = $('#l_date2').val();
    var l_contact = $('#l_contact').val();
    var l_telephone = $('#l_telephone').val();
    //var o_date = getDateFormat($('#o_date').val());
    var o_date = $('#o_date2').val();
    var o_contact = $('#o_contact').val();
    var o_telephone = $('#o_telephone').val();
    var v_trailer2 = $('#v_trailer2').val();

    var gi_extension = $("#gi_extension option:selected").val();
    var gi_extension_original = $('#gi_extension_original').val();

    var gi_to = $("#gi_to option:selected").val();
    var gi_order_no = $("#gi_order_no").val();

    var gi_from = $("#gi_from").val();
    var gi_from_id = $("#gi_from_id").val();
    var gi_from = $("#gi_authorised").val();
    var gi_from_id = $("#gi_authorised_id").val();

    var l_name = $('#l_name').val();
    var l_address1 = $('#l_address1').val();
    var l_address2 = $('#l_address2').val();
    var l_address3 = $('#l_address3').val();
    var l_city = $('#l_city').val();
    var l_province1 = $('#l_province1').val();
    var l_province2 = $('#l_province2').val();

    var o_name = $('#o_name').val();
    var o_address1 = $('#o_address1').val();
    var o_address2 = $('#o_address2').val();
    var o_address3 = $('#o_address3').val();
    var o_city = $('#o_city').val();
    var o_province1 = $('#o_province1').val();
    var o_province2 = $('#o_province2').val();

    info.push(transporter_order_id);
    info.push(gi_att);
    info.push(gi_desc);
    info.push(gi_tons);
    info.push(gi_abnormal);
    info.push(gi_instruction);
    info.push(gi_reqd);
    info.push(gi_value);
    info.push(gi_currency);
    info.push(gi_rate);
    info.push(gi_terms);
    info.push(v_type_id);
    info.push(v_l);
    info.push(v_w);
    info.push(v_h);
    info.push(v_add_dimension);
    info.push(load_addr_id);
    info.push(offload_addr_id);
    info.push(v_equipments);
    info.push(v_container_number);
    info.push(v_driver_name);
    info.push(v_vessel_name);
    info.push(v_truck);
    info.push(v_trailer);
    info.push(l_date);
    info.push(l_contact);
    info.push(l_telephone);
    info.push(o_date);
    info.push(o_contact);
    info.push(o_telephone);
    info.push(v_trailer2);
    info.push(gi_extension);
    info.push(gi_extension_original);
    info.push(gi_to);
    info.push(gi_order_no);
    info.push(gi_from);
    info.push(gi_from_id);
    info.push(l_name);
    info.push(l_address1);
    info.push(l_address2);
    info.push(l_address3);
    info.push(l_city);
    info.push(l_province1);
    info.push(l_province2);
    info.push(o_name);
    info.push(o_address1);
    info.push(o_address2);
    info.push(o_address3);
    info.push(o_city);
    info.push(o_province1);
    info.push(o_province2);

    return info;
}

function getDateFormat(date_mask)
{
    var year = date_mask.split('/')[2];
    var month = date_mask.split('/')[1];
    var day = date_mask.split('/')[0];
    var date = year + '-' + month + '-' + day;

    return date;
}

function previewPDF()
{
    var previewData = getPdfData();
    if(previewData == null){
        return;
    }

    $.ajax({
        url: "{{url('transporter/previewConfirmData')}}",
        type: "POST",
        data: JSON.stringify(previewData),
        contentType: "application/json",
        dataType: "json",
        success: function(response) {
            if(response['success'] > 0){
                window.open("/transporter/previewPdf", "_blank");
            }
            else{
                Materialize.toast('Error- Not Made the Preview!!!', 2000, 'red rounded');
            }
        }
    });
}

function downloadPDF()
{
    var info = getPdfData();
    if(info == null){
        return;
    }

    var transporter_order_id = $('#transporter_order_id').val();

    checkLoadAddress(info, transporter_order_id);
}

function savePDF()
{
    var info = getPdfData();
    if(info == null){
        return;
    }

    checkLoadAddress(info, 0);
}

function checkLoadAddress(info, id)
{
    console.log(info[16]);
    var url = '';
    var obj = null;

    var l_name = $('#l_name').val();
    var l_address1 = $('#l_address1').val();
    var l_address2 = $('#l_address2').val();
    var l_address3 = $('#l_address3').val();
    var l_city = $('#l_city').val();
    var l_province1 = $('#l_province1').val();
    var l_province2 = $('#l_province2').val();

    if(info[16] && info[16] > 0) // load_address_id
    {
        var e_loadAddr_id = info[16];
        var e_load_name = l_name;
        var e_address_1 = l_address1;
        var e_address_2 = l_address2;
        var e_address_3 = l_address3;
        var e_city = l_city;
        var e_province_1 = l_province1;
        var e_province_2 = l_province2;

        url = "{{url('loadAddrs/edit')}}";
        obj = {e_loadAddr_id, e_load_name, e_address_1, e_address_2, e_address_3, e_city, e_province_1, e_province_2};
    }
    else
    {
        var n_load_name = l_name;
        var n_address_1 = l_address1;
        var n_address_2 = l_address2;
        var n_address_3 = l_address3;
        var n_city = l_city;
        var n_province_1 = l_province1;
        var n_province_2 = l_province2;

        url = "{{url('loadAddrs/create')}}";
        obj = {n_load_name, n_address_1, n_address_2, n_address_3, n_city, n_province_1, n_province_2};
    }

    $.ajax({
        url: url,
        type: "POST",
        data: obj,
        success: function(response) {
            if(response['success'] > 0){
                info[16] = response['success'];
                checkOffLoadAddress(info, id)
            }
        }
    });
}

function checkOffLoadAddress(info, id)
{
    console.log(info[17]);
    var url = '';
    var obj = null;

    var o_name = $('#o_name').val();
    var o_address1 = $('#o_address1').val();
    var o_address2 = $('#o_address2').val();
    var o_address3 = $('#o_address3').val();
    var o_city = $('#o_city').val();
    var o_province1 = $('#o_province1').val();
    var o_province2 = $('#o_province2').val();

    if(info[17] && info[17] > 0) // offload_address_id
    {
        var e_offloadAddr_id = info[17];
        var e_offload_name = o_name;
        var e_address_1 = o_address1;
        var e_address_2 = o_address2;
        var e_address_3 = o_address3;
        var e_city = o_city;
        var e_province_1 = o_province1;
        var e_province_2 = o_province2;

        url = "{{url('offloadAddrs/edit')}}";
        obj = {e_offloadAddr_id, e_offload_name, e_address_1, e_address_2, e_address_3, e_city, e_province_1, e_province_2};
    }
    else
    {
        var n_offload_name = o_name;
        var n_address_1 = o_address1;
        var n_address_2 = o_address2;
        var n_address_3 = o_address3;
        var n_city = o_city;
        var n_province_1 = o_province1;
        var n_province_2 = o_province2;

        url = "{{url('offloadAddrs/create')}}";
        obj = {n_offload_name, n_address_1, n_address_2, n_address_3, n_city, n_province_1, n_province_2};
    }

    $.ajax({
        url: url,
        type: "POST",
        data: obj,
        success: function(response) {
            if(response['success'] > 0){
                console.log(response['success'])
                info[17] = response['success'];
                postConfirmData(info, id);
            }
        }
    });
}

function postConfirmData(info, id)
{
    $.ajax({
        url: "{{url('transporter/saveConfirmData')}}",
        type: "POST",
        data: {info},
        success: function(response) {
            if(response['success'] > 0){
                if(id > 0){
                    window.location.href = "/transporter/downloadPdf/" + id + "/" + info[31];
                }
                else{
                    Materialize.toast('Success - Saved!!!', 2000, 'green rounded');
                }
            }
            else{
                Materialize.toast('Error- Not Saved!!!', 2000, 'red rounded');
            }
        }
    });
}

function emailPDF()
{
    console.log('email..........');
}
</script>
@endpush

@push('javascript')
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/google-code-prettify/prettify.js')}}"></script>
    <script src="{{asset('js/pages/form-input-mask.js')}}"></script>
    <script src="{{asset('plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/pages/ui-modals.js')}}"></script>
    <script src="{{asset('plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('js/pages/form_elements.js')}}"></script>
    <script src="{{asset('js/transporter/detail.js')}}"></script>
@endpush
@endsection
