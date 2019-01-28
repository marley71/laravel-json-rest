<?php
/**
 * Created by PhpStorm.
 * User: pier
 * Date: 26/01/2019
 * Time: 18:13
 */

use \Tests\TestCase;

class RouteTest extends TestCase
{

    public function testExample()
    {

        $model = "user";
        $query = "/api/json/$model";
        echo "query: $query\n";
        $response = $this->get($query);
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);

        $query = "/api/json/$model/1";
        echo "query: $query\n";
        $response = $this->get($query);
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);


        $query = "/api/json/$model/new";
        echo "query: $query\n";
        $response = $this->get($query);
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);


        $query = "/api/json/$model";
        echo "CREATE query: $query\n";
        $response = $this->post($query,[
            'name' => 'ciccia',
            'email' => 'ciccia@ciccia.it',
            'password' => 'ciccia',
            '_method' => 'POST'
        ]);
        //echo $response->content();
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);





        $query = "/api/json/$model/1/edit";
        echo "GET EDIT query: $query\n";
        $response = $this->get($query);
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);



        $query = "/api/json/$model/1";
        echo "UPDATE query: $query\n";
        $response = $this->post($query,[
            'name' => 'ciccia',
            '_method' => 'PUT'
        ]);
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);

        $modelClass = \config('json_rest.models-namespace') . studly_case($model);
        $maxId = $modelClass::all()->max('id');

        $query = "/api/json/$model/$maxId";
        echo "DELETE query: $query\n";
        $response = $this->delete($query,[
            '_method' => 'DELETE'
        ]);
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);



        // testo multidelete ne creo uno nuovo



        $query = "/api/json/$model";
        echo "CREATE query: $query\n";
        $response = $this->post($query,[
            'name' => 'ciccia',
            'email' => 'ciccia@ciccia.it',
            'password' => 'ciccia',
            '_method' => 'POST'
        ]);
        //echo $response->content();
        $result = json_decode($response->content(),true);
        print_r($result);
        $response->assertStatus(200);
        assert($result['error'] == 0);


        $modelClass = \config('json_rest.models-namespace') . studly_case($model);
        $maxId = $modelClass::all()->max('id');

        $query = "/api/json/$model/delete";
            echo "MULTI DELETE query: $query\n";
            $response = $this->post($query,[
                'ids' =>  [$maxId]
            ]);
            $result = json_decode($response->content(),true);
            print_r($result);
            $response->assertStatus(200);
            assert($result['error'] == 0);






    }

}