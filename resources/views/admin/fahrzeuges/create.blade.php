@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fahrzeuge.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fahrzeuges.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fahrzeug_bild">{{ trans('cruds.fahrzeuge.fields.fahrzeug_bild') }}</label>
                <div class="needsclick dropzone {{ $errors->has('fahrzeug_bild') ? 'is-invalid' : '' }}" id="fahrzeug_bild-dropzone">
                </div>
                @if($errors->has('fahrzeug_bild'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fahrzeug_bild') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.fahrzeug_bild_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fahrzeug_name">{{ trans('cruds.fahrzeuge.fields.fahrzeug_name') }}</label>
                <input class="form-control {{ $errors->has('fahrzeug_name') ? 'is-invalid' : '' }}" type="text" name="fahrzeug_name" id="fahrzeug_name" value="{{ old('fahrzeug_name', '') }}">
                @if($errors->has('fahrzeug_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fahrzeug_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.fahrzeug_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="spawn_name">{{ trans('cruds.fahrzeuge.fields.spawn_name') }}</label>
                <input class="form-control {{ $errors->has('spawn_name') ? 'is-invalid' : '' }}" type="text" name="spawn_name" id="spawn_name" value="{{ old('spawn_name', '') }}">
                @if($errors->has('spawn_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('spawn_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.spawn_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="preis">{{ trans('cruds.fahrzeuge.fields.preis') }}</label>
                <input class="form-control {{ $errors->has('preis') ? 'is-invalid' : '' }}" type="text" name="preis" id="preis" value="{{ old('preis', '') }}">
                @if($errors->has('preis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('preis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.preis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kofferraum_groesse">{{ trans('cruds.fahrzeuge.fields.kofferraum_groesse') }}</label>
                <input class="form-control {{ $errors->has('kofferraum_groesse') ? 'is-invalid' : '' }}" type="text" name="kofferraum_groesse" id="kofferraum_groesse" value="{{ old('kofferraum_groesse', '') }}">
                @if($errors->has('kofferraum_groesse'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kofferraum_groesse') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.kofferraum_groesse_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('herstellbar') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="herstellbar" value="0">
                    <input class="form-check-input" type="checkbox" name="herstellbar" id="herstellbar" value="1" {{ old('herstellbar', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="herstellbar">{{ trans('cruds.fahrzeuge.fields.herstellbar') }}</label>
                </div>
                @if($errors->has('herstellbar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('herstellbar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.herstellbar_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('im_shop') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="im_shop" value="0">
                    <input class="form-check-input" type="checkbox" name="im_shop" id="im_shop" value="1" {{ old('im_shop', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="im_shop">{{ trans('cruds.fahrzeuge.fields.im_shop') }}</label>
                </div>
                @if($errors->has('im_shop'))
                    <div class="invalid-feedback">
                        {{ $errors->first('im_shop') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.im_shop_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kategories">{{ trans('cruds.fahrzeuge.fields.kategorie') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('kategories') ? 'is-invalid' : '' }}" name="kategories[]" id="kategories" multiple>
                    @foreach($kategories as $id => $kategory)
                        <option value="{{ $id }}" {{ in_array($id, old('kategories', [])) ? 'selected' : '' }}>{{ $kategory }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.fahrzeuge.fields.kategorie_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedFahrzeugBildMap = {}
Dropzone.options.fahrzeugBildDropzone = {
    url: '{{ route('admin.fahrzeuges.storeMedia') }}',
    maxFilesize: 15, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="fahrzeug_bild[]" value="' + response.name + '">')
      uploadedFahrzeugBildMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFahrzeugBildMap[file.name]
      }
      $('form').find('input[name="fahrzeug_bild[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($fahrzeuge) && $fahrzeuge->fahrzeug_bild)
      var files = {!! json_encode($fahrzeuge->fahrzeug_bild) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="fahrzeug_bild[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection