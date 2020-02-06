<?php

namespace App\Policies;

use App\Address;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any addresses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the address.
     *
     * @param  \App\User  $user
     * @param  \App\=App\Address  $address
     * @return mixed
     */
    public function view(User $user, Address $address)
    {
        //
    }

    /**
     * Determine whether the user can create addresses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the address.
     *
     * @param  \App\User  $user
     * @param  \App\=App\Address  $address
     * @return mixed
     */
    public function update(User $user, Address $address)
    {
        if ($user->id != $address->user_id) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * Determine whether the user can delete the address.
     *
     * @param  \App\User  $user
     * @param  \App\=App\Address  $address
     * @return mixed
     */
    public function delete(User $user, Address $address)
    {
        //
    }

    /**
     * Determine whether the user can restore the address.
     *
     * @param  \App\User  $user
     * @param  \App\=App\Address  $address
     * @return mixed
     */
    public function restore(User $user, Address $address)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the address.
     *
     * @param  \App\User  $user
     * @param  \App\=App\Address  $address
     * @return mixed
     */
    public function forceDelete(User $user, Address $address)
    {
        //
    }
}
