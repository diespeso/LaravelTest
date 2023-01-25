<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\ShoppingCart;
use App\Models\User;

class ShoppingCartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
        error_log('test this');
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, shoppingCart $shoppingCart)
    {
        //
        error_log('test this');
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ShoppingCart $shoppingCart)
    {
        error_log('testing update bad');
        error_log($user);
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\shoppingCart  $shoppingCart
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, shoppingCart $shoppingCart)
    {
        //
    }
}
