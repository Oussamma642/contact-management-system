<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function sharedContacts()
    {
        return $this->belongsToMany(Contact::class, 'share_contacts', 'sender_id', 'contact_id')
            ->withPivot('receiver_id', 'status', 'created_at', 'updated_at');
    }

    public function receivedContacts()
    {
        return $this->belongsToMany(Contact::class, 'share_contacts', 'receiver_id', 'contact_id')
            ->withPivot('sender_id', 'status', 'created_at', 'updated_at');
    }
}