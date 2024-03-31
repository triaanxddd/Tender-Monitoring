<?php

namespace App\Http\Controllers;

use App\Models\DemandedGoods;
use App\Models\Goods;
use Illuminate\Http\Request;

class DemandedGoodsController extends Controller
{
    public function create(Request $request){
        $validateData = $request->validate([
            'goods_id' => 'required|integer',
            'quantity' => 'required',
            'task_id' => 'required|integer'
        ]);
        $validateData['user_id'] = auth()->user()->id;

        DemandedGoods::create($validateData);

        return redirect()->back()->with('success', 'Permintaan Barang sudah dibuat!');
    }

    public function approve($id){
        $demandedGoods = DemandedGoods::findOrFail($id);
        $goods = Goods::findOrFail($demandedGoods->goods_id);

        //result subitude total by demandend quantity
        $result = $goods->total - $demandedGoods->quantity;
    
        if($demandedGoods->quantity > $goods->total){
            return redirect()->back()->with('danger', 'Barang yang diminta lebih dari total barang!');
        }

        //update row
        $demandedGoods->update(['approval' => 1]);
        $goods->update(['total' => $result]);

        return redirect()->back()->with('success', 'Permintaan disetujui!');
    }

    public function disapprove($id){
        $demandedGoods = DemandedGoods::findOrFail($id);
        $goods = Goods::findOrFail($demandedGoods->goods_id);

        //return back result when it cancelled
        $result = $goods->total + $demandedGoods->quantity;

        //update row
        $demandedGoods->update(['approval' => 0]);
        $goods->update(['total' => $result]);

        return redirect()->back()->with('success', 'Permintaan dibatalkan!');
    }

    public function destroy($id){
        $demandedGoods = DemandedGoods::findOrFail($id);

        $demandedGoods->delete();
        return redirect()->back()->with('success', 'Permintaan dihapus!');

    }
}
