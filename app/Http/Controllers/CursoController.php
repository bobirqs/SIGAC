<?php

namespace App\Http\Controllers;

use App\Repositories\CursoRepository;
use Illuminate\Http\Request;
use App\Repositories\EixoRepository;
use App\Repositories\NivelRepository;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $repository;

    public function __construct()
    {
        $this->repository = new CursoRepository();
    }


    public function index()
    {
        $data = $this->repository->selectAllWith(['eixo', 'nivel']);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $objEixo = (new EixoRepository())->findById($request->eixo_id);
        $objNivel = (new NivelRepository())->findById($request->nivel_id);

        if(isset($objEixo) && isset($objNivel))
        {
            $curso = new Curso();
            $curso->nome = mb_strtoupper($request->nome, 'UTF-8');
            $curso->sigla = mb_strtoupper($request->sigla, 'UTF-8');
            $curso->total_horas = $request->horas;
            $curso->eixo()->associate($objEixo);
            $curso->nivel()->associate($objNivel);

            $this->repository->save($curso);

            return "parabuains";

        }
        return "BURRO ESSE EIXO OU NIVEL N EXISTE";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
