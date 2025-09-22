@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tebexLizenzen.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tebex-lizenzens.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="haendler">{{ trans('cruds.tebexLizenzen.fields.haendler') }}</label>
                <input class="form-control {{ $errors->has('haendler') ? 'is-invalid' : '' }}" type="text" name="haendler" id="haendler" value="{{ old('haendler', '') }}">
                @if($errors->has('haendler'))
                    <div class="invalid-feedback">
                        {{ $errors->first('haendler') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tebexLizenzen.fields.haendler_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gekauft_am">{{ trans('cruds.tebexLizenzen.fields.gekauft_am') }}</label>
                <input class="form-control date {{ $errors->has('gekauft_am') ? 'is-invalid' : '' }}" type="text" name="gekauft_am" id="gekauft_am" value="{{ old('gekauft_am') }}">
                @if($errors->has('gekauft_am'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gekauft_am') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tebexLizenzen.fields.gekauft_am_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tebexid">{{ trans('cruds.tebexLizenzen.fields.tebexid') }}</label>
                <input class="form-control {{ $errors->has('tebexid') ? 'is-invalid' : '' }}" type="text" name="tebexid" id="tebexid" value="{{ old('tebexid', '') }}">
                @if($errors->has('tebexid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tebexid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tebexLizenzen.fields.tebexid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="preis">{{ trans('cruds.tebexLizenzen.fields.preis') }}</label>
                <input class="form-control {{ $errors->has('preis') ? 'is-invalid' : '' }}" type="text" name="preis" id="preis" value="{{ old('preis', '') }}">
                @if($errors->has('preis'))
                    <div class="invalid-feedback">
                        {{ $errors->first('preis') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tebexLizenzen.fields.preis_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.tebexLizenzen.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tebexLizenzen.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="produkt">{{ trans('cruds.tebexLizenzen.fields.produkt') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('produkt') ? 'is-invalid' : '' }}" name="produkt" id="produkt">{!! old('produkt') !!}</textarea>
                @if($errors->has('produkt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('produkt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.tebexLizenzen.fields.produkt_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.tebex-lizenzens.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $tebexLizenzen->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection