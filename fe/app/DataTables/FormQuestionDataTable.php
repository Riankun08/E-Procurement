<?php

namespace App\DataTables;

use App\Models\FormQuestion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FormQuestionDataTable extends DataTable
{
    public $view = 'form.form-question.';
    protected $group_id;
    public function setData($group_id)
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query);
            // return view($this->view.'action', compact('user'))->render();
            // ->addColumn('action', function ($user) {
            //     return view('users.action', compact('user'))->render();
            // });[[G]]
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FormQuestion $model)
    {
        return $model->where('form_group_id' , $this->group_id)->orderBy('sequence', 'asc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('kt_table_form_question')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('create'),
            Button::make('export'),
            Button::make('print'),
            Button::make('reset'),
            Button::make('reload')
        );
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('title'),
            Column::make('type'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FormQuestion_' . date('YmdHis');
    }
}
