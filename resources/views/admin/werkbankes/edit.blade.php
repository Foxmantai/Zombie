@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.werkbanke.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.werkbankes.update", [$werkbanke->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="werkbank">{{ trans('cruds.werkbanke.fields.werkbank') }}</label>
                <input class="form-control {{ $errors->has('werkbank') ? 'is-invalid' : '' }}" type="text" name="werkbank" id="werkbank" value="{{ old('werkbank', $werkbanke->werkbank) }}">
                @if($errors->has('werkbank'))
                    <div class="invalid-feedback">
                        {{ $errors->first('werkbank') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.werkbanke.fields.werkbank_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="endergebnis_id">{{ trans('cruds.werkbanke.fields.endergebnis') }}</label>
                <select class="form-control select2 {{ $errors->has('endergebnis') ? 'is-invalid' : '' }}" name="endergebnis_id" id="endergebnis_id">
                    @foreach($endergebnis as $id => $entry)
                        <option value="{{ $id }}" {{ (old('endergebnis_id') ? old('endergebnis_id') : $werkbanke->endergebnis->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('endergebnis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('endergebnis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.werkbanke.fields.endergebnis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="bauteile">{{ trans('cruds.werkbanke.fields.bauteile') }}</label>
                <input class="form-control {{ $errors->has('bauteile') ? 'is-invalid' : '' }}" type="text" name="bauteile" id="bauteile" value="{{ old('bauteile', $werkbanke->bauteile) }}">
                @if($errors->has('bauteile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bauteile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.werkbanke.fields.bauteile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="xp">{{ trans('cruds.werkbanke.fields.xp') }}</label>
                <input class="form-control {{ $errors->has('xp') ? 'is-invalid' : '' }}" type="text" name="xp" id="xp" value="{{ old('xp', $werkbanke->xp) }}">
                @if($errors->has('xp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('xp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.werkbanke.fields.xp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kategories">{{ trans('cruds.werkbanke.fields.kategorie') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('kategories') ? 'is-invalid' : '' }}" name="kategories[]" id="kategories" multiple>
                    @foreach($kategories as $id => $kategory)
                        <option value="{{ $id }}" {{ (in_array($id, old('kategories', [])) || $werkbanke->kategories->contains($id)) ? 'selected' : '' }}>{{ $kategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.werkbanke.fields.kategorie_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lvl">{{ trans('cruds.werkbanke.fields.lvl') }}</label>
                <input class="form-control {{ $errors->has('lvl') ? 'is-invalid' : '' }}" type="text" name="lvl" id="lvl" value="{{ old('lvl', $werkbanke->lvl) }}">
                @if($errors->has('lvl'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lvl') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.werkbanke.fields.lvl_helper') }}</span>
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