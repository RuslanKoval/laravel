<?php
/**
 * Created by PhpStorm.
 * User: ruslan
 * Date: 21.02.17
 * Time: 11:38
 */

namespace App\Http\Controllers;


use App\Employee;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use HTML;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends Controller
{

    public function index()
    {
        $employees = Employee::where('chief', '=', 0)->get();
        $allEmployees = Employee::pluck('fullname', 'id')->all();
        return view('employee.index', compact('employees', 'allEmployees'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $text = "<h1>All employees list</h1>";

        $grid = new Grid(
            (new GridConfig)
                ->setDataProvider(
                    new EloquentDataProvider(Employee::query())
                )
                ->setName('employee_grid')
                ->setPageSize(15)
                ->setColumns([
                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('ID')
                        ->setSortable(true)
                        ->setSorting(Grid::SORT_ASC)
                    ,
                    (new FieldConfig)
                        ->setName('fullname')
                        ->setLabel('Name')
                        ->setCallback(function ($val) {
                            return "<span class='glyphicon glyphicon-user'></span> {$val}";
                        })
                        ->setSortable(true)
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('position')
                        ->setLabel('Position')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            return $val;
                        })
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_LIKE)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('salary')
                        ->setLabel('Salary')
                        ->setSortable(true)
                        ->setCallback(function ($val) {
                            return "$val $";
                        })
                        ->addFilter(
                            (new FilterConfig)
                                ->setOperator(FilterConfig::OPERATOR_EQ)
                        )
                    ,
                    (new FieldConfig)
                        ->setName('id')
                        ->setLabel('Operation')
                        ->setCallback(function ($val) {
                            $urlDelete = route('employer_delete', ['id' => $val]);
                            $urlUpdate = route('employer_update', ['id' => $val]);
                            return "<a href='{$urlDelete}'>delete</a>
                                    <a href='{$urlUpdate}'>update</a>";
                        })
                        ->setSortable(false)
                    ,
                ])
        );
        return view('employee.show', compact('grid', 'text'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $employee = Employee::find($id);
        $employee->delete();
        return back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view(Request $request)
    {
        $id = $request->id;
        $employee = Employee::find($id);

        return view('employee.view', [
            'employee' => $employee,
            'chief' => $this->getChiefList()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('employee.create', [
            'chief' => $this->getChiefList()
        ]);
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'fullname' => 'required|max:255',
            'position' => 'required|max:255',
            'employment_date' => 'date',
            'salary' => 'required|integer',
            'chief' => 'required|integer',
        ]);

        $employee = new Employee();
        $data = $request->all();
        $employee->fill($data);
        $employee->employment_date = strtotime($employee->employment_date);
        if($employee->save()) {
            return redirect('employer/show')->with('message', 'Save is success');
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|max:255',
            'position' => 'required|max:255',
            'employment_date' => 'date',
            'salary' => 'required|integer',
            'chief' => 'required|integer',
        ]);

        $employee = Employee::find($id);
        $data = $request->all();
        $data['employment_date'] = strtotime($data['employment_date']);
        $employee->update($data);

        if($employee->save()) {
            return redirect('employer/show')->with('message', 'Save is success');
        }
    }

    /**
     * @return array
     */
    private function getChiefList()
    {
        $chief = Employee::all(['fullname','id']);
        $newArray = [
            '0' => 'default'
        ];
        foreach ($chief as $item) {
            $newArray[$item->id] = $item->fullname;
        }
        return $newArray;
    }
}