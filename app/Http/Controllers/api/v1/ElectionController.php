<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckEmailRequest;
use App\Http\Resources\ElectionResource;
use App\Jobs\SendLinkJob;
use App\Models\Election;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ElectionController extends Controller
{
    public function index(Request $request)
    {
        return ElectionResource::collection(Election::query()->paginate($request->per_page??15));
    }
    public function checkEmail(CheckEmailRequest $request){
        $token = Str::random(64);
//        $request->request->add(['token' => $token]);
        $data['email']=$request->email;
        $data['token']=$token;
        $election = Election::query()->where('email', '=', $request->email);
        DB::table('elections')
            ->where('email','=', $request->email)
            ->update([
                'token' => $token,
            ]);
        $election->update($request->validated());
        SendLinkJob::dispatch($data);
        return response()->json([
            'message' => 'We have e-mailed your link!'
        ]);
    }

    public function confirmAccount(Request $request){
        $confirmToken = Election::query()
            ->where([
                'token' => $request->token
            ])
            ->first();
        if(!$confirmToken
//            &&
//            $confirmToken->approved == 0 &&
//            $confirmToken->updated_at < Carbon::now()->subDay()
            ){
            return response()->json([
                'error' => 'Invalid token!'
            ]);
        }
        $user = Election::query()->where('token', $request->token)
            ->update(['approved' => 1]);
        return response()->json([
            'message' => 'Your account activated!'
        ]);
    }
}
