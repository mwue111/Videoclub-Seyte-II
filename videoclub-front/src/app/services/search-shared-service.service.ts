import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SearchSharedServiceService {
  private querySubject = new Subject<string>();

  query$ = this.querySubject.asObservable();

  searchValue(query: string) {
    this.querySubject.next(query);
  }
}
