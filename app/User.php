<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Follow;
use Illuminate\Support\Facades\DB;
use App\Profile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function feed_posts(){
        
        return DB::select(' SELECT users.name, feed_posts.*
                            FROM
                                (SELECT *
                                FROM
                                    (SELECT follows.followee_id
                                    FROM users
                                    JOIN follows
                                    ON users.id = follows.follower_id
                                    WHERE follows.follower_id = '.auth()->user()->id.') as followees
                                JOIN posts
                                ON followees.followee_id = posts.user_id) as feed_posts
                            JOIN users
                            ON users.id = feed_posts.followee_id
                            ORDER BY feed_posts.created_at desc;
                            ');
        
        //return $this->hasMany('App\Follow');
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }
}
