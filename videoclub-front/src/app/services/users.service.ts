import { Injectable } from '@angular/core';
import { URL_SERVICES } from '../config/config';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  public url: string;

  constructor(
    private _http: HttpClient,
  ) {
    this.url = URL_SERVICES; //en lugar de Global
  }

  getUser(id: number){

  }

  editUser(token: any, id: number, value: any): Observable<Object>{
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    return this._http.put(this.url + `/usuarios/${id}`, value, { headers: headers });
  }

  deleteUser(id: number){

  }
}
