<?php

namespace App\Http\Livewire\Supplier;

use App\Models\Supplier;
use App\Models\Person;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SupplierDataTable extends LivewireDatatable
{
    use LivewireAlert;
    public $exportable = true;
    public $model = Supplier::class;

    public function builder()
    {

        return (Supplier::query()
            ->where('suppliers.state', '!=', 'ELIMINADO')
            ->join('people as person', function ($join) {
                $join->on('person.id', '=', 'suppliers.person_id');
            })
            ->join('telephones', function ($join) {
                $join->on('person.id', '=', 'telephones.person_id');
            })
            ->join('supplier_categories as category', function ($join) {
                $join->on('category.id', '=', 'suppliers.supplier_category_id');
            }));
    }

    public function columns()
    {
        return [

            Column::name('category.name')
                ->searchable()
                ->label('Categoria')
                ->alignRight(),

/*                 Column::callback(['person.name', 'person.lastname'], function ($name, $lastname) {
                    return $name.' '.$lastname;
                })
                ->label('Responsable'), */
    

            Column::name('suppliers.name')
                ->searchable()
                ->label('Proveedor')
                ->alignRight(),


            Column::name('telephones.number')
                ->label('Teléfono')
                ->alignRight(),
                

            Column::callback(['slug'], function ($slug) {
                return view('livewire.supplier.supplier-table-actions', ['slug' => $slug]);
            })->label('Opciones')
                ->excludeFromExport()


        ];
    }
    public $idDelet;
    public function toastConfirmDelet($slug)
    {
        $supplier = Supplier::where('slug', $slug)->firstOrFail();
        $this->idDelet = $supplier->id;
        $this->confirm(__('¿Estás seguro de que deseas eliminar el registro?'), [
            'icon' => 'warning',
            'position' =>  'center',
            'toast' =>  false,
            'text' =>  'Usuario ' . $supplier->email,
            'confirmButtonText' =>  'Si',
            'showConfirmButton' =>  true,
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonColor' => '#A5DC86',
        ]);
    }

    protected $listeners = [
        'confirmed',
    ];
    public function confirmed()
    {
        if ($this->idDelet) {
            $Supplier = Supplier::find($this->idDelet);
            $Supplier->state = "ELIMINADO";
            $Supplier->update();
        }
    }
}
