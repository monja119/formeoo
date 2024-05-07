<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model implements Authenticatable
{
    use HasFactory;

    protected $table = 'entity';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'address',
        'email',
        'password',
        'website',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // ...

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }


    /**
     * @inheritDoc
     */
    public function getAuthIdentifierName()
    {

    }

    /**
     * @inheritDoc
     */
    public function getRememberToken()
    {

    }

    /**
     * @inheritDoc
     */
    public function setRememberToken($value)
    {

    }

    /**
     * @inheritDoc
     */
    public function getRememberTokenName()
    {

    }
}
