<?php

namespace App\Http\Controllers;

use App\DataTables\CardDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Repositories\CardRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CardController extends AppBaseController
{
    /** @var CardRepository $cardRepository*/
    private $cardRepository;

    public function __construct(CardRepository $cardRepo)
    {
        $this->cardRepository = $cardRepo;
    }

    /**
     * Display a listing of the Card.
     *
     * @param CardDataTable $cardDataTable
     *
     * @return Response
     */
    public function index(CardDataTable $cardDataTable)
    {
        return $cardDataTable->render('cards.index');
    }

    /**
     * Show the form for creating a new Card.
     *
     * @return Response
     */
    public function create()
    {
        return view('cards.create');
    }

    /**
     * Store a newly created Card in storage.
     *
     * @param CreateCardRequest $request
     *
     * @return Response
     */
    public function store(CreateCardRequest $request)
    {
        $input = $request->all();

        $card = $this->cardRepository->create($input);

        Flash::success('Card saved successfully.');

        return redirect(route('cards.index'));
    }

    /**
     * Display the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        return view('cards.show')->with('card', $card);
    }

    /**
     * Show the form for editing the specified Card.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        return view('cards.edit')->with('card', $card);
    }

    /**
     * Update the specified Card in storage.
     *
     * @param int $id
     * @param UpdateCardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCardRequest $request)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        $card = $this->cardRepository->update($request->all(), $id);

        Flash::success('Card updated successfully.');

        return redirect(route('cards.index'));
    }

    /**
     * Remove the specified Card from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            Flash::error('Card not found');

            return redirect(route('cards.index'));
        }

        $this->cardRepository->delete($id);

        Flash::success('Card deleted successfully.');

        return redirect(route('cards.index'));
    }
}
