<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use withFaker;

/**
* CREATE-1
**/
/**
*Prueba que valida que se ha creado un producto exitósamente
**/
    public function test_client_can_create_a_product()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];
        
        /*$productData = Product::create(
            ['name'=>$this->$faker->firstName(), 
            'price'=> $this->$faker->randomNumber()]
        );*/

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);

        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);

    }

/**
* CREATE-2
**/

  public function test_client_can_create_a_product2()
    {
        // Given
        $productData = [
            'name' => '',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(422);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'code' => 'ERROR-1',
            'title' => 'Unprocessable Entity',
            
        ]);

 


    }

/**
* CREATE-3
**/

  public function test_client_can_create_a_product3()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => ''
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(422);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'code' => 'ERROR-1',
            'title' => 'Unprocessable Entity',
            
        ]);

 


    }
/**
* CREATE-4
**/

  public function test_client_can_create_a_product4()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => 'rtre'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(422);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'code' => 'ERROR-1',
            'title' => 'Unprocessable Entity',
            
        ]);

 


    }

/**
* CREATE-5
**/

  public function test_client_can_create_a_product5()
    {
        // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '-6'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(422);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'code' => 'ERROR-1',
            'title' => 'Unprocessable Entity',
            
        ]);
    }
/**
*UPDATE-1
**/
/**
*Prueba que valida que se puede actualizar un artículo
**/
public function test_client_can_update_a_product(){
     $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

    $response = $this->json('POST', '/api/products', $productData); 

    $body = $response->decodeResponseJson();
    
    $newProductData = [
            'name' => 'Superman',
            'price' => '300'
        ];

    $newResponse = $this->json('PUT', '/api/products/' . $body['id'], $newProductData);

    $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Superman',
                'price' => '300'
            ]
        );
    $newResponse->assertStatus(201);
}

/**
*UPDATE-2
**/
/**
*Prueba que valida que se puede actualizar un artículo
**/
public function test_client_can_update_a_product2(){

    $newProductData = [
            'name' => 'Superman',
            'price' => 'ioi'
        ];

    $newResponse = $this->json('PUT', '/api/products/' . '31', $newProductData);

        $newResponse->assertStatus(422);

        // Assert the product was created
        // with the correct data
        $newResponse->assertJsonFragment([
            'code' => 'ERROR-1',
            'title' => 'Unprocessable Entity',
            
        ]);



}

/**
*UPDATE-3
**/
/**
*Prueba que valida que se puede actualizar un artículo
**/
public function test_client_can_update_a_product3(){

    $newProductData = [
            'name' => 'Superman',
            'price' => '-25'
        ];

    $newResponse = $this->json('PUT', '/api/products/' . '31', $newProductData);

        $newResponse->assertStatus(422);

        // Assert the product was created
        // with the correct data
        $newResponse->assertJsonFragment([
            'code' => 'ERROR-1',
            'title' => 'Unprocessable Entity',
            
        ]);



}

/**
*UPDATE-4
**/
/**
*Prueba que valida que se puede actualizar un artículo
**/
public function test_client_can_update_a_product4(){

    $newProductData = [
            'name' => 'Superman',
            'price' => '20'
        ];

    $newResponse = $this->json('PUT', '/api/products/' . '440', $newProductData);

        $newResponse->assertStatus(404);

        // Assert the product was created
        // with the correct data
        $newResponse->assertJsonFragment([
            'code' => 'ERROR-2',
            'title' => 'Not found',
            
        ]);



}
/**
*DELETE-1
**/
/**
*Prueba que valida que se eliminó un artículo correctamente
**/
public function test_client_can_delete_a_product(){
      // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);



        $body = $response->decodeResponseJson();

        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
        $responseDelete = $this->json('DELETE', '/api/products/' . $body['id']);
        $responseDelete->assertStatus(200);
}


/**
*DELETE-2
**/
/**
*Prueba que valida que se eliminó un artículo correctamente
**/
public function test_client_can_delete_a_product2(){
        $responseDelete = $this->json('DELETE', '/api/products/' . '33');
           $responseDelete->assertJsonFragment([
            'code' => 'ERROR-2',
            'title' => 'Not found',
            
        ]);
            $responseDelete->assertStatus(404);
}

/**
*SEEALL-1
**/
/**
*Prueba que valida que se muestran todos los articulos
**/
    public function test_client_can_see_all(){
      

          $response = $this->json('GET', '/api/products');
            $response->assertStatus(200); 

    }

/**
*SEEALL-2
**/
/**
*Prueba que valida que se muestran todos los articulos
**/
    public function test_client_can_see_all2(){
      

          $response = $this->json('GET', '/api/products');
           
            $response->assertStatus(200); 

    }
/**
*SEE-1
**/
/**
*Prueba que valida que se muestra un artìculo
**/
	public function test_client_can_see_a_product(){
           // Given
        $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

 
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'id',
            'name',
            'price'
        ]);

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);

        $body = $response->decodeResponseJson();

        $response = $this->json('GET', '/api/products/' . $body['id']);

        // Assert product is on the database
       $this->assertDatabaseHas(
            'products',
            [
                'id' => $body['id'],
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
   
    $response->assertStatus(200); 
	}
    
/**
*SEE-2
**/
/**
*Prueba que valida que se muestra un artìculo
**/
    public function test_client_can_see_a_product2(){
        $response = $this->json('GET', '/api/products/' . '33');

        $response->assertJsonFragment([
            'code' => 'ERROR-2',
            'title' => 'Not found',
            
        ]);
   
    $response->assertStatus(404); 
    }
    


}
