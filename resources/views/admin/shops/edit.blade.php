@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.shop.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shops.update", [$shop->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="shop_name">{{ trans('cruds.shop.fields.shop_name') }}</label>
                <input class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" type="text" name="shop_name" id="shop_name" value="{{ old('shop_name', $shop->shop_name) }}">
                @if($errors->has('shop_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shop_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.shop_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="item_name">{{ trans('cruds.shop.fields.item_name') }}</label>
                <input class="form-control {{ $errors->has('item_name') ? 'is-invalid' : '' }}" type="text" name="item_name" id="item_name" value="{{ old('item_name', $shop->item_name) }}">
                @if($errors->has('item_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('item_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.item_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="preis">{{ trans('cruds.shop.fields.preis') }}</label>
                <input class="form-control {{ $errors->has('preis') ? 'is-invalid' : '' }}" type="text" name="preis" id="preis" value="{{ old('preis', $shop->preis) }}">
                @if($errors->has('preis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('preis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.preis_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('verkaufbar') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="verkaufbar" value="0">
                    <input class="form-check-input" type="checkbox" name="verkaufbar" id="verkaufbar" value="1" {{ $shop->verkaufbar || old('verkaufbar', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="verkaufbar">{{ trans('cruds.shop.fields.verkaufbar') }}</label>
                </div>
                @if($errors->has('verkaufbar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('verkaufbar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.verkaufbar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="verkaufs_preis">{{ trans('cruds.shop.fields.verkaufs_preis') }}</label>
                <input class="form-control {{ $errors->has('verkaufs_preis') ? 'is-invalid' : '' }}" type="text" name="verkaufs_preis" id="verkaufs_preis" value="{{ old('verkaufs_preis', $shop->verkaufs_preis) }}">
                @if($errors->has('verkaufs_preis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('verkaufs_preis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.shop.fields.verkaufs_preis_helper') }}</span>
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