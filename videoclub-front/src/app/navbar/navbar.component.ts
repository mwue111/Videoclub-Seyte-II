import { Component } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent {
  logged: boolean;
  user: any;
  constructor(private _auth: AuthService) {
    this.logged = _auth.isLogged();
    this.user = _auth.user;
  }

  logout() {
    this._auth.logout();
    this.logged = false;
  }
}
