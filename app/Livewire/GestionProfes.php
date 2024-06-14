<?php

namespace App\Livewire;

use App\Models\Profesor;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class GestionProfes extends Component
{
    use WithFileUploads;

    public $profesores, $nombre, $descripcion, $nivel_edu, $kills, $xp, $dificultad, $peligro, $curiosidades, $horario, $categoria, $correo;
    public $atributos = [], $habilidades, $semestres;
    public $habilidadesArray = [];
    public $clases = [
        'clases_frecuentes' => ['', '', ''],
        'clases_ocasionales' => ['', '', '']
    ];
    public $imagen1, $imagen2, $tema;
    public $profesor_id;
    public $like;
    public $isOpen = false;
    public $isOpenConfirmationModal = false;

    public $tipos = ['Común', 'Poco Común', 'Raro', 'Muy Raro', 'Legendario'];
    public $tiposSeleccionados = [];
    public $paciencia = 0, $amabilidad = 0, $comprension = 0, $exigencia = 0;
    public function toggleTipo($tipo)
    {

        if (in_array($tipo, $this->tiposSeleccionados)) {

            $this->tiposSeleccionados = array_diff($this->tiposSeleccionados, [$tipo]);
        } else {

            $this->tiposSeleccionados[] = $tipo;
        }


        if (empty($this->tiposSeleccionados)) {
            $this->tiposSeleccionados[] = $tipo;
        }
    }


    public function toggleSemestre($semestre)
    {

        $semestresArray = $this->semestres ? explode(',', $this->semestres) : [];


        if (in_array($semestre, $semestresArray)) {

            $semestresArray = array_diff($semestresArray, [$semestre]);
        } else {

            $semestresArray[] = $semestre;
        }


        if (empty($semestresArray)) {
            $semestresArray[] = $semestre;
        }


        $this->semestres = implode(',', $semestresArray);
    }


    public function mount($profesor = null)
    {
        if ($profesor) {
            $this->profesor_id = $profesor->id;
            $this->nombre = $profesor->nombre;
            $this->descripcion = $profesor->descripcion;
            $this->nivel_edu = $profesor->nivel_edu;
            $this->kills = $profesor->kills;
            $this->xp = $profesor->xp;
            $this->dificultad = $profesor->dificultad;
            $this->peligro = $profesor->peligro;
            $this->paciencia = $profesor->atributos['Paciencia'] ?? 0;
            $this->amabilidad = $profesor->atributos['amabilidad'] ?? 0;
            $this->comprension = $profesor->atributos['comprension'] ?? 0;
            $this->exigencia = $profesor->atributos['exigencia'] ?? 0;
            $this->curiosidades = $profesor->curiosidades;
            $this->horario = $profesor->horario;
            $this->categoria = $profesor->categoria;
            $this->habilidadesArray = explode(',', $profesor->habilidades);
            $this->semestres = $profesor->semestres;
            $this->clases = json_decode($profesor->clases, true) ?? [
                'clases_frecuentes' => ['', '', ''],
                'clases_ocasionales' => ['', '', '']
            ];

            foreach (['clases_frecuentes', 'clases_ocasionales'] as $tipo) {
                $this->clases[$tipo] = array_pad($this->clases[$tipo], 3, '');
            }

            $imagenes = json_decode($profesor->imagen, true);
            $this->imagen1 = $imagenes[0] ?? '';
            $this->imagen2 = $imagenes[1] ?? '';
            $this->tema = $profesor->tema;
            $this->tiposSeleccionados = explode(',', $profesor->tipo);
            $this->correo = $profesor->correo;
            $this->like = $profesor->like;
        }
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->nivel_edu = '';
        $this->kills = '';
        $this->xp = '';
        $this->dificultad = '';
        $this->peligro = '';
        $this->paciencia = 0;
        $this->amabilidad = 0;
        $this->comprension = 0;
        $this->exigencia = 0;
        $this->curiosidades = '';
        $this->horario = '';
        $this->categoria = '';
        $this->habilidades = '';
        $this->semestres = '';
        $this->clases = [
            'clases_frecuentes' => ['', '', ''],
            'clases_ocasionales' => ['', '', '']
        ];
        $this->imagen1 = '';
        $this->imagen2 = '';
        $this->tema = '';
        $this->tiposSeleccionados = [];
        $this->correo = '';
        $this->like = 0;
        $this->profesor_id = null;
        $this->habilidadesArray = [];
    }
    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'semestres' => 'required',
            'kills' => 'required',
            'xp' => 'required',
            'nivel_edu' => 'required',
            'dificultad' => 'required',
            'peligro' => 'required',
            'curiosidades' => 'required',
            'horario' => 'required',
            'categoria' => 'required',
            'tiposSeleccionados' => 'required',
            'correo' => 'required',
            'imagen1' => empty($this->imagen1) && empty($this->imagen2) && empty($this->tema) ? 'required|image' : '',
            'imagen2' => empty($this->imagen1) && empty($this->imagen2) && empty($this->tema) ? 'required|image' : '',
            'tema' => empty($this->imagen1) && empty($this->imagen2) && empty($this->tema) ? 'required|file' : '',
            'habilidadesArray' => function ($attribute, $value, $fail) {
                $notEmpty = false;
                foreach ($value as $habilidad) {
                    if (!empty($habilidad)) {
                        $notEmpty = true;
                        break;
                    }
                }
                if (!$notEmpty) {
                    $fail('Al menos una habilidad es requerida.');
                }
            },
            'clases.clases_frecuentes' => function ($attribute, $value, $fail) {
                $notEmpty = false;
                foreach ($value as $clase) {
                    if (!empty($clase)) {
                        $notEmpty = true;
                        break;
                    }
                }
                if (!$notEmpty) {
                    $fail('Al menos una clase frecuente es requerida.');
                }
            },
        ]);

        $atributos = [
            'Paciencia' => $this->paciencia,
            'amabilidad' => $this->amabilidad,
            'comprension' => $this->comprension,
            'exigencia' => $this->exigencia,
        ];
        $this->habilidadesArray = array_slice(array_filter($this->habilidadesArray), 0, 6);
        $this->tiposSeleccionados = array_filter($this->tiposSeleccionados);

        $this->clases['clases_frecuentes'] = array_values(array_filter($this->clases['clases_frecuentes']));
        $this->clases['clases_ocasionales'] = array_values(array_filter($this->clases['clases_ocasionales']));


        $imagen1Path = $this->imagen1 instanceof \Illuminate\Http\UploadedFile ? 'storage/' . $this->imagen1->storeAs('profesores', $this->imagen1->getClientOriginalName()) : $this->imagen1;
        $imagen2Path = $this->imagen2 instanceof \Illuminate\Http\UploadedFile ? 'storage/' . $this->imagen2->storeAs('stands', $this->imagen2->getClientOriginalName()) : $this->imagen2;
        $temaPath = $this->tema instanceof \Illuminate\Http\UploadedFile ? 'storage/' . $this->tema->storeAs('temas', $this->tema->getClientOriginalName()) : $this->tema;


        if ($this->profesor_id) {
            $profesor = Profesor::find($this->profesor_id);
            $imagen1 = $imagen1Path ? $imagen1Path : $profesor->imagen[0];
            $imagen2 = $imagen2Path ? $imagen2Path : $profesor->imagen[1];

            $profesor->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'nivel_edu' => $this->nivel_edu,
                'kills' => $this->kills,
                'xp' => $this->xp,
                'dificultad' => $this->dificultad,
                'like' => $profesor->like,
                'peligro' => $this->peligro,
                'atributos' => $atributos,
                'curiosidades' => $this->curiosidades,
                'horario' => $this->horario,
                'categoria' => $this->categoria,
                'habilidades' => implode(',', $this->habilidadesArray),
                'semestres' => $this->semestres,
                'clases' => json_encode($this->clases),
                'imagen' => json_encode([$imagen1, $imagen2]),
                'tema' => $temaPath ?? $profesor->tema,
                'tipo' => implode(',', $this->tiposSeleccionados),
                'correo' => $this->correo,
            ]);
        } else {
            Profesor::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'nivel_edu' => $this->nivel_edu,
                'kills' => $this->kills,
                'xp' => $this->xp,
                'dificultad' => $this->dificultad,
                'like' => 0,
                'peligro' => $this->peligro,
                'atributos' => $atributos,
                'curiosidades' => $this->curiosidades,
                'horario' => $this->horario,
                'categoria' => $this->categoria,
                'habilidades' => implode(',', $this->habilidadesArray),
                'semestres' => $this->semestres,
                'clases' => json_encode($this->clases),
                'imagen' => json_encode([$imagen1Path, $imagen2Path]),
                'tema' => $temaPath,
                'tipo' => implode(',', $this->tiposSeleccionados),
                'correo' => $this->correo,
            ]);
        }

        session()->flash('message', $this->profesor_id ? 'Profesor actualizado correctamente.' : 'Profesor creado correctamente.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        $this->profesor_id = $id;
        $this->nombre = $profesor->nombre;
        $this->descripcion = $profesor->descripcion;
        $this->nivel_edu = $profesor->nivel_edu;
        $this->kills = $profesor->kills;
        $this->xp = $profesor->xp;
        $this->dificultad = $profesor->dificultad;
        $this->peligro = $profesor->peligro;
        $this->paciencia = $profesor->atributos['Paciencia'] ?? 0;
        $this->amabilidad = $profesor->atributos['amabilidad'] ?? 0;
        $this->comprension = $profesor->atributos['comprension'] ?? 0;
        $this->exigencia = $profesor->atributos['exigencia'] ?? 0;
        $this->curiosidades = $profesor->curiosidades;
        $this->horario = $profesor->horario;
        $this->categoria = $profesor->categoria;
        $this->habilidadesArray = explode(',', $profesor->habilidades);
        $this->semestres = $profesor->semestres;
        $this->clases = json_decode($profesor->clases, true) ?? [
            'clases_frecuentes' => ['', '', ''],
            'clases_ocasionales' => ['', '', '']
        ];

        foreach (['clases_frecuentes', 'clases_ocasionales'] as $tipo) {
            $this->clases[$tipo] = array_pad($this->clases[$tipo], 3, '');
        }

        $imagenes = json_decode($profesor->imagen, true);
        $this->imagen1 = $imagenes[0] ?? '';
        $this->imagen2 = $imagenes[1] ?? '';
        $this->tema = $profesor->tema;
        $this->tiposSeleccionados = explode(',', $profesor->tipo);
        $this->correo = $profesor->correo;
        $this->like = $profesor->like;

        $this->openModal();
    }


    public function confirmDelete($profesorId)
    {
        $this->profesor_id = $profesorId;
        $this->isOpenConfirmationModal = true;
    }

    public function closeModalConfirmation()
    {
        $this->profesor_id = null;
        $this->isOpenConfirmationModal = false;
    }

    public function delete()
    {
        $profesor = Profesor::find($this->profesor_id);
        if ($profesor) {
            $imagenes = json_decode($profesor->imagen, true);
            if (is_array($imagenes)) {
                foreach ($imagenes as $img) {
                    Storage::delete($img);
                }
            }
            $profesor->delete();
            session()->flash('message', 'Profesor eliminado correctamente.');
        }

        $this->isOpenConfirmationModal = false;
        $this->profesor_id = null;
    }


    public function render()
    {
        $this->profesores = Profesor::all();
        return view('livewire.gestion-profes');
    }
}
