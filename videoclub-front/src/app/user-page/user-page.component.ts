import { Component } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UsersService } from '../services/users.service';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css']
})
export class UserPageComponent {
  user: any;
  isEditing!: boolean;

  constructor(
    private _auth: AuthService,
    private router: Router,
  ) {
    if(this._auth.isLogged()){
      this.user = this._auth.user.user;
    }
    else{
      this.router.navigate(['auth/login']);
    }
  }

  updateUser(user: any){
    this.isEditing = true;
    console.log('editando usuario ', user);
  }

  close(){
    this.isEditing = false;
  }
}
