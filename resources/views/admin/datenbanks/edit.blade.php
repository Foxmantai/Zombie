@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.datenbank.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.datenbanks.update", [$datenbank->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.datenbank.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $datenbank->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datenbank.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spawn_name">{{ trans('cruds.datenbank.fields.spawn_name') }}</label>
                <input class="form-control {{ $errors->has('spawn_name') ? 'is-invalid' : '' }}" type="text" name="spawn_name" id="spawn_name" value="{{ old('spawn_name', $datenbank->spawn_name) }}">
                @if($errors->has('spawn_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('spawn_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datenbank.fields.spawn_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kategorie_id">{{ trans('cruds.datenbank.fields.kategorie') }}</label>
                <select class="form-control select2 {{ $errors->has('kategorie') ? 'is-invalid' : '' }}" name="kategorie_id" id="kategorie_id">
                    @foreach($kategories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kategorie_id') ? old('kategorie_id') : $datenbank->kategorie->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategorie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategorie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.datenbank.fields.kategorie_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection