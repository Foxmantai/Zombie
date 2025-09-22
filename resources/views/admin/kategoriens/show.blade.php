@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kategorien.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kategoriens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kategorien.fields.kategorie') }}
                        </th>
                        <td>
                            {{ $kategorien->kategorie }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kategoriens.index') }}">
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
            <a class="nav-link" href="#kategorie_items" role="tab" data-toggle="tab">
                {{ trans('cruds.item.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#kategorie_datenbanks" role="tab" data-toggle="tab">
                {{ trans('cruds.datenbank.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#kategorie_fahrzeuges" role="tab" data-toggle="tab">
                {{ trans('cruds.fahrzeuge.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#kategorie_werkbankes" role="tab" data-toggle="tab">
                {{ trans('cruds.werkbanke.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kategorie_items">
            @includeIf('admin.kategoriens.relationships.kategorieItems', ['items' => $kategorien->kategorieItems])
        </div>
        <div class="tab-pane" role="tabpanel" id="kategorie_datenbanks">
            @includeIf('admin.kategoriens.relationships.kategorieDatenbanks', ['datenbanks' => $kategorien->kategorieDatenbanks])
        </div>
        <div class="tab-pane" role="tabpanel" id="kategorie_fahrzeuges">
            @includeIf('admin.kategoriens.relationships.kategorieFahrzeuges', ['fahrzeuges' => $kategorien->kategorieFahrzeuges])
        </div>
        <div class="tab-pane" role="tabpanel" id="kategorie_werkbankes">
            @includeIf('admin.kategoriens.relationships.kategorieWerkbankes', ['werkbankes' => $kategorien->kategorieWerkbankes])
        </div>
    </div>
</div>

@endsection