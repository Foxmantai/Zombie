@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tebexLizenzen.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tebex-lizenzens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tebexLizenzen.fields.haendler') }}
                        </th>
                        <td>
                            {{ $tebexLizenzen->haendler }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tebexLizenzen.fields.gekauft_am') }}
                        </th>
                        <td>
                            {{ $tebexLizenzen->gekauft_am }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tebexLizenzen.fields.tebexid') }}
                        </th>
                        <td>
                            {{ $tebexLizenzen->tebexid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tebexLizenzen.fields.preis') }}
                        </th>
                        <td>
                            {{ $tebexLizenzen->preis }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tebexLizenzen.fields.url') }}
                        </th>
                        <td>
                            {{ $tebexLizenzen->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tebexLizenzen.fields.produkt') }}
                        </th>
                        <td>
                            {!! $tebexLizenzen->produkt !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tebex-lizenzens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection