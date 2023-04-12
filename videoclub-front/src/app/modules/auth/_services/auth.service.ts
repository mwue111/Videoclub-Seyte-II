import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { catchError, map, of } from 'rxjs';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  token: any = '';
  user: any = null;

  constructor(
    private http: HttpClient,
    private router: Router
  ) {
    this.loadLocalStorage();
  }

  loadLocalStorage() {
    if(localStorage['token'] && localStorage['user']){  //getItem vale también
      this.token = localStorage.getItem('token');
      this.user = JSON.parse(localStorage.getItem('user') ?? '');
    }
    else{
      this.token = '';
      this.user = null;
    }
  }

  storeLocalStorageToken(auth: any) {
   if(auth.token) {
    localStorage.setItem('token', auth.token);
    localStorage.setItem('user', JSON.stringify(auth.user));

    this.token = auth.token;
    this.user = auth.user;

    return true;
   }
   else{
    return false;
   }
  }

  login(email: string, password: string) {
    let url = URL_SERVICES + '/login';
    return this.http.post(url, { email, password }).pipe(
      map((auth: any) => {
        if(auth.token){  //en postman se llama token (dentro de data), en el tutorial access_token
          return this.storeLocalStorageToken(auth);
        }
        else{
          return of(undefined);
        }
      }),
      catchError(error => {
        console.log('Ha habido un error iniciando sesión: ', error);
        return of(error);
      })
    )
  }

  register(data: any) {
    let url = URL_SERVICES + '/register';
    return this.http.post(url, data);
  }

  logout() {
    this.token = '';
    this.user = null;

    localStorage.removeItem('token');
    localStorage.removeItem('user');
    this.router.navigate(['auth/login'], {//quizás hay que añadir una /
      queryParams: {},
    });
  }

  isLogged() {
    return localStorage.getItem('token') !== null;
  }
}
