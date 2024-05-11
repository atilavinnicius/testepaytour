<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurriculoRequest;
use App\Models\CadastroCurriculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContatoController extends Controller
{
    const CAMINHOARQUIVOS = "storage/app/curriculos/";

    public function storeCurriculo(StoreCurriculoRequest $request)
    {
        try {
            $contCurriculo = new CadastroCurriculo($request->all());

            $fileCurriculo = $request->file('fileCurriculo');
            $extensaoFileCurriculo = $fileCurriculo->getClientOriginalExtension();
            $fileName = Str::slug($contCurriculo->nome, '-') . '_curriculo.' . $extensaoFileCurriculo;
            $caminhoArquivo = self::CAMINHOARQUIVOS;

            Storage::put($caminhoArquivo . $fileName, file_get_contents($fileCurriculo));

            $contCurriculo->caminhoArquivo = $caminhoArquivo . $fileName;
            $contCurriculo->save();

            return response()->json(['Response do StoreCurriculo' => $contCurriculo], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao salvar o currículo: ' . $e->getMessage()], 500);
        }
    }
}
