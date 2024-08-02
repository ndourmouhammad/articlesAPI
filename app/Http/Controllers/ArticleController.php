<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Renvoie la liste de toutes les articles
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Enregistre un nouvel article
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'auteur' => 'required',
        ]);

        $article = Article::create($request->all());
    }

    /**
     * Afficher un article selon son identifiant
     */
    public function show(string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => "L'article n'existe pas"], 
            404);
        }

        return $article;
    }

    /**
     * Mettre à jour un article
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => "L'article n'existe pas"], 
            404);
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'auteur' => 'required',
        ]);

        $article->update($request->all());
        return $article;
    }

    /**
     * Supprimer un article
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => "L'article n'existe pas"], 
            404);
        }

        $article->delete();
        return response()->json(['message' => "L'article a bien été supprimé"]);
    }
}
