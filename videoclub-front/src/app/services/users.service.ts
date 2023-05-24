import { Injectable } from '@angular/core';
import { URL_SERVICES } from '../config/config';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, catchError, map, of, throwError } from 'rxjs';
import { AuthService } from '../modules/auth/_services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  public url: string;

  constructor(
    private _http: HttpClient,
    private _auth: AuthService,
  ) {
    this.url = URL_SERVICES; //en lugar de Global
  }

  getUser(token: any, id: number): Observable<any> {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    return this._http.get(this.url + `/usuarios/${id}`, { headers: headers });

  }

  storeLocalStorageUpdated(token: any, auth: any) {
    localStorage.setItem('user', JSON.stringify(auth));
    let data = {
      data: {
        token: token,
        user: {
          user: auth
        }
      }
    }
    this._auth.storeLocalStorageToken(data);
    return true;
  }

   uploadData(token: any, data: any, id: number){
    const headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
    return this._http.post(this.url + `/file/${id}`, data, { headers: headers });
   }

  editUser(token: any, id: number, value: any): Observable<any> {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    return this._http.put(this.url + `/usuarios/${id}`, value, { headers: headers }).pipe(
      map((auth: any) => {
        console.log('auth: ', auth)
        this.storeLocalStorageUpdated(token, auth);
        return auth;
      }),
      catchError(err => {
        return of(err)
      })
    )
  }

  resetPassword(token: any, data: any): Observable<Object> {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    console.log('valores recibidos al cambiar la contraseña: ', data);
    return this._http.post(this.url + '/update-password', data, { headers: headers })
  }

  deleteUser(id: number) {

  }
}
