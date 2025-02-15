<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookingSetting;

use App\Models\UnitBisnis;
use App\Traits\UserLogTrait;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BookingSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use UserLogTrait;
    public function ajax_list()
    {
        $data = BookingSetting::all();
        return DataTables::of($data)
            ->addColumn('booking_time', function($data){
                return '<div>'.$data->start_time.' - '.$data->finish_time.'</div>';
            })
            ->addColumn('is_active', function($data){
                if($data->is_active == 1) {
                    return '<center><i title="active" class="fa fa-check-circle text-success"></i></center>';
                } else {
                    return '<center><i title="not active" class="fa fa-exclamation-circle text-danger"></i></center>';
                }
            })
            
            ->addColumn('type', function($data){
                if($data->type == 1) {
                    return 'Single Date';
                } else if($data->type == 2) {
                    return 'Every Day';
                }
            })
            
            ->addColumn('unit_id', function($data) {
                $unit = UnitBisnis::find($data->unit_id);
                return $unit->name_unit;
            })
           
            ->addColumn('action', function($data){
                if(adminAuth()->level == 'admin') {
                    return '<a href="javascript:void(0);" class="bs-tooltip text-warning mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Edit" aria-label="Edit" data-bs-original-title="Edit" title="Edit" onclick="editData('.$data->id.')"><i class="far fa-edit"></i></a>';
                } else {
                    return '<a href="javascript:void(0);" class="bs-tooltip text-warning mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Edit" aria-label="Edit" data-bs-original-title="Edit" title="Edit" onclick="editData('.$data->id.')"><i class="far fa-edit"></i></a>&nbsp;<a href="javascript:void(0);" class="bs-tooltip text-danger mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Hapus" aria-label="Hapus" data-bs-original-title="Hapus" title="Hapus" onclick="deleteData('.$data->id.')"><i class="far fa-times-circle"></i></i></a>';
                }
                
        })->rawColumns(['action','is_active','booking_time','type','unit_id'])
        ->addIndexColumn()
        ->make(true);
    }


    public function index()
    {
        $view = 'booking-setting';
        $units = UnitBisnis::where('status_booking', 'Aktif')->get();
        return view('admins.booking_setting.index', compact('view','units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        if($input['type'] == 1) {
            $input['booking_day'] = "";
        } else {
            $input['date'] = null;
        }

        $rules = array(
            "type" => "required",
            "unit_id" => "required",
            "finish_time" => "required",
            "is_active" => "required"
        );

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $pesan = $validator->errors();
            $pesanarr = explode(",", $pesan);
            $find = array("[","]","{","}");
            $html = '';
            foreach($pesanarr as $p ) {
                $html .= str_replace($find,"",$p).'<br>';
            }
            
            return response()->json([
                "success" => false,
                "message" => $html
            ]);
        }

        BookingSetting::create($input);
        $this->insert_log(adminAuth()->id, "Booking Setting (add new data in booking setting)", "add");
        return response()->json([
            "success" => true,
            "message" => "Success"
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = BookingSetting::findorFail($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        
        if($input['type'] == 1) {
            $input['booking_day'] = "";
        } else {
            $input['date'] = null;
        }

        $rules = array(
            "type" => "required",
            "unit_id" => "required",
            "finish_time" => "required",
            "is_active" => "required"
        );

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            $pesan = $validator->errors();
            $pesanarr = explode(",", $pesan);
            $find = array("[","]","{","}");
            $html = '';
            foreach($pesanarr as $p ) {
                $html .= str_replace($find,"",$p).'<br>';
            }
            
            return response()->json([
                "success" => false,
                "message" => $html
            ]);
        }

        $data = BookingSetting::findorFail($id);
        $data->update($input);
        $this->insert_log(adminAuth()->id, "Booking Setting (update data in booking setting)", "update");
        return response()->json([
            "success" => true,
            "message" => "Success"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $query = BookingSetting::destroy($id);
        $this->insert_log(adminAuth()->id, "Booking Setting", "delete");
        return $query;
    }
}