<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGameHostingRequest;
use App\Models\GameHosting;
use Illuminate\Http\Request;

class GameHostingsController extends Controller
{
    /**
     * Get list of all game hostings
     */
    public function __construct()
    {
        $this->game_hostings = GameHosting::query()
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * Show game hostings index page
     */
    public function index()
    {
        return view('admin.game-hostings', [
            'game_hostings' => $this->game_hostings
        ]);
    }

    /**
     * Add game hosting
     */
    public function store(StoreGameHostingRequest $request)
    {
        GameHosting::create([
            'name' => $request->name,
            'link' => $request->link
        ]);

        return back()->with([
            'success' => 'Hosting gry został dodany pomyślnie.'
        ]);
    }

    /**
     * Delete game hosting
     */
    public function destroy($id)
    {
        $game_hosting = GameHosting::query()
            ->where('id', '=', $id)
            ->first();
        $game_hosting->delete();

        return back()->with([
            'success' => 'Hosting gry został usunięty pomyślnie.'
        ]);
    }

    /**
     * Modify game hosting
     */
    public function update(Request $request, $id)
    {
        $game_hosting = GameHosting::query()
            ->where('id', '=', $id)
            ->first();

        $game_hosting->update([
            'name' => $request->name,
            'link' => $request->link
        ]);
    }

}
