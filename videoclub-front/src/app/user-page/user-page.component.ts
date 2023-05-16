import { Component } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-page',
  templateUrl: './user-page.component.html',
  styleUrls: ['./user-page.component.css']
})
export class UserPageComponent {
  user: any;

  constructor(
    private _auth: AuthService,
    private router: Router,
  ) {
    if(this._auth.isLogged()){
      this.user = this._auth.user;
    }
    else{
      this.router.navigate(['auth/login']);
    }

    // console.log('usuario: ', this.user);
  }
}
