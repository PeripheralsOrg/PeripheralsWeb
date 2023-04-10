<?php

namespace App\Http\Controllers;

use App\Models\AdmMenu;
use App\Models\AdmSubmenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function all()
    {
        $menus = AdmMenu::all()->where('status', 1)->toArray();
        $submenus = AdmSubmenu::all()->where('status', 1)->toArray();

        if (!empty($menus) && empty($submenus)) {
            $erroSubmenu = 'Submenus não encontrados';
            return view('admin.list.listMenus')->with([
                'menus' => $menus,
                'erroSubmenu' => $erroSubmenu
            ]);
        } else if (!empty($menus) && !empty($submenus)) {
            return view('admin.list.listMenus')->with([
                'menus' => $menus,
                'submenus' => $submenus
            ]);
        }else{
            return redirect('falha-listMenus');
        }
    }

    public function fallback()
    {
        $erro = 'Não foi possível encontrar nada!';
        return view('admin.list.listMenus')->with('erro', $erro);
    }


    public function register(Request $request, AdmMenu $menu)
    {
        $validator = $request->validate([
            'titulo' => ['required'],
            'link_menu' => ['required'],
            'status' => ['required'],
        ]);

        $create = $request->except(['_token']);
        $menuC = $menu->create($create);

        if (!$menuC) {
            return back()->withErrors(['Ocorreu um erro ao criar o menu!']);
        }

        return redirect()->route('page-listMenus');
    }

    public function delete($id)
    {
        $deleteAll = AdmMenu::findOrFail($id);
        $deleteSubmenus = AdmSubmenu::all()->where('id_menu', $id);

        if(count($deleteSubmenus) > 0){
            ($deleteSubmenus->toQuery())->delete();
        }

        $deleteAll->delete();
        if ($deleteAll) {
            return redirect()->route('page-listMenus');
        }
        return redirect('falha-listMenus')->withErrors('Não foi possível deletar o menu!');
    }

    public function getUpdate($id)
    {
        $getMenu = AdmMenu::all()->where('id', $id)->toArray();
        if ($getMenu) {
            return view('admin.forms.UpdateMenu')->with('getMenu', $getMenu);
        }
        return back()->withErrors('Não é possivel inserir novos submenus no momento!');
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'titulo' => ['required'],
            'link_menu' => ['required'],
            'status' => ['required'],
        ]);


        $getMenu = AdmMenu::all()->where('id', $id)->toArray();

        if (empty($getMenu)) {
            return redirect('falha-listMenus');
        }

        $values = $request->except('_token', '_method');
        $updateMenu = (AdmMenu::all()->where('id', $id)->toQuery())->update($values);

        if ($updateMenu) {
            return redirect()->route('page-listMenus');
        }

        return back()->withErrors('Ocorreu um erro ao atualizar o menu!');
    }

}
