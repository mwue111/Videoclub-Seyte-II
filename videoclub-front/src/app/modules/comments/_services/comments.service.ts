import { Injectable } from '@angular/core';
import { CommentInterface } from '../types/comment.interface';
import { Observable } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root'
})
export class CommentsService {

  constructor(
    private _httpClient: HttpClient,
  ) {
  }

  getComments(token: any): Observable<CommentInterface[]> {
    let url = URL_SERVICES + '/resenas';
    let headers = new HttpHeaders().set('Authorization', 'Bearer ' + token);

    return this._httpClient.get<CommentInterface[]>(url, { headers:headers });
  }

  getMovieComments(token: any, id: number): Observable<CommentInterface[]> {
    let url = URL_SERVICES + `/resenas/pelicula/${id}`
    let headers = new HttpHeaders().set('Authorization', 'Bearer' + token);

    return this._httpClient.get<CommentInterface[]>(url, { headers:headers })
  }

  getAuthors(id: any) {
    let url = URL_SERVICES + `/autor-resena/${id}`;

    return this._httpClient.get(url);
  }

  createComment(token: any, title: string, body: string, email: string, movie: number): Observable<CommentInterface> {
    let url = URL_SERVICES + '/resenas';
    let headers = new HttpHeaders().set('Authorization', 'Bearer' + token);

    return this._httpClient.post<CommentInterface>(url, {
      title: title,
      description: body,
      user_id: email,
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
