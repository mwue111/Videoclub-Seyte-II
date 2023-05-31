import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root'
})
export class SearchService {

  url: string = URL_SERVICES;

  constructor(
    private _http: HttpClient,
  ) { }

  search(value: string): Observable<any> {
    return this._http.get(this.url + '/resultado', {params: {search: value}})
  }
}
