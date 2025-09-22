@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.kategorien.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kategoriens.update", [$kategorien->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="kategorie">{{ trans('cruds.kategorien.fields.kategorie') }}</label>
                <input class="form-control {{ $errors->has('kategorie') ? 'is-invalid' : '' }}" type="text" name="kategorie" id="kategorie" value="{{ old('kategorie', $kategorien->kategorie) }}">
                @if($errors->has('kategorie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategorie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kategorien.fields.kategorie_helper') }}</span>
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