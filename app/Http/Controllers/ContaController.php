<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use App\Models\SituacaoConta;
use Barryvdh\DomPDF\Facade\PDF;
use Exception;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    // Listar as contas (essa função index terá a missão de carregar a view listar)
    public function index(Request $request)
    {
        // Recuperar os registros da tabela contas do banco de dados
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
        ->when($request->filled('data_inicio'), function ($whenQuery) use ($request){
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        })
        ->when($request->filled('data_fim'), function ($whenQuery) use ($request){
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        })
        ->with('situacaoConta')
        ->orderBy('created_at')
        ->paginate(5)
        ->withQueryString();

        // 	created_at
        // 	updated_at

        // Carregar a view listar as Contas
        return view('contas.index', [
            'contas' => $contas,
            'nome' => $request->nome,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim
        ]);
    }


    // Detalhes da Conta
    public function show(Conta $conta)
    {
        // Carregar a view e Recuperar os dados da conta
        return view('contas.show', ['conta' => $conta]);
    }


    // Carregar o formulário cadastrar nova conta
    public function create()
    {
        // Recuperar os registros da tabela situacao_contas do banco de dados
        $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();
        
        return view('contas.create', ['situacoesContas' => $situacoesContas]);
    }


    // Cadastrar no banco de dados nova conta
    public function store(ContaRequest $request)
    {

        // Validar o formulário
        $request->validated();

        try {
            // Cadastrar no banco de dados na tabela contas os valores de todos os campos
            $conta = Conta::create([
                'nome' => $request->nome,
                'valor' => str_replace(',','.', str_replace('.','',$request->valor)),
                'vencimento' => $request->vencimento,
                'situacao_conta_id' => $request->situacao_conta_id,
            ]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('conta.show', ['conta' => $conta->id])->with('success', 'Conta cadastrada com sucesso!');
            
        }  catch (Exception $e) {
            // Redirecionar o usuário, enviar mensagem de erro
            return back()->withInput()->with('error', 'Conta não cadastrada!');
        }
        
    }
    

    // Carregar o formulário editar a conta
    public function edit(Conta $conta)
    {

        $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();

        return view('contas.edit', [
            'conta' => $conta,
            'situacoesContas' => $situacoesContas,
        ]);
    }

    // Editar no banco de Dados a Conta
    public function update(ContaRequest $request, Conta $conta)
    {
        // Validar o formulário
        $request->validated();

        try {
            // Editar no banco de dados a conta
        $conta->update([
            'nome' => $request->nome,
            'valor' => str_replace(',','.', str_replace('.','',$request->valor)),
            'vencimento' => $request->vencimento,
            'situacao_conta_id' => $request->situacao_conta_id,
        ]);
        
        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('conta.show', ['conta' => $conta->id])->with('success', 'Conta editada com sucesso!');

        } catch (Exception $e) {
            // Redirecionar o usuário, enviar mensagem de erro
            return back()->withInput()->with('error', 'Conta não editada!');
        }

        
    }

    // Excluir a conta no banco de dados
    public function destroy(Conta $conta)
    {
        // Excluir o registro do banco de dados
        $conta->delete();
        
        // Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('conta.index')->with('success', 'Conta excluída com sucesso!');
    }

    public function gerarPdf(Request $request){

        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
        ->when($request->filled('data_inicio'), function ($whenQuery) use ($request){
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
        })
        ->when($request->filled('data_fim'), function ($whenQuery) use ($request){
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
        })
        ->orderBy('created_at')
        ->get();

        // Calcular a soma dos valores
        $totalValor = $contas->sum('valor');
        
        $pdf = PDF::loadView('contas.gerar-pdf', [
            'contas' => $contas,
            'totalValor' => $totalValor
            ])->setPaper('a4', 'portrait');

        return $pdf->download('listar_contas.pdf');
    }
}