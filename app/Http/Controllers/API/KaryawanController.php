<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Karyawan::all();
        if ($data) {
            return ResponseFormatter::createResponse('200', 'success', $data);
        } else {
            return ResponseFormatter::createResponse('400', 'failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'NmKaryawan' => 'required',
                'Gender' => 'required'
            ]);

            $karyawan = Karyawan::create([
                'NmKaryawan' => $request->NmKaryawan,
                'Gender' => $request->Gender,
            ]);

            $data = Karyawan::where('id', '=', $karyawan->id)->get();
            if ($data) {
                return ResponseFormatter::createResponse('200', 'success', $data);
            } else {
                return ResponseFormatter::createResponse('400', 'failed');
            }
        } catch (Exception $err) {
            return ResponseFormatter::createResponse('400', 'failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getkaryawan_jobdesc($id)
    {
        $data = DB::table('karyawan_database')
            ->leftJoin('jobdesc', 'jobdesc.id', '=', 'karyawan_database.id')
            ->select('jobdesc.NmJobdesc', 'karyawan_database.NmKaryawan')->get();
        return ResponseFormatter::createResponse('200', 'success', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
