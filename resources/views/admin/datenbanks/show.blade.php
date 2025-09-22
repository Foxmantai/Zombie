@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.datenbank.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datenbanks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.datenbank.fields.name') }}
                        </th>
                        <td>
                            {{ $datenbank->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datenbank.fields.spawn_name') }}
                        </th>
                        <td>
                            {{ $datenbank->spawn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datenbank.fields.kategorie') }}
                        </th>
                        <td>
                            {{ $datenbank->kategorie->kategorie ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datenbanks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection