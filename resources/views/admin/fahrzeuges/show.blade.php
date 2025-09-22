@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fahrzeuge.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fahrzeuges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.fahrzeug_bild') }}
                        </th>
                        <td>
                            @foreach($fahrzeuge->fahrzeug_bild as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.fahrzeug_name') }}
                        </th>
                        <td>
                            {{ $fahrzeuge->fahrzeug_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.spawn_name') }}
                        </th>
                        <td>
                            {{ $fahrzeuge->spawn_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.preis') }}
                        </th>
                        <td>
                            {{ $fahrzeuge->preis }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.kofferraum_groesse') }}
                        </th>
                        <td>
                            {{ $fahrzeuge->kofferraum_groesse }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.herstellbar') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $fahrzeuge->herstellbar ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.im_shop') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $fahrzeuge->im_shop ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.kategorie') }}
                        </th>
                        <td>
                            @foreach($fahrzeuge->kategories as $key => $kategorie)
                                <span class="label label-info">{{ $kategorie->kategorie }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fahrzeuges.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection