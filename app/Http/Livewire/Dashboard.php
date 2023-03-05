<?php

namespace App\Http\Livewire;

use App\Models\SalesCommission;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class Dashboard extends Component
{

    public $config;
    public string $question;
    public array $dataset;

    public function render()
    {
        return view('admin.dashboard');
    }

    protected $rules = [
        'question' => 'required|min:10'
    ];

    public function generateReport()
    {
        $this->validate();

        $fields = implode(',',SalesCommission::getColumns());

        $this->config = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => "Considerando a lista de campos ($fields), gere uma configuração json do vega lite v5 (sem campo de dados e com descrição) que atenda o seguinte pedido {$this->question}",
            'max_tokens' => 1500
        ])->choices[0]->text;

        $this->config = str_replace('\n', "", $this->config);
        $this->config = json_decode($this->config, true);

        $this->dataset = ["values" => SalesCommission::get()->toArray()];

        return $this->config;
    }
}
