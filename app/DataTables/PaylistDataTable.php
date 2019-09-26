<?php

namespace App\DataTables;

use App\PaymentData;
use Yajra\DataTables\Services\DataTable;

class PaylistDataTable extends DataTable
{
    public function ajax()
    {
      return $this->datatables
          ->eloquent($this->query())
          ->make(true);
    }
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', 'paylistdatatable.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\PaymentData $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(PaymentData $model)
    {
        //return $model->newQuery()->select('idx', 'app_name', 'pay_type', 'term', 'amount', 'reg_time');
        $payment = PaymentData::select();

        return $this->applyScopes($payment);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                       'dom' => 'Bfrtip',
                       'buttons' => ['csv', 'excel', 'pdf'],
                   ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'idx',
            'app_name',
            'pay_type',
            'term',
            'amount',
            'reg_time'
        ];
    }

    // /**
    //  * Get parameter.
    //  *
    //  * @return array
    //  */
    // protected function getBuilderParameters()
    // {
    //     return [
    //         'idx',
    //         'app_name',
    //         'pay_type',
    //         'term',
    //         'amount',
    //         'reg_time'
    //     ];
    // }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Paylist_' . date('YmdHis');
    }
}
