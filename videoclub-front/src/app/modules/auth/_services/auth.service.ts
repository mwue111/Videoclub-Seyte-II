import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { catchError, map, of } from 'rxjs';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  storeLocalStorageToken(auth: any) {
    //TO DO
    console.log('auth: ', auth);
  }

  login(email: string, password: string) {
    let url = URL_SERVICES + '/login';
    return this.http.post(url, { email, password }).pipe(
      map((auth: any) => {
        if(auth.access_token){  //en postman se llama token
          return this.storeLocalStorageToken(auth);
        }
        else{
          return of(undefined);
        }
      }),
      catchError(error => {
        console.log('Ha habido un error iniciando sesión: ', error);
        return of(undefined);
      })
    )
  }
}
