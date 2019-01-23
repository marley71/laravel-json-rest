<?php namespace Marley71\JsonRest\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 23/01/2019
 * Time: 15:45
 */


use App\Http\Controllers\Controller;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;

class JsonController extends Controller {
    protected $json = [
        'error' => 0,
        'msg' => '',
    ];

    public function getIndex() {
        $this->json['info'] =  [
            'package' => 'laravel-json-rest'
        ];
        return $this->_json();
    }

    public function getList($model) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = $modelClass::paginate(5);
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function getShow($model,$pk) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = $modelClass::find($pk);
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function getNew($model) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            $model = $modelClass();
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    protected function _error($msg) {
        $this->json['error'] = 1;
        $this->json['msg'] = $msg;
    }

    protected function _json() {
        return Response::json($this->json);
    }
}