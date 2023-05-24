import { Injectable } from '@angular/core';
import { URL_SERVICES } from '../config/config';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
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

  // editUserImage(token: any, id: number, value: any): Observable<any> {
  //   let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
  //   const formData: FormData = new FormData();
  //   formData.append('image', value.image);

  //   return this._http.put(this.url + `/usuario-avatar/${id}`, formData, { headers });
  // }

  convertFileToBase64(file: File): Promise<string> {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onloadend = () => {
        const base64String = reader.result as string;
        const encodedString = base64String.split(',')[1];
        resolve(encodedString);
      };
      reader.onerror = (error) => {
        reject(error);
      };
    });
  }

  editUserImage(token: any, id: number, value: any): Observable<any> {
    return new Observable((observer) => {
      this.convertFileToBase64(value.image).then((base64String) => {
        const headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
        const params = new HttpParams().set('image', base64String);
        this._http.put(this.url + `/usuario-avatar/${id}`, null, { headers, params }).subscribe(
          (response) => {
            observer.next(response);
            observer.complete();
          },
          (error) => {
            observer.error(error);
          }
        );
      });
    });
  }

  // editUserImage(token: any, id: number, value: any) : Observable<any>{
  //   let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token)
  //                                 .append('Content-Type', 'multipart/form-data');

    // console.log('valor recibido: ', value);
    // console.log('headers: ', headers);

    // const image = this.prepareFormData(value);
    // const params = new HttpParams().set('image', value.image);

    // console.log('Qué se envía al back: ', image);
    // for(var key of image.entries()){
    //   console.log(key[0], ' - ', key[1])
    // }

    // const body = { image: value.image }
    // console.log('body: ', body);
    // return this._http.put(this.url + `/usuario-avatar/${id}`, null, { params, headers });
    // return this.http.put(url, formData, { headers });
    // return this._http.put(this.url + `/usuario-avatar/${id}`, image, { headers:headers });
    // return this._http.put(this.url + `/usuario-avatar/${id}`, { params: params });
  // }

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
