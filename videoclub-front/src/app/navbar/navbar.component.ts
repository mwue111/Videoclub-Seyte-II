import { Component } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { UserSharedServiceService } from '../services/user-shared-service.service';
import { URL_BACKEND } from '../config/config';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent {

  url: string = URL_BACKEND + '/storage/';
  logged!: boolean;
  user: any;
  username: string = '';

  constructor(
    private _auth: AuthService,
    private _shared: UserSharedServiceService,
  ) {
    if(this._auth.isLogged()){
      this.logged = _auth.isLogged();
      this.user = _auth.user.user;
    }
  }

  ngOnInit(){
    this._shared.username$.subscribe(username => {
      this.user.username = username;
    })
  }

  logout() {
    this._auth.logout();
    this.logged = false;
  }
}
