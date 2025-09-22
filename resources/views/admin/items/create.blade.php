@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.items.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="item_name">{{ trans('cruds.item.fields.item_name') }}</label>
                <input class="form-control {{ $errors->has('item_name') ? 'is-invalid' : '' }}" type="text" name="item_name" id="item_name" value="{{ old('item_name', '') }}">
                @if($errors->has('item_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.item_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spawn_name">{{ trans('cruds.item.fields.spawn_name') }}</label>
                <input class="form-control {{ $errors->has('spawn_name') ? 'is-invalid' : '' }}" type="text" name="spawn_name" id="spawn_name" value="{{ old('spawn_name', '') }}">
                @if($errors->has('spawn_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('spawn_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.spawn_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gewicht">{{ trans('cruds.item.fields.gewicht') }}</label>
                <input class="form-control {{ $errors->has('gewicht') ? 'is-invalid' : '' }}" type="text" name="gewicht" id="gewicht" value="{{ old('gewicht', '') }}">
                @if($errors->has('gewicht'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gewicht') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.gewicht_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('seltenes_item') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="seltenes_item" value="0">
                    <input class="form-check-input" type="checkbox" name="seltenes_item" id="seltenes_item" value="1" {{ old('seltenes_item', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="seltenes_item">{{ trans('cruds.item.fields.seltenes_item') }}</label>
                </div>
                @if($errors->has('seltenes_item'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seltenes_item') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.seltenes_item_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kategorie_id">{{ trans('cruds.item.fields.kategorie') }}</label>
                <select class="form-control select2 {{ $errors->has('kategorie') ? 'is-invalid' : '' }}" name="kategorie_id" id="kategorie_id">
                    @foreach($kategories as $id => $entry)
                        <option value="{{ $id }}" {{ old('kategorie_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategorie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategorie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.item.fields.kategorie_helper') }}</span>
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