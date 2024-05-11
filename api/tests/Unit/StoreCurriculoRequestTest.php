<?php

namespace Tests\Unit;

use App\Http\Requests\StoreCurriculoRequest;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\TestCase;

class StoreCurriculoRequestTest extends TestCase
{
    public function test_validacao_campos_obrigatorios()
{
    $request = new StoreCurriculoRequest();
    $rules = $request->rules();

    $this->assertArrayHasKey('nome', $rules, "A regra 'nome' está presente.");
    $this->assertArrayHasKey('email', $rules, "A regra 'email' está presente.");
    $this->assertArrayHasKey('observacoes', $rules, "A regra 'observacoes' está presente.");
    $this->assertStringContainsString('max:255', $rules['observacoes'], "A regra 'max:255' está presente no campo 'observacoes'.");
    //A regra required não esta presente no campo observacoes
    $this->assertStringNotContainsString('required', $rules['observacoes'], "A regra 'required' está ausente no campo 'observacoes'.");
}

}
