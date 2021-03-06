<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface{

  public function getAuthIdentifier() {
    return $this->getKey();
  }

  public function getAuthPassword() {
    return $this->password;
  }

  public function getRememberToken()
  {
    return $this->remember_token;
  }
  
  public function setRememberToken($value)
  {
    $this->remember_token = $value;
  }
  
  public function getRememberTokenName()
  {
    return "remember_token";
  }
  

  



  public function cats(){
    return $this->hasMany('Cat', 'owner');
  }

  public function owns(Cat $cat){
    return $this->id == $cat->owner;

  }
  public function canEdit(Cat $cat){
    return $this->is_admin or $this->owns($cat);
  }
}
