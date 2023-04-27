import { Component } from '@angular/core';
import { AuthService } from '../modules/auth/_services/auth.service';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { URL_BACKEND } from '../config/config';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent {
  logged: boolean;
  user: any;
  constructor(
    private _auth: AuthService,
    private _http: HttpClient,
    private route: Router
  ) {
    this.logged = _auth.isLogged();
    this.user = _auth.user;
  }

  toAdmin(){
    let token = this._auth.token;
    let url = URL_BACKEND;

    // window.open(url + '/peliculas'); //esto abre el panel de admin pero sin detección de token

    // this._http.get(url + '/peliculas?token=' + token)
    //           .subscribe((res: any) => {
    //             window.open(res['url'], '_blank');
    //           })

    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
    // let params = new HttpParams().set('token', token)

    this._http.get(url + '/peliculas', { headers:headers, responseType: 'text' })
              .subscribe((res: any) => {
                const newWindow = window.open();
                newWindow?.document.write(res);
              })
  }

  logout() {
    this._auth.logout();
    this.logged = false;
  }
}
