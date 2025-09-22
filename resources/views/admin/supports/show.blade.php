@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.support.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.titel') }}
                        </th>
                        <td>
                            {{ $support->titel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.ingame_name') }}
                        </th>
                        <td>
                            {{ $support->ingame_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.grund') }}
                        </th>
                        <td>
                            {{ $support->grund }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.supporter') }}
                        </th>
                        <td>
                            {{ $support->supporter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Support::STATUS_SELECT[$support->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.kategorie') }}
                        </th>
                        <td>
                            {{ App\Models\Support::KATEGORIE_SELECT[$support->kategorie] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.support.fields.beweismittel') }}
                        </th>
                        <td>
                            @foreach($support->beweismittel as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection