<?php

namespace App\Http\Controllers;

use App\Models\AdmBanner;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;


class BannerController extends Controller
{

    //Tamanho máximo de arquivo: 5 Megabytes
    public const MAXIMUM_SIZE = 5000000;

    public function all()
    {
        $banners = AdmBanner::all()->where('status', 1)->toArray();
        if ($banners) {
            return view('admin.list.listCarrossel')->with('banners', $banners);
        }
        return redirect()->route('falha-listBanner');
    }

    public function register(Request $request, AdmBanner $banner)
    {
        $validator = $request->validate([
            'nome_banner' => ['required'],
            'link_route' => ['required'],
            'status' => ['required'],
        ]);

        $image = $request->file('link_carrossel');
        $imageMedium = $request->file('link_carrosselMedium');
        $imageTiny = $request->file('link_carrosselTiny');

        $checkBannerBig = (new BannerController())->checkImage($image, 'big');
        $checkBannerMedium = (new BannerController())->checkImage($imageMedium, 'medium');
        $checkBannerTiny = (new BannerController())->checkImage($imageTiny, 'tiny');

        $bannerC = $banner->create([
            'nome_banner' => $request->nome_banner,
            'link_route' => $request->link_route,
            'peso' => $checkBannerBig['size'],
            'status' => $request->status,
            'link_carrossel' => $checkBannerBig['path'],
            'link_carrosselMedium' => $checkBannerMedium['path'],
            'link_carrosselTiny' => $checkBannerTiny['path']

        ]);

        if ($bannerC) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Registrou um novo Banner', 'Banners');
            
            return redirect()->route('page-listCarrossel')->withErrors('Banner criado com sucesso!');
        }

        return back()->withErrors('Houve um erro ao cadastrar o banner');
    }

    private function checkImage($image, $type)
    {
        $request = new Request();
        if ($image->getMimeType() == 'image/png' || 'image/jpeg' || 'image/webp' || 'image/jpg') {
            if (!$image->isValid()) {
                return back()->withErrors('O arquivo não é válido');
            }

            if ($image->getSize() > BannerController::MAXIMUM_SIZE) {
                return back()->withErrors('O arquivo é grande demais');
            }

            if($type == 'big'){
                $imageName = str_replace('/', '-', $image->getMimeType()) . '-' . $request->input('nome_banner') . '.webp';
                $imageConvert = Image::make($image)->encode('webp')->getEncoded();
            }else if($type == 'medium'){
                $imageName = str_replace('/', '-', $image->getMimeType()) . '-' . $request->input('nome_banner') . '-'. 'medium' . '.webp';
                $imageConvert = Image::make($image)->encode('webp')->getEncoded();
            }else{
                $imageName = str_replace('/', '-', $image->getMimeType()) . '-' . $request->input('nome_banner') . '-' . 'tiny' . '.webp';
                $imageConvert = Image::make($image)->encode('webp')->getEncoded();
            }


            $uploadFile = Storage::disk('s3')->put(
                'files/' . $imageName,
                $imageConvert
            );

            // Método funcionando perfeitamente
            $pathUploadedFile = Storage::disk('s3')->url('files/' . $imageName);

            return [
                'path' => $pathUploadedFile,
                'size' => $image->getSize()
            ];
        }
    }

    public function fallback()
    {
        $erro = 'Banners não encontrados!';
        return view('admin.list.listCarrossel')->with('erro', $erro);
    }

    public function delete($id)
    {
        $deleteAll = AdmBanner::findOrFail($id);
        $deleteImage = Storage::delete($deleteAll->link_carrossel);
        $deleteAll->delete();
        if ($deleteAll && $deleteImage) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Apagou um Banner', 'Banner');

            return redirect()->route('page-listCarrossel')->withErrors('Banner deletado com sucesso');
        }

        return redirect('falha-listBanner')->withErrors('Não foi possível deletar o Banner!');
    }

    public function getUpdate($id)
    {
        $getBanner = AdmBanner::all()->where('id', $id)->toArray();
        if ($getBanner) {
            return view('admin.forms.UpdateBanner')->with('getBanner', $getBanner);
        }
        return redirect('falha-listBanner')->withErrors('Não foi possível atualizar o Banner!');
    }

    public function update(Request $request, $id, BannerController $banner)
    {
        $validator = $request->validate([
            'nome_banner' => ['required'],
            'link_route' => ['required'],
            'status' => ['required'],
        ]);

        $image = $request->file('link_carrossel');
        $imageMedium = $request->file('link_carrosselMedium');
        $imageTiny = $request->file('link_carrosselTiny');

        $checkBannerBig = (new BannerController())->checkImage($image, 'big');
        $checkBannerMedium = (new BannerController())->checkImage($imageMedium, 'medium');
        $checkBannerTiny = (new BannerController())->checkImage($imageTiny, 'tiny');

        $bannerValues = [
            'nome_banner' => $request->nome_banner,
            'link_route' => $request->link_route,
            'peso' => $checkBannerBig['size'],
            'status' => $request->status,
            'link_carrossel' => $checkBannerBig['path'],
            'link_carrosselMedium' => $checkBannerMedium['path'],
            'link_carrosselTiny' => $checkBannerTiny['path']
        ];

        $deleteImage = Storage::delete((AdmBanner::findOrFail($id))->link_carrossel);
        $updateBanner = (AdmBanner::all()->where('id', $id)->toQuery())->update($bannerValues);


        if ($updateBanner && $deleteImage) {
            // Monitoramento log
            $userLogEmail = array_values(Session::get('user'))[0]['email'];
            LogController::writeFile($userLogEmail, 'Atualizou um Banner', 'Banner');

            return redirect()->route('page-listCarrossel')->withErrors('Banner atualizado com sucesso!');
        }

        return back()->withErrors('Houve um erro ao atualizar o banner');
    }
}
