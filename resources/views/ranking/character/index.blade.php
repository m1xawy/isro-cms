@extends('layouts.full')
@section('title', __('Character') . ' - ' .$data->CharName16)

@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <div class="d-flex me-3 overflow-hidden align-items-center">
                                <img class="object-fit-cover rounded border" src="{{ asset(config('global.ranking.character_image')[$data->RefObjID]) }}" width="100" height="100" alt=""/>
                            </div>

                            <div class="mt-4">
                                <h2>{{ $data->CharName16 }}</h2>
                                <p class="m-0">{{ __('Item Points:') }} <span class="">{{ $data->ItemPoints }}</span></p>

                                <ul class="list-unstyled d-flex">
                                    @foreach($build_info as $value)
                                        <li class="me-1">
                                            <img src="{{ asset(config('global.ranking.skill_mastery')[$value->MasteryID]['icon']) }}" title="{{ config('global.ranking.skill_mastery')[$value->MasteryID]['name'] }}" alt="">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mt-5 justify-content-end">
                            @if($data->JobType > 0)
                                <div class="col-md-4">
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset(config('global.ranking.job_type_icons')[$data->JobType]['icon']) }}" width="50" height="" alt=""/>
                                        </div>

                                        <ul class="list-unstyled mt-3">
                                            <li class="mb-0">
                                                <span>{{ config('global.ranking.job_type_icons')[$data->JobType]['name'] }}</span>
                                            </li>
                                            <li class="mb-0">{{ __('Job Level:') }} <span class="">{{ $data->JobLevel }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-4">
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="fa-solid fa-heart text-danger"></i> {{ __('Health:') }} <span>{{ $data->HP }}</span></li>
                                    <li class="mb-2"><i class="fa-solid fa-star-of-life text-primary"></i> {{ __('Mana:') }} <span>{{ $data->MP }}</span></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="list-unstyled mt-3">
                                    <li class="mb-2"><i class="fa-solid fa-hand-fist text-warning"></i> {{ __('Strength:') }} <span>{{ $data->Strength }}</span></li>
                                    <li class="mb-2"><i class="fa-solid fa-brain text-warning"></i> {{ __('Intellect:') }} <span>{{ $data->Intellect }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab" aria-controls="info-tab-pane" aria-selected="true">{{ __('Information') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="globals-tab" data-bs-toggle="tab" data-bs-target="#globals-tab-pane" type="button" role="tab" aria-controls="globals-tab-pane" aria-selected="false">{{ __('Global Chat') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="uniques-tab" data-bs-toggle="tab" data-bs-target="#uniques-tab-pane" type="button" role="tab" aria-controls="uniques-tab-pane" aria-selected="false">{{ __('Unique Kills') }}</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="info-tab-pane" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                                @include('ranking.character.partials.character-information')
                            </div>
                            <div class="tab-pane fade" id="globals-tab-pane" role="tabpanel" aria-labelledby="globals-tab" tabindex="0">
                                @include('ranking.character.partials.character-global-history')
                            </div>
                            <div class="tab-pane fade" id="uniques-tab-pane" role="tabpanel" aria-labelledby="uniques-tab" tabindex="0">
                                @include('ranking.character.partials.character-unique-history')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body d-flex justify-content-center" id="display-inventory">
                                <div class="" id="display-inventory-set">
                                    @include('ranking.character.partials.inventory.inventory-view', ['inventorySetList' => $inventory_set])
                                </div>
                                <div class="" id="display-inventory-avatar-accessory">
                                    <p class="mb-0" id="display-inventory-avatar-accessory-label">{{ __('Accessories') }}</p>
                                    @include('ranking.character.partials.inventory.inventory-avatar-view', ['inventoryAvatarList' => $inventory_avatar])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .sro-item-detail .tooltip {
            text-align: left !important;
            font-size: 12px;
            width: 250px;
            min-height: 200px;
            background-color: rgba(28, 30, 52, .8);
            color: #fff;
            padding: 6px;
            border: 1px solid #808bba;
            border-radius: 5px;
            box-shadow: none;
            z-index: 999;
        }
        .sro-item-detail .item > img {
            position: absolute;
            width: 32px;
            height: 32px;
        }
    </style>
    <style>
        /********INVENTORY********/
        .table.table-inventory {
            margin: 0 0 !important;
        }
        .table.table-inventory tr:first-child td {
            padding: 12px 12px 35px;
        }
        .table.table-inventory td, .table.table-inventory th {
            padding: 6px;
            background: none !important;
            border: none !important;
        }
        .table.table-inventory td:last-child {
            float: right;
        }
        .sro-item-detail .item {
            margin: 0;
            background: none;
        }
        .sro-item-detail.sro-item-special {
            background: none;
        }
        .sro-item-detail {
            background: none;
            width: auto;
            margin: 0;
        }
        /********AVATAR********/
        .table.table-inventory-avatar {
            margin: 0 5px !important;
            width: 162px;
        }
        .table.table-inventory-avatar tbody {
            display: flex;
        }
        .table.table-inventory-avatar tr:first-child td {
            padding: 6px;
        }
        .table.table-inventory-avatar td, .table.table-inventory-avatar th {
            padding: 6px;
        }
    </style>
    <style>
        #display-inventory {
            width: 100%;
            height: 355px;
            background: url({{ asset('images/inventoryDiv_bg.png') }}) 50% 50% no-repeat;
            background-size: cover;
            border-right: 1px solid #252525;
            border-bottom: 1px solid #252525;
            float: left;
            position: relative;
        }
        #display-inventory-set,
        #display-inventory-avatar {
            width: 178px;
            height: 315px;
            background: url({{ asset('images/inventory_bg.png') }}) 0 0 no-repeat;
            position: absolute;
            top: 21px;
            left: 59px;
        }
        #display-inventory-avatar-accessory {
            width: 172px;
            height: 129px;
            background: url({{ asset('images/accessory_bg.png') }}) 0 0 no-repeat;
            position: absolute;
            top: 206px;
            left: 260px;
        }
        #display-inventory-avatar-accessory-label {
            color: #ffc345;
            font-size: 14px;
            margin-top: 10px;
            margin-left: 10px;
        }
    </style>
@endpush
