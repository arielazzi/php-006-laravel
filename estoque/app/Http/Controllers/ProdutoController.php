<?php namespace estoque\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Request;
use Validator;
use estoque\Produto;
use estoque\Http\Requests\ProdutoRequest;

class ProdutoController extends Controller {

	public function lista()
	{
		$produtos = Produto::all();

		if (view()->exists('produto.listagem'))
		{
			return view('produto.listagem')
				->withProdutos($produtos);
		}
	}

	public function mostra($id)
	{
		$produto = Produto::find($id);

		if (empty($produto))
		{
			return "Esse produto não existe";
		}
		return view('produto.detalhes')
			->withProduto($produto);
	}

	public function remove($id)
	{
		$produto = Produto::find($id);
		$produto->delete();

		return redirect()
			->action('ProdutoController@lista');
	}


	public function novo()
	{
		return view('produto.formulario');
	}

	public function adiciona(ProdutoRequest $request)
	{
		Produto::create($request->all());

		return redirect()
			->action('ProdutoController@lista')
			->withInput(Request::only('nome'));

	}

	public function listaJson()
	{
	    $produtos = Produto::all();
	    return response()
	    	->json($produtos);
	}


}