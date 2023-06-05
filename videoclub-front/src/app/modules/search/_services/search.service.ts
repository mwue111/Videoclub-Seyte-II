import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { URL_SERVICES } from 'src/app/config/config';

@Injectable({
  providedIn: 'root'
})
export class SearchService {

  url: string = URL_SERVICES;
  debounceTimer: any;

  constructor(
    private _http: HttpClient,
  ) { }

  search(value: string): Observable<any> {
    return this._http.get(this.url + '/resultado', {params: {search: value}})
  }

  suggestions(value: string) {
    return new Promise((resolve, reject) => {
      clearTimeout(this.debounceTimer);

      this.debounceTimer = setTimeout(() => {
        this._http.get(this.url + '/resultado', { params: {search: value} }).subscribe(data => {
          resolve(data);
        }, err => {
          reject(err);
          console.log('error: ', err);
        })
      }, 350)
    })
  }
}
