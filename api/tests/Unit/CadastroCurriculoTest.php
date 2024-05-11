<?php

namespace Tests\Unit;

use App\Models\CadastroCurriculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class CadastroCurriculoTest extends TestCase
{
    use RefreshDatabase;


    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_campos_cadastrocurriculo()
    {
        $cadastro = new CadastroCurriculo();

        $campos = $cadastro->getFillable();

        // Campos esperados
        $camposEsperados = [
            'nome',
            'email',
            'telefone',
            'cargoDesejado',
            'escolaridade',
            'dataEnvio',
            'horaEnvio',
            'observacoes',
            'ipCliente',
            'caminhoArquivo',
        ];

        // Verificar se os campos esperados existem no modelo
        foreach ($camposEsperados as $campo) {
            $this->assertContains($campo, $campos);
        }
    }
}
