<?php

namespace App\Http\Controllers;

use App\Models\DemandedGoods;
use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_name = $request->search_name;

        $goods = Goods::with(['demandedGoods', 'demandedGoods.user', 'demandedGoods.task'])
                    ->when($search_name, function($q) use($search_name){
                        return $q->where('name', 'like', '%' . $search_name . '%');
                    })
                    ->paginate(5);
        
        return view('goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100',
            'total' => 'required'
        ]);
        $validateData['total_og'] = $validateData['total'];

        Goods::create($validateData);

        return redirect()->route('goods.index')->with('session', 'Barang Baru berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $good)
    {
        $demandedGoods = DemandedGoods::with('task')->where('goods_id', $good->id)->paginate(25);

        return view('goods.show', compact('good', 'demandedGoods'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit(Goods $good)
    {
        return view('goods.edit', compact('good'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $goods)
    {
        $rule = [
            'name' => 'required|max:100',
            'total' => 'required'
        ];

        $validateData = $request->validate($rule);
        $validateData['total_acc'] = $validateData['total'];

        $goods->update($validateData);

        return redirect()->route('categories.index')->with('session', 'Data Barang berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $good)
    {
        $good->delete();

        return back()->with('success','Data Terhapus');
    }
}
