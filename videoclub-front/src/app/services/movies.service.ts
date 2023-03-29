import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Global } from './global';

@Injectable({
  providedIn: 'root',
})
export class MoviesService {
  public url: string;

  constructor(private _http: HttpClient) {
    this.url = Global.url;
  }

  getMovies(cantidad: number): Observable<any> {
    let params = new HttpParams().set('cantidad', cantidad.toString());
    return this._http.get(this.url + '/api/peliculas/' , { params: params, });
  }
}
