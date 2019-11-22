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
    public function test_client_can_create_a_product()
    {
          // Given
        $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super Product',
                    'price' => '23.30'
                ]
            ]
        ];
        // When
        $response = $this->json('POST', '/api/products', $productData); 
        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);
        // Assert the response has the correct structure
        $response->assertJsonStructure([
            'data' => [
                '*' =>  array_keys((new Product())->toArray())
            ]
        ]);
        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super Product',
            'price' => '23.30'
        ]);
        $id =  json_encode($response->baseResponse->original->id);
        // Assert product is on the database
        $this->assertDatabaseHas(
            'products',
            [
                'id' => $id,
                'name' => 'Super Product',
                'price' => '23.30'
            ]
        );
     
    }
      public function test_client_can_create_a_product2()
    {
        // Given
       $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => '',
                    'price' => '23.30'
                ]
            ]
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
     public function test_client_can_create_a_product3()
    {
        // Given
        $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super Product',
                    'price' => ''
                ]
            ]
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

  public function test_client_can_create_a_product4()
    {
        // Given
        $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super Product',
                    'price' => 'wqewq'
                ]
            ]
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
     public function test_client_can_create_a_product5()
    {
        // Given
         $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super',
                    'price' => '-6'
                ]
            ]
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
*Prueba que valida que se puede actualizar un artículo
**/
public function test_client_can_update_a_product(){
  
        $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super',
                    'price' => '23.30'
                ]
            ]
        ];
         $response = $this->json('POST', '/api/products', $productData); 
   $body = json_encode($response->baseResponse->original->id);
    $response->assertStatus(201);
    
      
    $newProductData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Supe',
                    'price' => '23.30'
                ]
            ]
        ];

        $response1 = $this->json('PUT', '/api/products/' . $body, $newProductData);
        
        $valor = $this->json('GET', '/api/products/' . $body);
     
        //print_r(json_encode($primerValor). ' =/= '. json_encode($segundoValor));
        
}
public function test_client_can_update_a_product2(){
       $newProductData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super',
                    'price' => 'eqwe'
                ]
            ]
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
public function test_client_can_update_a_product3(){
   $newProductData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Supe',
                    'price' => '-45'
                ]
            ]
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
public function test_client_can_update_a_product4(){
     $newProductData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Supe',
                    'price' => '45'
                ]
            ]
        ];
    $newResponse = $this->json('PUT', '/api/products/100' . '4400', $newProductData);
        $newResponse->assertStatus(404);
        // Assert the product was created
        // with the correct data
        $newResponse->assertJsonFragment([
            'code' => 'ERROR-2',
            'title' => 'Not found',
            
        ]);
}
/**
*Prueba que valida que se eliminó un artículo correctamente
**/
public function test_client_can_delete_a_product3(){
      // Given
    $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super',
                    'price' => '23.30'
                ]
            ]
        ];
        // When
        $response = $this->json('POST', '/api/products', $productData); 

        // Then
        // Assert it sends the correct HTTP Status
        $response->assertStatus(201);



        $body = json_encode($response->baseResponse->original->id);

        $responseDelete = $this->json('DELETE', '/api/products/' . $body);
        $responseDelete->assertStatus(200);
        $this->assertDatabaseMissing('products', [
            'id' => $body,
            'name' => 'Super',
            'price' => '23.30'
        ]);
}
public function test_client_can_delete_a_product2(){
        $responseDelete = $this->json('DELETE', '/api/products/' . '33');
           $responseDelete->assertJsonFragment([
            'code' => 'ERROR-2',
            'title' => 'Not found',
            
        ]);
            $responseDelete->assertStatus(404);
}

/**
*Prueba que valida que se muestran todos los articulos
**/
    public function test_client_can_see_all(){
        $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Super',
                    'price' => '23.30'
                ]
            ]
        ];
         $productData1 = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    'name' => 'Supe',
                    'price' => '23'
                ]
            ]
        ];
       
       
        $response = $this->json('GET', '/api/products/');
        $this->assertEquals(200, $response->getStatusCode());
      

    }
     public function test_client_can_see_all2(){
      
          $response = $this->json('GET', '/api/products');
           
            $response->assertStatus(200); 
    }

/**
*Prueba que valida que se muestra un artìculo
**/
	public function test_client_can_see_a_product(){
           // Given
        $productData = [
            'data' => [
                'type' => "products",
                'attributes' => [
                    
                    'name' => 'Super',
                    'price' => '23.30'
                ]
            ]
        ];

        // When
        $response = $this->json('POST', '/api/products', $productData); 

 
        

        // Assert the product was created
        // with the correct data
        $response->assertJsonFragment([
            'name' => 'Super',
            'price' => '23.30'
        ]);

        $body = json_encode($response->baseResponse->original->id);

        $response = $this->json('GET', '/api/products/' . $body);

        // Assert product is on the database
       
   
    $response->assertStatus(200); 
	}

      public function test_client_can_see_a_product2(){
        $response = $this->json('GET', '/api/products/' . '33');
        $response->assertJsonFragment([
            'code' => 'ERROR-2',
            'title' => 'Not found',
            
        ]);
   
    $response->assertStatus(404); 
    }

}
