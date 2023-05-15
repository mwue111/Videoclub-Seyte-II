import { Injectable } from '@angular/core';
import { CommentInterface } from '../types/comment.interface';
import { Observable, finalize, of, share, tap } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root'
})
export class CommentsService {
  private cache: any;
  private cachedObservable!: Observable<any> | null;

  constructor(
    private _httpClient: HttpClient,
  ) {
  }

  getComments(token: any): Observable<CommentInterface[]> {
    let url = URL_SERVICES + '/resenas';
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    return this._httpClient.get<CommentInterface[]>(url, { headers:headers });
  }

  getMovieComments(token: any, id: number, page: number): Observable<CommentInterface[]> {
    let observable: Observable<any>;
    let url = URL_SERVICES + `/resenas/pelicula/${id}/${page}`
    let headers = new HttpHeaders().set('Authorization', 'Bearer' + token);

    if(this.cache && this.cache.current_page === page){
      console.log('CACHEADA:  - página actual cacheado: ', this.cache.current_page, ' y página recibida: ', page);
      observable = of(this.cache)
    }
    else if(this.cachedObservable) {
      observable = this.cachedObservable;
    }
    else{
      console.log('Entra en petición - qué recibe commentService: ', page, ' - qué manda: ', url);
      this.cachedObservable = this._httpClient.get<CommentInterface[]>(url, { headers:headers }).pipe(
          tap(res => this.cache = res),
          share(),
          finalize(() => this.cachedObservable = null)
      );
      observable = this.cachedObservable;
    }
    return observable;
  }

  getAuthors(id: any) {
    let url = URL_SERVICES + `/autor-resena/${id}`;

    return this._httpClient.get(url);
  }

  createComment(token: any, title: string, body: string, user: string|number, movie: number): Observable<CommentInterface> {
    let url = URL_SERVICES + '/resenas';
    let headers = new HttpHeaders().set('Authorization', 'Bearer' + token);

    return this._httpClient.post<CommentInterface>(url, {
      title: title,
      description: body,
      user_id: user,
      movie_id: movie
     }, { headers:headers })
  }

  updateComment(token: any, title: string, body: string, id: string|number, user: number, movie: number): Observable<CommentInterface> {
    let url = URL_SERVICES + `/resenas/${id}`;
    let headers = new HttpHeaders().set('Authorization','Bearer' + token);

    return this._httpClient.put<CommentInterface>(url, {
      title: title,
      description: body,
      user_id: user,
      movie_id: movie
    }, { headers:headers })
  }

  deleteComment(token: any, id: string|number){
    let url = URL_SERVICES + `/resenas/${id}`;
    let headers = new HttpHeaders().set('Authorization', 'Bearer' + token);

    return this._httpClient.delete(url, { headers:headers })
  }
}
