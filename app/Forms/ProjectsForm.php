<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ProjectsForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('proj_title', 'text', ['label' => 'Tajuk Project'])
            ->add('proj_start_date', 'date', ['label' => 'Tarikh Mula'])
            ->add('proj_end_date', 'date', ['label' => 'Tarikh Tamat'])
            ->add('user_id', 'number', ['label' => 'ID Pengguna'])
            ->add('submit', 'submit', ['label' => 'Hantar', 'class' => 'btn btn-primary'])
            ->add('clear', 'reset', ['label' => 'Isi Semula', 'class' => 'btn btn-warning']);
    }
}
