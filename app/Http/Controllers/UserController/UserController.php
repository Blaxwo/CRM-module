<?php

namespace App\Http\Controllers\UserController;

use App\Jobs\SendWelcomeEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        define("users_per_page", 10);
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $users = $query->paginate(users_per_page);

        return view('users.index', compact('users'));
    }


    public function create()
    {
        return view('users.create');
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:8',
            'status' => 'boolean',
            'city' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'status' => $request->boolean('status', true),
            'city' => $request->input('city')
        ]);

        SendWelcomeEmailJob::dispatch($user);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:8',
            'city' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->status = $request->boolean('status');
        $user->updated_at = now();
        $user->city = $request->input('city');

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function get_weather(Request $request)
    {
        $city = $request->query('city');
        $cacheKey = "weather_{$city}";

        if (Cache::has($cacheKey)) {
            Log::info("Load data from cache for city: {$city}");
        } else {
            Log::info("Data is missing, doing API call for city: {$city}");
        }

        $weather = Cache::remember($cacheKey, env('CACHE_DURATION', 60), function () use ($city) {
            $url = env('OPENWEATHER_BASE_URL');
            $response = Http::get($url, [
                'q' => $city,
                'units' => 'metric',
                'appid' => env('OPENWEATHER_API_KEY')
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'temp' => $data['list'][0]['main']['temp'],
                    'description' => $data['list'][0]['weather'][0]['description']
                ];
            }

            return null;
        });

        return $weather
            ? response()->json($weather)
            : response()->json(['error' => 'Unable to fetch weather data'], 500);
    }
}

