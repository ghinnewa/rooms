<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCardAPIRequest;
use App\Http\Requests\API\UpdateCardAPIRequest;
use App\Models\Card;
use App\Repositories\CardRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Storage;
use Response;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class CardController
 * @package App\Http\Controllers\API
 */

class CardAPIController extends AppBaseController
{
    /** @var  CardRepository */
    private $cardRepository;

    public function __construct(CardRepository $cardRepo)
    {
        $this->cardRepository = $cardRepo;
    }

    /**
     * Display a listing of the Card.
     * GET|HEAD /cards
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cards = $this->cardRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );


        return $this->sendResponse(
            $cards->toArray(),
            __('messages.retrieved', ['model' => __('models/cards.plural')])
        );
    }

     /**
      * Store a newly created Card in storage.
      * POST /cards
      *
      * @param CreateCardAPIRequest $request
      *
      * @return Response
      */
    public function store(CreateCardAPIRequest $request)
{
    try {

        DB::beginTransaction();
        $input = $request->all();
        $input['image'] = $this->cardRepository->files($request->image, 'profile');
        $input['identity_file1'] = $this->cardRepository->files($request->identity_file1, 'identity_file1');
        $input['identity_file2'] = $this->cardRepository->files($request->identity_file2, 'identity_file2');

        $input['paid'] = 0;

        $path = 'qrcode-' . time() . '.svg';
        $output_file = 'public/qr-code/' . $path;
        $input['qrcode'] = $path;
        $card = $this->cardRepository->create($input);
        $card->membership_number = '00' + 1000 + $card->id;
        $card->save();

        $image = QrCode::size(200)->errorCorrection('H')
            ->generate('http://glucc.ly/card/?id='. $card->id.'&lang=ar' );
        Storage::disk('local')->put($output_file, $image);

        DB::commit();

        // return $this->sendResponse(
        //     $card->toArray(),
        //     __('messages.saved', ['model' => __('models/cards.singular')])
        // );
        // return response()->json([
        //     'success' => false,
        //     'message' => __('messages.error', ['model' => __('models/cards.singular')]),
        //     'error' => 'no'
        // ]);
        return   response()->json([
            'success' => 'false',
            'message' => __('messages.error', ['model' => __('models/cards.singular')]),
            'error' => 'error'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => __('messages.error', ['model' => __('models/cards.singular')]),
            'error' => $e->getMessage()
        ]);
    }
}

    /**
     * Display the specified Card.
     * GET|HEAD /cards/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Card $card */
        $card = $this->cardRepository->find($id);

        if (empty($card)|| !$card->paid) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/cards.singular')])
            );
        }

        return $this->sendResponse(
            $card->toArray(),
            __('messages.retrieved', ['model' => __('models/cards.singular')])
        );
    }

    /**
     * Update the specified Card in storage.
     * PUT/PATCH /cards/{id}
     *
     * @param int $id
     * @param UpdateCardAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCardAPIRequest $request)
    {
        $input = $request->all();

        /** @var Card $card */
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/cards.singular')])
            );
        }

        $card = $this->cardRepository->update($input, $id);

        return $this->sendResponse(
            $card->toArray(),
            __('messages.updated', ['model' => __('models/cards.singular')])
        );
    }

    /**
     * Remove the specified Card from storage.
     * DELETE /cards/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Card $card */
        $card = $this->cardRepository->find($id);

        if (empty($card)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/cards.singular')])
            );
        }

        $card->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/cards.singular')])
        );
    }
}
