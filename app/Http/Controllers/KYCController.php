<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\StoreKYCRequest;
use App\Http\Requests\UpdateKYCRequest;
use App\Models\KYC;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;


class KYCController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('KYC.index', [
            'data' => KYC::where('user_id', auth()->id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('KYC.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKYCRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKYCRequest $request)
    {

        if (KYC::where('user_id', auth()->id())->where('status', Status::PENDING)->count() > 0) {
            return redirect()->back()->withErrors([
                'pending' => 'Your last request is pending'
            ]);
        }

        $photo = $request->file('photo');
        $folder = '/uploads/images/' . auth()->id() . '/';
        $photoPath = $folder . time() . '_photo_' . $photo->getFilename() . '.' . $photo->getClientOriginalExtension();
        $this->uploadOne($photo, $folder, 'public-uploads', time() . '_photo_' . $photo->getFilename());

        $front = $request->file('front');
        $frontPath = $folder . time() . '_front_' .  $front->getFilename() . '.' . $front->getClientOriginalExtension();
        $this->uploadOne($front, $folder, 'public-uploads', time() . '_front_' .  $front->getFilename());

        $back = $request->file('back');
        $backPath = $folder . time() . '_back_' .  $back->getFilename() . '.' . $back->getClientOriginalExtension();
        $this->uploadOne($back, $folder, 'public-uploads', time() . '_back_' .  $back->getFilename());


        KYC::create([
            'user_id' => auth()->id(),
            'photo' => $photoPath,
            'front' => $frontPath,
            'back' => $backPath,
        ]);

        return redirect()->route('KYC.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KYC  $kYC
     * @return \Illuminate\Http\Response
     */
    public function show(KYC $kYC)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KYC  $kYC
     * @return \Illuminate\Http\Response
     */
    public function edit(KYC $kYC)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKYCRequest  $request
     * @param  \App\Models\KYC  $kYC
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKYCRequest $request, KYC $kyc)
    {
        KYC::where('id', $request->id)->first()->update([
            'status' => $request->status
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KYC  $kYC
     * @return \Illuminate\Http\Response
     */
    public function destroy(KYC $kYC)
    {
        //
    }

    public function list()
    {
        return view('KYC.list', [
            'data' => KYC::with('user')->get()
        ]);
    }
}