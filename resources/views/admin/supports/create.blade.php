@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.support.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.supports.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="titel">{{ trans('cruds.support.fields.titel') }}</label>
                <input class="form-control {{ $errors->has('titel') ? 'is-invalid' : '' }}" type="text" name="titel" id="titel" value="{{ old('titel', '') }}" required>
                @if($errors->has('titel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('titel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.titel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ingame_name">{{ trans('cruds.support.fields.ingame_name') }}</label>
                <input class="form-control {{ $errors->has('ingame_name') ? 'is-invalid' : '' }}" type="text" name="ingame_name" id="ingame_name" value="{{ old('ingame_name', '') }}" required>
                @if($errors->has('ingame_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ingame_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.ingame_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="grund">{{ trans('cruds.support.fields.grund') }}</label>
                <textarea class="form-control {{ $errors->has('grund') ? 'is-invalid' : '' }}" name="grund" id="grund" required>{{ old('grund') }}</textarea>
                @if($errors->has('grund'))
                    <div class="invalid-feedback">
                        {{ $errors->first('grund') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.grund_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="supporter">{{ trans('cruds.support.fields.supporter') }}</label>
                <input class="form-control {{ $errors->has('supporter') ? 'is-invalid' : '' }}" type="text" name="supporter" id="supporter" value="{{ old('supporter', '') }}">
                @if($errors->has('supporter'))
                    <div class="invalid-feedback">
                        {{ $errors->first('supporter') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.supporter_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.support.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Support::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Offen') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.support.fields.kategorie') }}</label>
                <select class="form-control {{ $errors->has('kategorie') ? 'is-invalid' : '' }}" name="kategorie" id="kategorie" required>
                    <option value disabled {{ old('kategorie', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Support::KATEGORIE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('kategorie', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategorie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kategorie') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.kategorie_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beweismittel">{{ trans('cruds.support.fields.beweismittel') }}</label>
                <div class="needsclick dropzone {{ $errors->has('beweismittel') ? 'is-invalid' : '' }}" id="beweismittel-dropzone">
                </div>
                @if($errors->has('beweismittel'))
                    <div class="invalid-feedback">
                        {{ $errors->first('beweismittel') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.support.fields.beweismittel_helper') }}</span>
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
    var uploadedBeweismittelMap = {}
Dropzone.options.beweismittelDropzone = {
    url: '{{ route('admin.supports.storeMedia') }}',
    maxFilesize: 500, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 500
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="beweismittel[]" value="' + response.name + '">')
      uploadedBeweismittelMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedBeweismittelMap[file.name]
      }
      $('form').find('input[name="beweismittel[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($support) && $support->beweismittel)
          var files =
            {!! json_encode($support->beweismittel) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="beweismittel[]" value="' + file.file_name + '">')
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