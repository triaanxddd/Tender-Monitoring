<?php
function tracker($status_pemenang, $task){
    $relationUraian = count($task->uraians);
    $relationLaporan = count($task->laporans);
    $relationPenagihan = count($task->penagihans);
    $relationPembayaran = count($task->pembayarans);


    //0 = Menunggu
    if($status_pemenang == 0){
        return 'Menunggu Proses Lelang';
    }
    //1 = lanjut -> uraian
    elseif($status_pemenang == 1){
        //lanjut
        if($relationUraian > 0){
            if($relationLaporan > 0){
                if($relationPenagihan > 0){
                    if($relationPembayaran > 0){
                        return 'Pekerjaan Selesai';
                    }
                    return 'Pembayaran';
                }
                return 'Penagihan';
            }
            return 'Laporan';
        }
        return 'Uraian';
    }

    //2 = kalah STOP
    elseif($status_pemenang == 2){
        return 'Kalah Lelang';
    }
}
