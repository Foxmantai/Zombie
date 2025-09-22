@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.item.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.item_name') }}
                        </th>
                        <td>
                            {{ $item->item_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.spawn_name') }}
                        </th>
                        <td>
                            {{ $item->spawn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.gewicht') }}
                        </th>
                        <td>
                            {{ $item->gewicht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.seltenes_item') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $item->seltenes_item ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.item.fields.kategorie') }}
                        </th>
                        <td>
                            {{ $item->kategorie->kategorie ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.items.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#endergebnis_werkbankes" role="tab" data-toggle="tab">
                {{ trans('cruds.werkbanke.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="endergebnis_werkbankes">
            @includeIf('admin.items.relationships.endergebnisWerkbankes', ['werkbankes' => $item->endergebnisWerkbankes])
        </div>
    </div>
</div>

@endsection