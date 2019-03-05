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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class JsonController extends Controller {
    protected $json = [
        'error' => 0,
        'msg' => '',
    ];

    public function getSearch($model) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = new $modelClass();
            $attrs = $model->getAttributes();
            $this->json['result'] =  $attrs;
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function getIndex() {
        $this->json['info'] =  [
            'package' => 'laravel-json-rest'
        ];
        return $this->_json();
    }

    public function getList($model) {
        try {
            $formManagerClass = \config('json_rest.form-manager');
            $foormManager = new $formManagerClass("$model.list",request());
            $foorm = $foormManager->getForm();
            //$config = $foorm->getConfig();

            //$data = $foorm->getFormData();
            //$metadata = $foorm->getFormMetadata();

            $this->json['result'] = $foorm->getFormData();
            $this->json['metadata'] = $foorm->getFormMetadata();
            //$modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            //$model = $modelClass::paginate(5);
            //$this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function getShow($model,$pk) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = $modelClass::findOrFail($pk);
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function getNew($model) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            $model = new $modelClass();
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function postCreate($model) {
        $modelClass = \config('json_rest.models-namespace') . studly_case($model);
        $model = new $modelClass();
        $values = Input::get();
        $model->fill($values);
        $model->save();
    }


    public function getEdit($model,$pk) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = $modelClass::findOrFail($pk);
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function postUpdate($model,$pk) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = $modelClass::findOrFail($pk);
            $values = Input::get();
            $model->fill($values);
            $model->save();
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function delete($model,$pk) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            //die($modelClass);
            $model = $modelClass::findOrFail($pk);
            $model->delete();
            $this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }

    public function postDelete($model) {
        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            $ids = Input::get('ids',array());
//            echo "------ ids ----\n";
//            print_r($ids);
//            echo "----------------\n";

            if (count($ids) > 0) {
                //echo "destroy \n";
                $model = new $modelClass();
                $model->destroy($ids);
            }
            //$this->json['result'] =  $model->toArray();
        } catch (\Exception $e) {
            $this->_error($e->getMessage());
        }
        return $this->_json();
    }


    public function postSet($model,$fieldName,$value) {

        try {
            $modelClass = \config('json_rest.models-namespace') . studly_case($model);
            $id = Input::get('id');
            if (is_array($id)) {
                $modelClass::whereIn('id',$id)->update([$fieldName => $value]);
                $this->json['result'] = [];
            } else {
                //die($modelClass);
                $model = $modelClass::findOrFail($id);
                $model->$fieldName = $value;
                $model->save();
                $this->json['result'] =  $model->toArray();
            }

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