import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserSharedServiceService {
  private usernameSubject = new Subject<string>();
  username$ = this.usernameSubject.asObservable();

  updateUsername(username: string) {
    this.usernameSubject.next(username);
  }
}
