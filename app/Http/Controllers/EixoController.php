<?php

namespace App\Http\Controllers;

use App\Repositories\EixoRepository;
use Illuminate\Http\Request;
use App\Models\Eixo;

class EixoController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new EixoRepository();
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAll();
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
        $eixo = new Eixo();
        $eixo->nome = mb_strtoupper($request->nome, 'UTF8');
        $this->repository->save($eixo);

        return $request->nome;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->repository->findById($id);
        return $data;
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
        $eixo = $this->repository->findById($id);
        if(isset($eixo))
        {
            $eixo->nome = mb_strtoupper($request->nome, 'UTF8');
            $this->repository->save($eixo);
            return "Muito top";
        }

        return "erro muito errado";
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($this->repository->delete($id))
        {
            return "Acerto gamer";

        }
        return "Erro noob";
    }
}
