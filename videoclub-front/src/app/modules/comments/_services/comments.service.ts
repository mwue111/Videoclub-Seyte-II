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
}
