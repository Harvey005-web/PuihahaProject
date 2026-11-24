<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
class WeatherController extends Controller {
    public function __invoke(Request $request) {
        $data = $request->validate(['lat'=>['required','numeric','between:-90,90'],'lon'=>['required','numeric','between:-180,180']]);
        $key = config('membership.openweather_key');
        if (!$key) return response()->json(['message'=>'Weather is not configured yet.'],503);
        $lat = round((float)$data['lat'],3);
        $lon = round((float)$data['lon'],3);
        try {
            $weather = Cache::remember("weather:$lat:$lon",600,function () use ($lat,$lon,$key) {
                $result = Http::connectTimeout(3)->timeout(8)->get('https://api.openweathermap.org/data/2.5/weather',[
                    'lat'=>$lat,'lon'=>$lon,'units'=>'metric','appid'=>$key,
                ])->throw()->json();
                return ['place'=>$result['name'] ?? 'Selected location','temperature'=>$result['main']['temp'] ?? null,
                    'description'=>$result['weather'][0]['description'] ?? '', 'humidity'=>$result['main']['humidity'] ?? null];
            });
            return response()->json($weather);
        } catch (\Throwable $exception) {
            // Do not expose upstream URLs containing the API key.
            return response()->json(['message'=>'Weather is temporarily unavailable.'],503);
        }
    }
}

