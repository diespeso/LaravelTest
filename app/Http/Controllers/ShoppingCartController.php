<?php

namespace App\Http\Controllers;

use App\Models\shoppingCart;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreshoppingCartRequest;
use App\Http\Requests\UpdateshoppingCartRequest;

use App\Providers\Repositories\ShoppingCartRepository;
use Illuminate\Http\JsonResponse;

use JWTAuth;

class ShoppingCartController extends Controller
{
    protected ShoppingCartRepository $shoppingCarts;

    public function __construct(ShoppingCartRepository $shoppingCarts) {
        $this->shoppingCarts = $shoppingCarts;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StoreshoppingCartRequest $req): JsonResponse
    {
        $full = $req->query->get('full');
        
        if ($full) { // todo: adaptar front
            $fullCart = $this->shoppingCarts->indexFromUserFull(request()->user->id);
            return response()->json([
                'data' => $fullCart,
            ]);
        }

        $index = $this->shoppingCarts->indexFromUser(request()->user->id);

        return response()->json([
            'data' => $index,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreshoppingCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreshoppingCartRequest $request): JsonResponse
    {
        //TODO: provisional, once were using auth change this
        error_log(request()->user);
        $request['user_id'] = request()->user->id;
        // use request->json() in the future TODO
        $created = $this->shoppingCarts->store($request->all());

        return response()->json([
            'data' => $created,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(shoppingCart $shoppingCart, int $id): JsonResponse
    {
        $found = $this->shoppingCarts->show($id);

        return response()->json([
            'data' => $found,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateshoppingCartRequest  $request
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateshoppingCartRequest $request, int $id): JsonResponse
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        error_log('enter controller');
        $found = $this->shoppingCarts->patch($id, $request->all());
        error_log($this->user);

        return response()->json([
            'data' => $found,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(shoppingCart $shoppingCart, int $id): JsonResponse
    {
        $deleted = $this->shoppingCarts->destroy($id);
        return response()->json([
            'data' => new \StdClass(),
        ], $deleted ? 200 : 500);
    }
}
