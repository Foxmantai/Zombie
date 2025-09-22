<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\Kategorien;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Item::with(['kategorie', 'team'])->select(sprintf('%s.*', (new Item)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'item_show';
                $editGate      = 'item_edit';
                $deleteGate    = 'item_delete';
                $crudRoutePart = 'items';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('item_name', function ($row) {
                return $row->item_name ? $row->item_name : '';
            });
            $table->editColumn('spawn_name', function ($row) {
                return $row->spawn_name ? $row->spawn_name : '';
            });
            $table->editColumn('gewicht', function ($row) {
                return $row->gewicht ? $row->gewicht : '';
            });
            $table->editColumn('seltenes_item', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->seltenes_item ? 'checked' : null) . '>';
            });
            $table->addColumn('kategorie_kategorie', function ($row) {
                return $row->kategorie ? $row->kategorie->kategorie : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'seltenes_item', 'kategorie']);

            return $table->make(true);
        }

        $kategoriens = Kategorien::get();
        $teams       = Team::get();

        return view('admin.items.index', compact('kategoriens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Kategorien::pluck('kategorie', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.items.create', compact('kategories'));
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->all());

        return redirect()->route('admin.items.index');
    }

    public function edit(Item $item)
    {
        abort_if(Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Kategorien::pluck('kategorie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $item->load('kategorie', 'team');

        return view('admin.items.edit', compact('item', 'kategories'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());

        return redirect()->route('admin.items.index');
    }

    public function show(Item $item)
    {
        abort_if(Gate::denies('item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->load('kategorie', 'team', 'endergebnisWerkbankes');

        return view('admin.items.show', compact('item'));
    }

    public function destroy(Item $item)
    {
        abort_if(Gate::denies('item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemRequest $request)
    {
        $items = Item::find(request('ids'));

        foreach ($items as $item) {
            $item->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
