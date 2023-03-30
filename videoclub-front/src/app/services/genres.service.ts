import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Global } from './global';

@Injectable({
  providedIn: 'root'
})
export class GenresService {
  public url: string;

  constructor(
    private _http: HttpClient
  ) {
    this.url = Global.url;
  }

  getGenres(cantidad: number): Observable<any> {
    let params = new HttpParams().set('cantidad', cantidad.toString());

    return this._http.get(this.url + '/api/generos', { params: params })
  }

  getMoviesGenre(cantidad: number, id: number){
    let params = new HttpParams().set('cantidad', cantidad.toString());
    params.set('id', id.toString());

    return this._http.get(this.url + '/api/generos/peliculas', { params:params });
  }
}
