import { Injectable } from '@angular/core';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserSharedServiceService {
  private usernameSubject = new Subject<string>();
  private imageSubject = new Subject<any>();

  username$ = this.usernameSubject.asObservable();
  image$ = this.imageSubject.asObservable();

  updateUsername(username: string) {
    this.usernameSubject.next(username);
  }

  updateImage(image: any) {
    this.imageSubject.next(image);
  }
}
