<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationMoneyFormRequest;
use App\Models\Balance;
use App\Models\Group;
use App\Models\Status;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\Historic;
use App\Models\Institution;
use App\Models\User;

class ReportController extends Controller
{

    private $totalPagesPaginate = 9999;


    public function Financial(Historic $historic)
    {
        $this->pegar_tenant();
        $historics = Historic::with('status')->with('statuspag')
                    ->orderby('id','desc')
                    ->whereBetween('date', [date('Y/m/d'), date('Y/m/d')])
                    ->paginate($this->totalPagesPaginate);   
                    
        $types = $historic->type();      
        
        $total_preco = $historics->sum('amount');
        $total_entrada = $historics->where('type', 'I')->sum('amount');
        $total_saida = $historics->where('type', 'O')->sum('amount');

        $statuspag = Status::all()->where("type",'pagamento');
        $statusfinan = Status::all()->where("type",'financial');

        return view('reports.Financial', compact('historics', 'types', 'statuspag', 'statusfinan','total_preco', 'total_entrada', 'total_saida'));
    }

    public function searchFinancial(Request $request, Historic $historic)
    {
        $this->pegar_tenant();
        $dataForm = $request->except('_token');
        $historics =  $historic->search($dataForm, $this->totalPagesPaginate);
        $types = $historic->type();

        $total_preco = $historics->sum('amount');
        $total_entrada = $historics->where('type', 'I')->sum('amount');
        $total_saida = $historics->where('type', 'O')->sum('amount');

        $statuspag = Status::all()->where("type",'pagamento');
        $statusfinan = Status::all()->where("type",'financial');

        return view('reports.Financial', compact('historics', 'types', 'dataForm', 'statuspag', 'statusfinan', 'total_preco','total_entrada', 'total_saida'));
    }

    public function People(People $historic)
    {
        $this->pegar_tenant();
        $peoples = People::orderBy('name', 'asc')
            ->with('status')
            ->whereBetween('created_at', [date('Y/m/d'), date('Y/m/d')])
            ->paginate($this->totalPagesPaginate);
        $statuses = Status::all()->where("type", 'people');
        return view('reports.People', compact('peoples', 'statuses'));
    }

    public function searchPeople(Request $request, People $peoples)
    {
        $this->pegar_tenant();
        $dataForm = $request->except('_token');
        $date = date('Y');
        $statuses = Status::all()->where("type", 'people');
        $peoples =  $peoples->search($dataForm, $this->totalPagesPaginate);

        return view('reports.People', compact('peoples', 'dataForm', 'date', 'statuses'));
    }

    public function Group(Group $group)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $groups = Group::orderBy('name_group', 'asc')->with('status')->with('responsavel')->with('grouplist')->paginate($this->totalPagesPaginate);
        return view('reports.Group', compact('groups'));
    }
    public function searchHistoric(Request $request, Group $group)
    {
        $this->pegar_tenant();
        if ((session()->get('schema')) === null)
            return redirect()->route('account.index')->withErrors(['error' => __('Please select an account to continue')]);

        $dataForm = $request->except('_token');
        $groups =  $group->search($dataForm, $this->totalPagesPaginate);
        return view('reports.Group', compact('groups', 'dataForm'));
    }
}