import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
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

  getMovies(amount: number, token: any): Observable<any> {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);
    let params = new HttpParams().set('cantidad', amount.toString());

    return this._http.get(this.url + '/api/peliculas', { params: params, headers: headers });
  }

  getOneMovie(id: number, token: any) {
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    return this._http.get(this.url + '/api/peliculas/' + id, { headers:headers });
  }

  getMovieGenre(id: number) {
    return this._http.get(this.url + '/api/pelicula/' + id + '/generos');
  }

  // getGenreMovie(id: number): Observable<any> {
  //   return this._http.get(this.url + '/api/generos/' + id + '/peliculas');
  // }
}
