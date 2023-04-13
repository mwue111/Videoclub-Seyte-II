import { Component } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent {
  logged: boolean;
  constructor(private _auth: AuthService) {
    this.logged = _auth.isLogged();
  }
}
