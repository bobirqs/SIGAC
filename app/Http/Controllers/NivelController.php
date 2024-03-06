<?php

namespace App\Http\Controllers;

use App\Repositories\NivelRepository;
use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelController extends Controller
{
    protected $repository;

    public function __construct() {
        $this->repository = new NivelRepository();
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->selectAllWith(['curso']);
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
        $nivel = new Nivel();
        $nivel->nome = mb_strtoupper($request->nome, 'UTF8');
        $this->repository->save($nivel);

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
        $nivel = $this->repository->findById($id);
        if(isset($nivel))
        {
            $nivel->nome = mb_strtoupper($request->nome, 'UTF8');
            $this->repository->save($nivel);
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
