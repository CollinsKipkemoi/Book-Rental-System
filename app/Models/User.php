<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_librarian',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function readerBorrows()
    {
        return $this->hasMany(Borrow::class, 'reader_id');
    }

    public function managedRequests()
    {
        return $this->hasMany(Borrow::class, 'request_managed_by');
    }

    public function managedReturns()
    {
        return $this->hasMany(Borrow::class, 'return_managed_by');
    }

    public function hasOngoingRental($bookId)
    {
        return $this->readerBorrows()
            ->where('book_id', $bookId)
            ->where('status', '!=', 'RETURNED')
            ->exists();
    }
}
