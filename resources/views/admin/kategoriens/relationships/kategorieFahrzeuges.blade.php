@can('fahrzeuge_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fahrzeuges.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fahrzeuge.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.fahrzeuge.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-kategorieFahrzeuges">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.fahrzeug_bild') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.fahrzeug_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.spawn_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.preis') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.kofferraum_groesse') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.herstellbar') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.im_shop') }}
                        </th>
                        <th>
                            {{ trans('cruds.fahrzeuge.fields.kategorie') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fahrzeuges as $key => $fahrzeuge)
                        <tr data-entry-id="{{ $fahrzeuge->id }}">
                            <td>

                            </td>
                            <td>
                                @foreach($fahrzeuge->fahrzeug_bild as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $fahrzeuge->fahrzeug_name ?? '' }}
                            </td>
                            <td>
                                {{ $fahrzeuge->spawn_name ?? '' }}
                            </td>
                            <td>
                                {{ $fahrzeuge->preis ?? '' }}
                            </td>
                            <td>
                                {{ $fahrzeuge->kofferraum_groesse ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $fahrzeuge->herstellbar ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $fahrzeuge->herstellbar ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $fahrzeuge->im_shop ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $fahrzeuge->im_shop ? 'checked' : '' }}>
                            </td>
                            <td>
                                @foreach($fahrzeuge->kategories as $key => $item)
                                    <span class="badge badge-info">{{ $item->kategorie }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('fahrzeuge_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.fahrzeuges.show', $fahrzeuge->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('fahrzeuge_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.fahrzeuges.edit', $fahrzeuge->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('fahrzeuge_delete')
                                    <form action="{{ route('admin.fahrzeuges.destroy', $fahrzeuge->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fahrzeuge_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fahrzeuges.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-kategorieFahrzeuges:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection