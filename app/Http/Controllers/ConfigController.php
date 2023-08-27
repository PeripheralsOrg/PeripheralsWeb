<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Marcas;
use Illuminate\Support\Facades\Session;

class ConfigController extends Controller
{

    public function all()
    {
        $categorias = Categoria::all()->toArray();
        $marcas = Marcas::all()->where('status', 1)->toArray();

        if (!empty($categorias) && empty($marcas)) {
            $erroMarcas = 'Marcas não encontrados';
            return view('admin.list.listConfig')->with([
                'categorias' => $categorias,
                'erroMarcas' => $erroMarcas
            ]);
        } else if (!empty($categorias) && !empty($marcas)) {
            return view('admin.list.listConfig')->with([
                'categorias' => $categorias,
                'marcas' => $marcas
            ]);
        } else if (!empty($marcas) && empty($categorias)) {
            $erroCategorias = 'Categorias não encontrados';
            return view('admin.list.listConfig')->with([
                'categorias' => $erroCategorias,
                'marcas' => $marcas
            ]);
        } else {
            return redirect()->route('falha-listConfig');
        }
    }

    public function fallback()
    {
        $erro = 'Ocorreu um erro ao encontrar as configurações!';
        return view('admin.list.listConfig')->with('erro', $erro);
    }

    //! Categoria

    public function registerCategoria(Request $request, Categoria $categoria)
    {
        $validator = $request->validate([
            'categoria' => ['required'],
        ]);

        $create = $request->except(['_token']);
        $categoriaC = $categoria->create($create);

        if ($categoriaC) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Registrou uma nova Categoria', 'Configurações');
            
            return redirect()->route('page-listConfig')->withErrors('Categoria criada com sucesso!');
        }

        return back()->withErrors('Houve um erro ao cadastrar a categoria');
    }

    public function deleteCategoria($id)
    {
        $deleteAll = Categoria::findOrFail($id);
        $deleteAll->delete();
        if ($deleteAll) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Apagou uma categoria', 'Configurações');

            return redirect()->route('page-listConfig')->withErrors('Categoria deletada com sucesso');
        }


        return redirect('falha-listConfig')->withErrors('Não foi possível deletar a categoria!');
    }

    public function getUpdateCategoria($id)
    {
        $getCategoria = Categoria::all()->where('id_categoria', $id)->toArray();
        if ($getCategoria) {
            return view('admin.forms.UpdateCategoria')->with('getCategoria', $getCategoria);
        }
        return redirect('falha-listConfig')->withErrors('Não foi possível atualizar a categoria!');
    }

    public function updateCategoria(Request $request, $id)
    {
        $validator = $request->validate([
            'categoria' => ['required'],
        ]);

        $create = $request->except(['_token', '_method']);

        $updateCategoria = (Categoria::all()->where('id_categoria', $id)->toQuery())->update($create);

        if ($updateCategoria) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Atualizou uma categoria', 'Configurações');

            return redirect()->route('page-listConfig')->withErrors('Categoria atualizada com sucesso!');
        }

        return back()->withErrors('Houve um erro ao atualizar a categoria');
    }


    //! Marca

    public function registerMarca(Request $request, Marcas $categoria)
    {
        $validator = $request->validate([
            'nome' => ['required'],
            'descricao_atividades' => ['required'],
            'status' => ['required'],
        ]);

        $create = $request->except(['_token']);
        $marcaC = $categoria->create($create);

        if ($marcaC) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Registrou uma nova Marca', 'Configurações');

            return redirect()->route('page-listConfig')->withErrors('Marca criada com sucesso!');
        }

        return back()->withErrors('Houve um erro ao cadastrar a marca');
    }

    public function deleteMarca($id)
    {
        $deleteAll = Marcas::findOrFail($id);
        $deleteAll->delete();
        if ($deleteAll) {
            return redirect()->route('page-listConfig')->withErrors('Marca deletada com sucesso');
        }
        return redirect('falha-listConfig')->withErrors('Não foi possível deletar a marca!');
    }

    public function getUpdateMarca($id)
    {
        $getMarca = Marcas::all()->where('id_marca', $id)->toArray();
        if ($getMarca) {
            return view('admin.forms.UpdateMarca')->with('getMarca', $getMarca);
        }
        return redirect('falha-listConfig')->withErrors('Não foi possível atualizar a marca!');
    }

    public function updateMarca(Request $request, $id)
    {
        $validator = $request->validate([
            'nome' => ['required'],
            'descricao_atividades' => ['required'],
            'status' => ['required'],
        ]);

        $create = $request->except(['_token', '_method']);

        $updateMarca = (Marcas::all()->where('id_marca', $id)->toQuery())->update($create);

        if ($updateMarca) {
            return redirect()->route('page-listConfig')->withErrors('Marca atualizada com sucesso!');
        }
        return back()->withErrors('Houve um erro ao atualizar a marca');
    }

    public function getMarca($id)
    {
        $getMarca = Marcas::all()->where('id_marca', $id)->toQuery();
        if ($getMarca) {
            return $getMarca;
        }
        return false;
    }

    public function getCategoria($id)
    {
        $getCategoria = Categoria::all()->where('id_categoria', $id)->toQuery();
        if ($getCategoria) {
            return $getCategoria;
        }
        return false;
    }
}
