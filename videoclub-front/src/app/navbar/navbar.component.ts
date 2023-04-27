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

    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    // Para mandar el token como parámetro (opción que no permite auth:api en web.php)
    // let params = new HttpParams().set('token', token)
    // this._http.get(url + '/peliculas', { headers:headers, params:params, responseType: 'text' })

    this._http.get(url + '/peliculas', { headers:headers, responseType: 'text' })
              .subscribe((res: any) => {
                const newWindow = window.open();
                newWindow?.document.write(res);
                //Con esto no permite auth:api en web.php pero almacena el token en la url (poco seguro)
                // newWindow!.location.href = url + '/peliculas?token=' + token;
              })
  }

  logout() {
    this._auth.logout();
    this.logged = false;
  }
}
