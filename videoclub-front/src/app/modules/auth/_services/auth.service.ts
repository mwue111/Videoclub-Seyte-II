import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Router } from '@angular/router';
import { catchError, map, of } from 'rxjs';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  token: any = '';
  user: any = null;

  constructor(
    private http: HttpClient,
    private router: Router
  ) {
    this.loadLocalStorage();
    // console.log('user en authService: ', this.user);
  }

  loadLocalStorage() {
    if (localStorage['token'] && localStorage['user']) {
      //getItem vale también
      this.token = localStorage.getItem('token');
      this.user = JSON.parse(localStorage.getItem('user') ?? '');
    } else {
      this.token = '';
      this.user = null;
    }
  }

  storeLocalStorageToken(auth: any) {
    if (auth.data.token) {
      localStorage.setItem('token', auth.data.token);
      localStorage.setItem('user', JSON.stringify(auth.data.user));

      this.token = auth.data.token;
      this.user = auth.data.user;

      return true;
    } else {
      return false;
    }
  }

  login(email: string, password: string, remember_me: Boolean) {
    let url = URL_SERVICES + '/login';
    return this.http.post(url, { email, password, remember_me }).pipe(
      map((auth: any) => {
        if (auth.data.token) {
          console.log('auth: ', auth);
          return this.storeLocalStorageToken(auth);
        } else {
          return of(undefined);
        }
      }),
      catchError((error) => {
        console.log('Ha habido un error iniciando sesión: ', error);
        return of(error);
      })
    );
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
    this.router.navigate(['auth/login'], {
      //quizás hay que añadir una /
      queryParams: {},
    });
  }

  isLogged() {
    return localStorage.getItem('token') !== null;
  }

  sendResetPasswordEmail(email: string) {
    let url = URL_SERVICES + '/reset-password';
    return this.http.post(url, email );
  }

  resetPassword(data: any) {
    return this.http.post(URL_SERVICES + '/change-password', data);
  }

  verifyOldPass(email: any, password: string){
    let params = new HttpParams().set('email', email)
                                .set('new', password);

    return this.http.get(URL_SERVICES + '/check-password', { params: params });

  }
}
