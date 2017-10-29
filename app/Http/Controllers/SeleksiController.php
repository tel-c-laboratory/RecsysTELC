<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Seleksi;
use Auth;

class SeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $berkas = Seleksi::find(Auth::user()->id);
      return view('peserta.attachment', compact('berkas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $seleksi = Seleksi::updateOrCreate(
        [
          'id' => Auth::user()->id,
        ],
        [
          'peminatan' => $request->peminatan,
        ]
      );

       return redirect()->route('home');
    }

    public function cekPeminatan(){
      if (Auth::user()->seleksi->peminatan == 'Study Group') {
        return 'SG';
      }
      return 'RG';
    }

    public function upload(Request $request)
    {
      // dd($request->berkas);
      if ($request->hasFile('berkas')) {
        $this->validate($request, [
            'berkas' => 'required|mimes:rar|max:2048',
        ]);

        $filename = "[RECSYS]_TELC17_". $this->cekPeminatan() . "_" . Auth::user()->nim . ".rar";
        $status = $request->berkas->storeAs('public/upload', $filename);

        $seleksi = Seleksi::updateOrCreate(
          [
            'id' => Auth::user()->id,
          ],
          [
            'berkas' => $filename,
          ]
        );

        return redirect()->route('home');
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
