<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ThesisSeminarCollection;
use App\Models\ThesisSeminar;
use Carbon\Carbon;

class ThesisSeminarUpcomingController extends Controller
{
    public function index()
    {
        $thesisSeminars = ThesisSeminar::where('seminar_at', '>=', Carbon::now())
            ->get();

        return new ThesisSeminarCollection($thesisSeminars);
    }
}
