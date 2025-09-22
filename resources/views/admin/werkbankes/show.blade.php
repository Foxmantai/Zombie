@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.werkbanke.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.werkbankes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.werkbanke.fields.werkbank') }}
                        </th>
                        <td>
                            {{ $werkbanke->werkbank }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.werkbanke.fields.endergebnis') }}
                        </th>
                        <td>
                            {{ $werkbanke->endergebnis->item_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.werkbanke.fields.bauteile') }}
                        </th>
                        <td>
                            {{ $werkbanke->bauteile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.werkbanke.fields.xp') }}
                        </th>
                        <td>
                            {{ $werkbanke->xp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.werkbanke.fields.kategorie') }}
                        </th>
                        <td>
                            @foreach($werkbanke->kategories as $key => $kategorie)
                                <span class="label label-info">{{ $kategorie->kategorie }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.werkbanke.fields.lvl') }}
                        </th>
                        <td>
                            {{ $werkbanke->lvl }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.werkbankes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection