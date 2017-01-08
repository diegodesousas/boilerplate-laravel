<?php

namespace App\Http\Controllers;

use App\Actions\Author\CreateAction;
use App\Actions\Author\DeleteAction;
use App\Actions\Author\UpdateAction;
use App\Actions\ManagerActions;
use App\Http\Requests\Author\AuthorRequest;
use App\Model\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AuthorController extends Controller
{
    public function show(AuthorRequest $request)
    {
        return rest_response([
            'author' => $request->getAuthor()
        ]);
    }

    public function index()
    {
        return rest_response([
            'authors' => Author::all()
        ]);
    }

    public function save(Request $request, ManagerActions $manager)
    {
        $manager->add(CreateAction::class, $request->all());

        return $this->run($manager, "Autor registrado com sucesso.");
    }

    public function update(Request $request, ManagerActions $manager)
    {
        $all = $request->all();

        Arr::set($all, 'author.id', $request->route('id'));

        $manager->add(UpdateAction::class, $all);

        return $this->run($manager, "Autor atualizado com sucesso.");
    }

    public function delete(Request $request, ManagerActions $manager)
    {
        $data = [];

        Arr::set($data, 'author.id', $request->route('id'));

        $manager->add(DeleteAction::class, $data);

        return $this->run($manager, "Autor excluído com sucesso.");
    }
}