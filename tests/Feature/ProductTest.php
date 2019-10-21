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


/**
*Prueba que valida que se ha creado un producto exitósamente
**/
    public function test_client_can_create_a_product3()
    {
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

        // Assert the response has the correct structure
      

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);

        $body = $response->decodeResponseJson();

     
    }

/**
*Prueba que valida que se puede actualizar un artículo
**/
public function test_client_can_update_a_product3(){
   $productData = [
            'name' => 'Super Product',
            'price' => '23.30'
        ];
    $response = $this->json('POST', '/api/products', $productData); 
    $response->assertStatus(201);
    
    $body = $response->decodeResponseJson();
    
    $newProductData = [
            'name' => 'Superman',
            'price' => '300'
        ];
    $newResponse = $this->json('PUT', '/api/products/' . $body['id'], $newProductData);
    
     $response->assertStatus(201);
}

/**
*Prueba que valida que se eliminó un artículo correctamente
**/
public function test_client_can_delete_a_product3(){
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

                $responseDelete = $this->json('DELETE', '/api/products/' . $body['id']);
        $responseDelete->assertStatus(200);
}

/**
*Prueba que valida que se muestran todos los articulos
**/
    public function test_client_can_see_all(){
          $productData = [

         'name' => 'Super Product',
            'price' => '23.30'
          
        ];
         $response = $this->json('POST', '/api/products', $productData); 


       

          $response = $this->json('GET', '/api/products');
            $response->assertStatus(200); 

    }

/**
*Prueba que valida que se muestra un artìculo
**/
	public function test_client_can_see_a_product3(){
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
       
   
    $response->assertStatus(200); 
	}
    

}
