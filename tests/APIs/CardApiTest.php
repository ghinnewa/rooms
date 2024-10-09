<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Card;

class CardApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
  // tests/APIs/CardApiTest.php

public function test_create_card()
{
    $card = Card::factory()->make()->toArray();

    $this->response = $this->json(
        'POST',
        '/api/cards', 
        $card
    );

    // Adjusting assertion for successful response (status code 201 or 200)
    $this->response->assertStatus(201);
    $this->assertApiResponse($card);
}

public function test_update_card()
{
    $card = Card::factory()->create();
    $editedCard = Card::factory()->make()->toArray();

    $this->response = $this->json(
        'PUT',
        '/api/cards/'.$card->id,
        $editedCard
    );

    $this->response->assertStatus(200);
    $this->assertApiResponse($editedCard);
}

public function test_read_card()
{
    // Create a card first
    $card = Card::factory()->create();

    // Attempt to retrieve the card
    $this->response = $this->json(
        'GET',
        '/api/cards/' . $card->id
    );

    // Check if the response status is 200 OK
    $this->response->assertStatus(200);
    $this->assertApiResponse($card->toArray());
}


public function test_delete_card()
{
    $card = Card::factory()->create();

    $this->response = $this->json(
        'DELETE',
        '/api/cards/'.$card->id
    );

    $this->response->assertStatus(200);
    $this->assertApiSuccess();

    // Ensure the card is deleted
    $this->response = $this->json(
        'GET',
        '/api/cards/'.$card->id
    );

    $this->response->assertStatus(404);
}

}
