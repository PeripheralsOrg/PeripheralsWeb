<?php

namespace App\Http\Controllers;

use App\Models\AdmMenu;
use App\Models\AdmSubmenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    public function getSubmenu()
    {
        $getMenus = AdmMenu::all()->where('status', 1)->toArray();
        if ($getMenus) {
            return view('admin.forms.InsertSubmenu')->with('getMenus', $getMenus);
        }
        return redirect('falha-listMenus')->withErrors('Não foi possível atualizar o menu!');
    }

    public function getUpdate($id)
    {
        $getSubmenu = AdmSubmenu::all()->where('id', $id)->toArray();
        $getMenus = AdmMenu::all()->where('status', 1)->toArray();
        if ($getSubmenu && $getMenus) {
            return view('admin.forms.UpdateSubmenu')->with([
                'getSubmenu' => $getSubmenu,
                'getMenus' => $getMenus
            ]);
        }
        return back()->withErrors('Não é possivel atualizar o submenu no momento!');
    }

    public function register(Request $request, AdmSubmenu $submenu)
    {
        $validator = $request->validate([
            'id_menu' => ['required'],
            'titulo_submenu' => ['required'],
            'link_submenu' => ['required'],
            'status' => ['required'],
        ]);

        $create = $request->except(['_token']);
        $submenuC = $submenu->create($create);

        if (!$submenuC) {
            return back()->withErrors(['Ocorreu um erro ao criar o submenu!']);
        }

        return redirect()->route('page-listMenus');
    }

    public function delete($id)
    {
        $deleteAll = AdmSubmenu::findOrFail($id);

        $deleteAll->delete();
        if ($deleteAll) {
            return redirect()->route('page-listMenus');
        }
        return redirect('falha-listMenus')->withErrors('Não foi possível deletar o submenu!');
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'id_menu' => ['required'],
            'titulo_submenu' => ['required'],
            'link_submenu' => ['required'],
            'status' => ['required'],
        ]);


        $getSubmenu = AdmSubmenu::all()->where('id', $id)->toArray();

        if (empty($getSubmenu)) {
            return redirect('falha-listMenus');
        }

        $values = $request->except('_token', '_method');
        $updateSubmenu = (AdmSubmenu::all()->where('id', $id)->toQuery())->update($values);

        if ($updateSubmenu) {
            return redirect()->route('page-listMenus');
        }

        return back()->withErrors('Ocorreu um erro ao atualizar o submenu!');
    }
}
