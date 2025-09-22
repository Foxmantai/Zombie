@extends('layouts.admin')
@section('content')
@can('fahrzeuge_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.fahrzeuges.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.fahrzeuge.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Fahrzeuge', 'route' => 'admin.fahrzeuges.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.fahrzeuge.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Fahrzeuge">
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
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($kategoriens as $key => $item)
                                <option value="{{ $item->kategorie }}">{{ $item->kategorie }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('fahrzeuge_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.fahrzeuges.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.fahrzeuges.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'fahrzeug_bild', name: 'fahrzeug_bild', sortable: false, searchable: false },
{ data: 'fahrzeug_name', name: 'fahrzeug_name' },
{ data: 'spawn_name', name: 'spawn_name' },
{ data: 'preis', name: 'preis' },
{ data: 'kofferraum_groesse', name: 'kofferraum_groesse' },
{ data: 'herstellbar', name: 'herstellbar' },
{ data: 'im_shop', name: 'im_shop' },
{ data: 'kategorie', name: 'kategories.kategorie' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Fahrzeuge').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection