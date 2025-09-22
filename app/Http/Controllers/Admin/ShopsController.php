<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyShopRequest;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ShopsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Shop::with(['team'])->select(sprintf('%s.*', (new Shop)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'shop_show';
                $editGate      = 'shop_edit';
                $deleteGate    = 'shop_delete';
                $crudRoutePart = 'shops';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('shop_name', function ($row) {
                return $row->shop_name ? $row->shop_name : '';
            });
            $table->editColumn('item_name', function ($row) {
                return $row->item_name ? $row->item_name : '';
            });
            $table->editColumn('preis', function ($row) {
                return $row->preis ? $row->preis : '';
            });
            $table->editColumn('verkaufbar', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->verkaufbar ? 'checked' : null) . '>';
            });
            $table->editColumn('verkaufs_preis', function ($row) {
                return $row->verkaufs_preis ? $row->verkaufs_preis : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'verkaufbar']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.shops.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('shop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.shops.create');
    }

    public function store(StoreShopRequest $request)
    {
        $shop = Shop::create($request->all());

        return redirect()->route('admin.shops.index');
    }

    public function edit(Shop $shop)
    {
        abort_if(Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->load('team');

        return view('admin.shops.edit', compact('shop'));
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $shop->update($request->all());

        return redirect()->route('admin.shops.index');
    }

    public function show(Shop $shop)
    {
        abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->load('team');

        return view('admin.shops.show', compact('shop'));
    }

    public function destroy(Shop $shop)
    {
        abort_if(Gate::denies('shop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->delete();

        return back();
    }

    public function massDestroy(MassDestroyShopRequest $request)
    {
        $shops = Shop::find(request('ids'));

        foreach ($shops as $shop) {
            $shop->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
